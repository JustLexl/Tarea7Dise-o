<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Subject;
use App\Models\Activity;

class GradesCrudTest extends TestCase
{
    public function test_subjects_index_displays_subjects()
    {
        $response = $this->get('/subjects');
        $response->assertStatus(200);
        $response->assertSee('Add');
    }

    public function test_subject_show_displays_activities_and_grades()
    {
        $subject = Subject::first();
        $response = $this->get('/subjects/' . $subject->id);
        $response->assertStatus(200);
        $response->assertSee($subject->name);
        $response->assertSee('Activities & Grades', false);
    }

    public function test_can_create_subject()
    {
        $response = $this->post('/subjects', [
            'name' => 'Física Aplicada ' . rand(1, 9999),
            'code' => 'FIS-101',
            'description' => 'Mecánica clásica y termodinámica.',
        ]);

        $response->assertRedirect('/subjects');
    }

    public function test_can_create_evaluable_activity_with_grade()
    {
        $subject = Subject::first();

        $response = $this->post('/activities', [
            'subject_id' => $subject->id,
            'type' => 'Homework',
            'name' => 'Tarea 99: Test Unitario',
            'date' => '2026-10-16',
            'grade' => 98.5,
            'description' => 'Tarea de prueba con calificación.',
        ]);

        $response->assertRedirect('/subjects/' . $subject->id);
        $this->assertDatabaseHas('activities', ['name' => 'Tarea 99: Test Unitario', 'grade' => 98.5]);
    }

    public function test_can_create_evaluable_activity_without_grade()
    {
        $subject = Subject::first();

        $response = $this->post('/activities', [
            'subject_id' => $subject->id,
            'type' => 'Midterm',
            'name' => 'Examen Sin Calificar Aún',
            'date' => '2026-11-01',
            'grade' => null,
            'description' => 'Espacio de calificación opcional en blanco.',
        ]);

        $response->assertRedirect('/subjects/' . $subject->id);
        $this->assertDatabaseHas('activities', ['name' => 'Examen Sin Calificar Aún', 'grade' => null]);
    }

    public function test_can_update_activity_and_grade()
    {
        $activity = Activity::first();

        $response = $this->patch('/activities/' . $activity->id, [
            'subject_id' => $activity->subject_id,
            'type' => 'Midterm',
            'name' => 'Actividad Modificada',
            'date' => '2026-10-20',
            'grade' => 99.0,
            'description' => 'Calificación actualizada.',
        ]);

        $response->assertRedirect('/subjects/' . $activity->subject_id);
        $this->assertDatabaseHas('activities', ['id' => $activity->id, 'grade' => 99.0]);
    }

    public function test_can_delete_activity()
    {
        $activity = Activity::create([
            'subject_id' => Subject::first()->id,
            'type' => 'Activity',
            'name' => 'Para Eliminar',
            'date' => '2026-10-16',
            'grade' => 70,
        ]);

        $response = $this->delete('/activities/' . $activity->id);
        $response->assertRedirect('/subjects/' . $activity->subject_id);
        $this->assertDatabaseMissing('activities', ['id' => $activity->id]);
    }
}

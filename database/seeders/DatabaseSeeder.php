<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Activity;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $web = Subject::create([
            'name' => 'Diseño de Aplicaciones Web',
            'code' => 'DAW-401',
            'description' => 'Desarrollo full-stack con Laravel, Blade, controladores RESTful y patrones de diseño.',
        ]);

        Activity::create([
            'subject_id' => $web->id,
            'type' => 'Homework',
            'name' => 'Tarea 1: Arquitectura MVC y Rutas',
            'date' => '2026-09-15',
            'grade' => 95.0,
            'description' => 'Investigación y ejercicios prácticos de rutas y controladores.',
        ]);

        Activity::create([
            'subject_id' => $web->id,
            'type' => 'Activity',
            'name' => 'Actividad 2: Migraciones y Modelos Eloquent',
            'date' => '2026-09-22',
            'grade' => 90.0,
            'description' => 'Creación de esquemas de tablas con llaves foráneas y relaciones.',
        ]);

        Activity::create([
            'subject_id' => $web->id,
            'type' => 'Quick Test',
            'name' => 'Examen Rápido 1: Sintaxis Blade y Directivas',
            'date' => '2026-10-01',
            'grade' => 88.0,
            'description' => 'Evaluación rápida de 15 minutos en clase.',
        ]);

        Activity::create([
            'subject_id' => $web->id,
            'type' => 'Midterm',
            'name' => 'Examen Parcial 1',
            'date' => '2026-10-10',
            'grade' => 92.5,
            'description' => 'Evaluación teórica y práctica del primer parcial.',
        ]);

        Activity::create([
            'subject_id' => $web->id,
            'type' => 'Project',
            'name' => 'Proyecto Integrador CRUD',
            'date' => '2026-10-25',
            'grade' => null,
            'description' => 'Entrega final del módulo de gestión de actividades y calificaciones.',
        ]);

        $db = Subject::create([
            'name' => 'Bases de Datos para Aplicaciones',
            'code' => 'BDA-302',
            'description' => 'Modelado relacional, transacciones ACID, procedimientos almacenados y optimización.',
        ]);

        Activity::create([
            'subject_id' => $db->id,
            'type' => 'Homework',
            'name' => 'Tarea 1: Normalización de Tablas',
            'date' => '2026-09-18',
            'grade' => 100.0,
            'description' => 'Formas normales 1FN, 2FN y 3FN.',
        ]);

        Activity::create([
            'subject_id' => $db->id,
            'type' => 'Quick Test',
            'name' => 'Examen Rápido: Triggers y Transacciones',
            'date' => '2026-10-05',
            'grade' => 85.0,
            'description' => 'Casos prácticos de rollback y commit.',
        ]);

        Activity::create([
            'subject_id' => $db->id,
            'type' => 'Midterm',
            'name' => 'Examen Parcial 1',
            'date' => '2026-10-14',
            'grade' => null,
            'description' => 'Pendiente de calificar.',
        ]);
    }
}

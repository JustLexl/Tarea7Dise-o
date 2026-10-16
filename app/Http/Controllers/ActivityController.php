<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $subjects = Subject::orderBy('name')->get();
        $selectedSubjectId = $request->get('subject_id');

        return view('activities.create', compact('subjects', 'selectedSubjectId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'subject_id'  => 'required|exists:subjects,id',
            'type'        => 'required|string|max:60',
            'name'        => 'required|string|max:150',
            'date'        => 'required|date',
            'grade'       => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        $activity = Activity::create($validatedData);

        return redirect()->route('subjects.show', $activity->subject_id)
            ->with('success', 'Evaluable activity has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        return redirect()->route('subjects.show', $activity->subject_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::with('subject')->findOrFail($id);
        $subjects = Subject::orderBy('name')->get();

        return view('activities.edit', compact('activity', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subject_id'  => 'required|exists:subjects,id',
            'type'        => 'required|string|max:60',
            'name'        => 'required|string|max:150',
            'date'        => 'required|date',
            'grade'       => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($validatedData);

        return redirect()->route('subjects.show', $activity->subject_id)
            ->with('success', 'Activity and grade have been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $subjectId = $activity->subject_id;
        $activity->delete();

        return redirect()->route('subjects.show', $subjectId)
            ->with('success', 'Activity has been successfully deleted.');
    }
}

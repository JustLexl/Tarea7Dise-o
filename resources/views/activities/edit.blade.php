@extends('layouts.app') 

@section('content') 
  <style> 
    .uper { 
      margin-top: 40px; 
    } 
  </style> 
  <div class="card uper"> 
    <div class="card-header"> 
      Edit Activity 
    </div> 
    <div class="card-body"> 
      @if ($errors->any()) 
        <div class="alert alert-danger"> 
          <ul> 
            @foreach ($errors->all() as $error) 
              <li>{{ $error }}</li> 
            @endforeach 
          </ul> 
        </div><br /> 
      @endif 
      <form method="post" action="{{ route('activities.update', $activity->id) }}"> 
        @csrf 
        @method('PATCH') 
        <div class="form-group mb-3"> 
          <label for="subject_id">Subject:</label> 
          <select name="subject_id" class="form-control"> 
            @foreach ($subjects as $subject) 
              <option value="{{ $subject->id }}" {{ (old('subject_id', $activity->subject_id) == $subject->id) ? 'selected' : '' }}> 
                {{ $subject->name }} 
              </option> 
            @endforeach 
          </select> 
        </div> 
        <div class="form-group mb-3"> 
          <label for="type">Activity Type:</label> 
          <select name="type" class="form-control"> 
            @php $currentType = old('type', $activity->type); @endphp 
            <option value="Homework" {{ $currentType == 'Homework' ? 'selected' : '' }}>Homework</option> 
            <option value="Activity" {{ $currentType == 'Activity' ? 'selected' : '' }}>Activity</option> 
            <option value="Quick test" {{ $currentType == 'Quick test' ? 'selected' : '' }}>Quick test</option> 
            <option value="Midterm" {{ $currentType == 'Midterm' ? 'selected' : '' }}>Midterm</option> 
            <option value="Other" {{ $currentType == 'Other' ? 'selected' : '' }}>Other</option> 
          </select> 
        </div> 
        <div class="form-group mb-3"> 
          <label for="name">Name:</label> 
          <input type="text" class="form-control" name="name" value="{{ old('name', $activity->name) }}" /> 
        </div> 
        <div class="form-group mb-3"> 
          <label for="date">Date:</label> 
          <input type="date" class="form-control" name="date" value="{{ old('date', $activity->date ? $activity->date->format('Y-m-d') : '') }}" /> 
        </div> 
        <div class="form-group mb-3"> 
          <label for="grade">Grade (optional):</label> 
          <input type="number" step="0.01" min="0" max="100" class="form-control" name="grade" value="{{ old('grade', $activity->grade) }}" /> 
        </div> 
        <div class="form-group mb-3"> 
          <label for="description">Description:</label> 
          <textarea rows="5" class="form-control" name="description">{{ old('description', $activity->description) }}</textarea> 
        </div> 
        <button type="submit" class="btn btn-primary">Save</button> 
        <a href="{{ route('subjects.show', $activity->subject_id) }}" class="btn btn-primary">Return</a> 
      </form> 
    </div> 
  </div> 
@endsection

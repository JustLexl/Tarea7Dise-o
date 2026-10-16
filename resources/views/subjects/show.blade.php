@extends('layouts.app') 

@section('content') 
  <style> 
    .uper { 
      margin-top: 40px; 
    } 
  </style> 
  <div class="card uper"> 
    <div class="card-header"> 
      View Subject 
    </div> 

    <div class="card-body"> 
      @if (session()->get('success')) 
        <div class="alert alert-success"> 
          {{ session()->get('success') }} 
        </div><br /> 
      @endif 

      <div class="form-group mb-3"> 
        <label for="name">Name:</label> 
        <input type="text" class="form-control" name="name" value="{{ $subject->name }}" disabled /> 
      </div> 
      <div class="form-group mb-3"> 
        <label for="code">Code:</label> 
        <input type="text" class="form-control" name="code" value="{{ $subject->code }}" disabled /> 
      </div> 
      <div class="form-group mb-3"> 
        <label for="description">Description:</label> 
        <textarea rows="4" class="form-control" name="description" disabled>{{ $subject->description }}</textarea> 
      </div> 
      <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary">Edit</a> 
      <a href="{{ route('activities.create', ['subject_id' => $subject->id]) }}" class="btn btn-success">Add Activity</a> 
      <a href="{{ route('subjects.index') }}" class="btn btn-primary">Index</a> 
    </div> 
  </div> 

  <div class="card uper"> 
    <div class="card-header"> 
      Activities & Grades 
    </div> 
    <div class="card-body"> 
      <table class="table table-striped"> 
        <thead> 
          <tr> 
            <th>No</th> 
            <th>Type</th> 
            <th>Name</th> 
            <th>Date</th> 
            <th>Grade</th> 
            <th>Description</th> 
            <th width="80px"></th> 
            <th width="80px"></th> 
          </tr> 
        </thead> 
        <tbody> 
          @foreach ($subject->activities as $activity) 
            <tr> 
              <td>{{ $activity->id }}</td> 
              <td>{{ $activity->type }}</td> 
              <td>{{ $activity->name }}</td> 
              <td>{{ $activity->date ? $activity->date->format('Y-m-d') : '' }}</td> 
              <td>{{ $activity->grade !== null ? $activity->grade : 'Pending' }}</td> 
              <td>{{ $activity->description }}</td> 
              <td><a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-primary">Edit</a></td> 
              <td> 
                <form action="{{ route('activities.destroy', $activity->id) }}" method="post"> 
                  @csrf 
                  @method('DELETE') 
                  <button class="btn btn-danger" type="submit">Delete</button> 
                </form> 
              </td> 
            </tr> 
          @endforeach 
        </tbody> 
      </table> 
    </div> 
  </div> 
@endsection

@extends('layouts.app') 

@section('content') 
  <style> 
    .uper { 
      margin-top: 40px; 
    } 
  </style> 
  <div class="card uper"> 
    <div class="card-header"> 
      Edit Subject 
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
      <form method="post" action="{{ route('subjects.update', $subject->id) }}"> 
        @csrf 
        @method('PATCH') 
        <div class="form-group mb-3"> 
          <label for="name">Name:</label> 
          <input type="text" class="form-control" name="name" value="{{ $subject->name }}" /> 
        </div> 
        <div class="form-group mb-3"> 
          <label for="code">Code:</label> 
          <input type="text" class="form-control" name="code" value="{{ $subject->code }}" /> 
        </div> 
        <div class="form-group mb-3"> 
          <label for="description">Description:</label> 
          <textarea rows="5" class="form-control" name="description">{{ $subject->description }}</textarea> 
        </div> 
        <button type="submit" class="btn btn-primary">Save</button> 
        <a href="{{ route('subjects.index') }}" class="btn btn-primary">Return</a> 
      </form> 
    </div> 
  </div> 
@endsection

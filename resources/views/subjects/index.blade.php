@extends('layouts.app') 

@section('content') 
  <style> 
    .margin { 
      margin-top: 40px; 
    } 
  </style> 
  <div class="margin"> 
    @if (session()->get('success')) 
      <div class="alert alert-success"> 
        {{ session()->get('success') }} 
      </div><br /> 
    @endif 
    <div class="row"> 
      <a class="btn btn-primary" href="{{ route('subjects.create') }}">Add</a> 
    </div><br /> 

    <table class="table table-striped"> 
      <thead> 
        <tr> 
          <th>No</th> 
          <th>Name</th> 
          <th>Code</th> 
          <th>Description</th> 
          <th width="80px"></th> 
          <th width="80px"></th> 
        </tr> 
      </thead> 
      <tbody> 
        @foreach ($subjects as $subject) 
          <tr> 
            <td><a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->id }}</a></td> 
            <td><a href="{{ route('subjects.show', $subject->id) }}">{{ $subject->name }}</a></td> 
            <td>{{ $subject->code }}</td> 
            <td>{{ $subject->description }}</td> 
            <td><a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary">Edit</a></td> 
            <td> 
              <form action="{{ route('subjects.destroy', $subject->id) }}" method="post"> 
                @csrf 
                @method('DELETE') 
                <button class="btn btn-danger" type="submit">Delete</button> 
              </form> 
            </td> 
          </tr> 
        @endforeach 
      </tbody> 
    </table> 
  <div> 
@endsection

@extends('master.master')
@section('content')

    <h1>Laravel crud</h1>
    <hr>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>

        @endif
   @if($errors->any())
       <ul class="alert alert-danger">
           @foreach($errors->all() as $message)
           <li>{{$message}}</li>
               @endforeach
       </ul>

       @endif

    <form action="{{route('addUser')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" id="name">
    </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="form-group">
            <label for="file">Profile Picture:</label>
            <input type="file" name="image" class="form-control" id="file">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="5"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Add Record</button>

    </form>
    <a href="{{route('viewUser')}}" class="btn btn-primary pull-right">View Record</a>
    </div>


@stop



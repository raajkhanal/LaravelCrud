@extends('master.master')
@section('content')

    <h1>Laravel crud Update</h1>
    <hr>

   @if($errors->any())
       <ul class="alert alert-danger">
           @foreach($errors->all() as $message)
           <li>{{$message}}</li>
               @endforeach
       </ul>

       @endif
<div class="col-md-8">
    <form action="{{route('editUserAction')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$usersdata->id}}">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{$usersdata->name}}" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" value="{{$usersdata->email}}" class="form-control" id="email">
        </div>

        <div class="form-group">
            <label for="file">Profile Picture:</label>
            <input type="file" name="image" class="form-control" id="file">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="5">
                {{$usersdata->description}}
            </textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Update Record</button>
        </div>
    </form>
</div>
 <div class="col-md-4">
     <img src="{{url('public/images/'.$usersdata->image)}}" alt="image not found " style="height: 400px">
 </div>



@stop



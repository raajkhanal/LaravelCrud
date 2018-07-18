@extends('master.master')
@section('content')

    <h1>Laravel crud</h1>
    <hr>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>

    @endif
        <table class="table table-hover table-bordered">
            <tr>
                <th>s.n</th>
                <th>name</th>
                <th>email</th>
                <th>image</th>
                <th>action</th>
            </tr>

            <tr>
                @foreach($usersdata as $key=>$value)
                <td>{{++$key}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
                <td><img src="{{url('public/images/'.$value->image)}}" style="width: 60px; height: 60px" alt="image not found"></td>
                <td>
                    <a href="{{route('editUser').'/'.$value->id}}" class="btn btn-primary btn-xs">edit</a>
                    <a href="{{route('deleteUser').'/'.$value->id}}" class="btn btn-danger btn-xs">delete</a>
                </td>
            </tr>
            @endforeach
        </table>

   <a href="{{route('index')}}" class="btn btn-primary">Add Record</a>
    {{$usersdata->links()}}

@stop



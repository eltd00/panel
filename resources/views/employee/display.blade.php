@extends('layouts.app')

@section('content')
    <table class="table thead-light">
        <thead class="thead-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Country</th>
            @can('update')
            <th>Operation</th>
            @endcan
        </tr>
        </thead>
        <tbody>

        @foreach($employees as $employee)
        <tr>
            <th scope="row">{{$employee->id}}</th>
            <td>{{$employee->name}}</td>
            <td>{{$employee->age}}</td>
            <td>{{$employee->Country}}</td>
            <td>
                @can('update')
                    <a href="{{route("employeeController.edit",$employee->id)}}" class="btn btn-primary">Edit</a>
                @endcan
                &nbsp;
                @can('delete')
                    <a href="{{route("delete.employeeController",$employee->id)}}" class="btn btn-danger">Delete</a></td>
                @endcan
        </tr>
        @endforeach
        @if(session()->has("success"))
            <div class="alert alert-success">{{session()->get('success')}}</div>
        @endif
        @if(session()->has("error"))
            <div class="alert alert-danger">{{session()->get('error')}}</div>
        @endif
        </tbody>
    </table>
    @can('create')
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <a href="{{route("add.employeeController")}}" class="btn btn-secondary">Add User</a>
            </div>
        </div>
    </div>
    @endcan

@endsection

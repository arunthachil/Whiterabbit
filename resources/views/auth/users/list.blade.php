@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div id="sidebar" class="col-md-1">
        @include('sidebar')
    </div>
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('User List') }} 
                <button style="float:right;padding:0 10px;" type="submit" class="btn btn-default">
                    <a  href="{{ route('register') }}">Create User</a>
                </button></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$user['name']}}</td>
                                    <td>{{$user['email']}}</td>
                                    <td>{{$user['role_name']}}</td>
                                    <td><button class="btn btn-default"><a  href="{{ url('/users/'.$user['id'].'/edit') }}">Edit</a></button><button name="delete_user" class="btn btn-default delete_user" data-id="{{$user['id']}}"><a style="margin-left:7px;color:red;" href="javascript:void(0);">Delete</a></button></td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="confirm" class="modal" style="width:300px !important;height:200px !important;margin-left:500px; background-color:white !important;">
            <div class="modal-body">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
            </div>
            </div>
    </div>
</div>

@endsection
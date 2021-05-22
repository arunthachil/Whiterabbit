@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div id="sidebar" class="col-md-1">
        @include('sidebar')
    </div>
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('File List') }} 
                <button style="float:right;padding:0 10px;" type="submit" class="btn btn-default">
                    <a  href="{{ route('image.upload') }}">Upload File</a>
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
                                <th scope="col">Thumbnail</th>
                                <th scope="col">File Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $key => $file)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td><img width="50px" height="50px" src="images/{{ $file['filename'] }}"></td>
                                    <td>{{$file['filename']}}</td>
                                    <td><button name="delete_user" class="btn btn-default delete_file" data-id="{{$file['id']}}"><a style="margin-left:7px;color:red;" href="javascript:void(0);">Delete</a></button></td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="confirm" class="modal" style="width:300px !important;height:200px !important;margin-left:500px;background-color:white !important">
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
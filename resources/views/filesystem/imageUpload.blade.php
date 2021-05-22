@extends('layouts.app')

@section('content')
<div class="container">
   
<div id="sidebar" class="col-md-1">
        @include('sidebar')
    </div>
    <div class="col-md-11">
            <div class="card">
            <div class="card-header">{{ __('Upload File') }} 
            </div>
            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    <img width="300px" height="300px" src="images/{{ Session::get('image') }}">
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form style="padding-top: 25px;" action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12" style="padding-bottom:20px;">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label>Users</label>
                            <select name="user[]" class="custom-select" multiple="multiple">
                                @foreach($users as $key => $user)
                                <option value="{{$user['id']}}">{{$user['name']}}</option>
                                @endforeach
                            </select>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
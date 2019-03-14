@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
       <i class="fa fa-eye"></i> {{$title}}
    </div>
    <div class="card-body">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">{{$category->name}}</h1><hr>
                <p class="lead">
                    <h5>Creator: {{$category->creator->name}}</h5>
                    <h5>News: <span class="badge badge-danger">{{$category->news()->count()}}</span></h5>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-eye"></i> {{$title}}
        </div>
        <div class="card-body">
            <h1 class="display-6">{{$news->title}}</h1><hr>
            <h5>Creator: {{$news->creator->name ?: "Creator Has Been Removed"}}</h5>
            <h5>Category: {{$news->category->name}}</h5>

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <div class="text-center">
                        <img src="{{$news->main_photo}}">
                        <hr>
                    </div>
                    <p class="lead">{!! $news->body !!}</p>
                </div>
            </div>

            <div>
                @foreach(json_decode($news->images) as $img)
                    <img src="/storage/{{$img}}" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
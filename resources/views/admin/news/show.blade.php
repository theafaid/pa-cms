@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-eye"></i> {{$title}}
        </div>
        <div class="card-body">
            <h1 class="display-6">{{$news->title}}</h1><hr>
            <h5>Creator: {{$news->creator->name ?: "Creator Has Been Removed"}}</h5>
            <h5>Category: {{$news->category->name}}</h5><hr>

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <div class="text-center">
                        <img src="{{$news->main_photo}}">
                        <hr>
                    </div>
                    <p class="lead">{!! $news->body !!}</p>
                </div>
            </div>

            <strong>Sub Images Uploaded</strong><hr>
            <div class="row">
                @forelse(json_decode($news->images) as $img)
                    <div class="col-3">
                        <img src="/storage/{{$img}}" class="img-thumbnail img-fluid" style="display: inline"/>
                    </div>
                @empty
                    <div class="alert aler-warning">
                        This news has no Sub Images Uploaded!
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
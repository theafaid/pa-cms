@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        {{$title}}
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('news.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <strong>News Title</strong>
                        <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="News Title">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>Upload Main Photo</strong>
                        <input type="file" class="form-control" name="main_photo" accept="image/*">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>Categories</strong>
                        <select name="category_id" class="form-control">
                            <option value="">Categories</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if(old('category_id') == $category->id) selected @endif>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <strong>News Content</strong>
                        <textarea id="body" name="body" class="form-control">{{old('body')}}</textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input type="file" class="form-control" name="images[]" accept="image/*" multiple>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create a news
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create( document.querySelector( '#body' ) );
    </script>
@endpush
@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-edit"></i>
            {{$title}}
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('categories.update', $category->slug)}}">
                @csrf
                {{method_field('PATCH')}}
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <strong>Category Name</strong>
                            <input type="text" class="form-control" name="name" placeholder="Category Name" value="{{old('name') ?: $category->name}}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-edit"></i> Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
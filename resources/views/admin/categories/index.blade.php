@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        {{$title}}
        <a href="{{route('categories.create')}}" class="btn btn-success float-right">
            <i class="fa fa-plus"></i> New
        </a>
    </div>
    <div class="card-body">
        @if(count($categories))
           <table class="table table-responsive table-hover table-bordered">
               <tr>
                   <th>Name</th>
                   <th>Action</th>
               </tr>
               @foreach($categories as $category)
                   <tr>
                       <td>{{$category->name}}</td>
                       <td>actions</td>
                   </tr>
               @endforeach
           </table>

            {{$categories->links()}}
        @else
        <div class="alert alert-danger">
            Categories table is empty !
        </div>
        @endforelse
    </div>
</div>
@endsection
@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            {{$title}}
            <a href="{{route('news.create')}}" class="btn btn-success float-right">
                <i class="fa fa-plus"></i> New
            </a>
        </div>
        <div class="card-body">
            @if(count($news))
                <table class="table table-hover table-striped table-light table-4-columns">
                    <thead class="thead-dark">
                    <tr>
                        <th>Title</th>
                        <th>Excerpt</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    @foreach($news as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td>{{strip_tags(Str::limit($item->body, 70))}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>
                                <a href="{{route('news.show', $item->slug)}}" class="btn btn-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{route('news.edit', $item->slug)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button  data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form method="POST" action="{{route('news.destroy', $item->slug)}}" id="deleteNewsForm">
                                    @csrf
                                    {{method_field('DELETE')}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

                {{$news->links()}}
            @else
                <div class="alert alert-danger">
                    News table is empty !
                </div>
                @endforelse
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are You Sure To Delete This News ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">I'am Sure</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $("#confirmDeleteBtn").on('click', function(){
                $("#deleteNewsForm").submit();
            });
        });
    </script>
@endpush
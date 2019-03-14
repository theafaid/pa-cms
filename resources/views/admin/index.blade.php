@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Welcome to admin dashboard.</div>

        <div class="card-body">
          <div style="width:100%;">
              @foreach($data as $stat)
                  <div class="dashboard-stat">
                      <i class="{{$stat['icon']}}"></i>
                      <h3>
                          <span class="count">{{$stat['value']}}</span>
                          <span class="desc">{{$stat['title']}}</span>
                      </h3>
                  </div>
              @endforeach
          </div>
        </div>
    </div>
@endsection

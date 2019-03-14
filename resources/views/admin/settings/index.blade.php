@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">{{$title}}</div>
    <div class="card-body">
        <form method="POST" action="{{route('settings.update')}}">
            @csrf
            {{method_field('PATCH')}}
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <i class="fa fa-globe"></i>
                        <strong>Site Name</strong>
                        <input type="text" name="site_name" class="form-control" value="{{$settings['site_name'] ?? old('site_name')}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <strong>Site Name</strong>
                        <input type="email" name="email" class="form-control" value="{{$settings['site_email'] ?? old('site_email')}}">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <i class="fa fa-key"></i>
                        <strong>Site Keywords</strong>
                        <textarea class="form-control" name="site_keywords">{{$settings['site_keywords'] ?? old('site_keywords')}}</textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <i class="fa fa-newspaper-o"></i>
                        <strong>Site Description</strong>
                        <textarea class="form-control" name="site_description">{{$settings['site_description'] ?? old('site_description')}}</textarea>
                    </div>
                </div>
                <div class="col-6">
                    <strong>Maintenance</strong>
                    <i class="fa fa-lock"></i>
                    <select class="form-control">
                        <option value="1" @if($settings['site_open']) selected @endif>Enabled</option>
                        <option value="0" @if(! $settings['site_open']) selected @endif>Disabled</option>
                    </select>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <i class="fa fa-newspaper-o"></i>
                        <strong>Maintenance Message</strong>
                        <textarea class="form-control" name="site_maintenance_message">{{$settings['site_maintenance_message'] ?? old('site_maintenance_message')}}</textarea>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

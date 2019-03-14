@if(count($errors))
    <div class="alert alert-danger">
        @foreach($errors->all() as $err)
            - {{$err}} <br>
        @endforeach
    </div>
@endif

@if($successMsg = session('success'))
    <div class="alert alert-success">{{$successMsg}}</div>
@endif

@if($errMessage = session('error'))
    <div class="alert alert-danger">{{$errMessage}}</div>
@endif
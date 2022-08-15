@extends('layouts.app') 

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <!-- {{$user["name"] }} -->
    <div class="card w-100">
        <div class="card-header d-flex justify-content-between">
            
            <form method='POST' action="/store" enctype = "multipart/form-data">
                @csrf   
                <div class="form-group">
                    <input type="file" name="sample_image">
                </div>
                <button type='submit' class="btn btn-primary btn-lg">保存</button>
            </form>
            
        </div>
        <div class="card-body">
            
        </div>
    </div>
</div>
@endsection
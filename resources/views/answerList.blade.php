@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <!-- {{$user["name"] }} -->
    <div class="card w-100">
        <div class="card-header">解決法一覧</div>
        <div class="card-body">
            <div class="row justify-content-center">
                @foreach($problems as $problem)
                <div class="col-sm-3">
                    <div class="card text-center m-4">
                        <div class="card-body">
                            <h3 class="card-title">{{$problem["name"]}}</h3>
                            <p class="card-text">{{$users[$problem["user_id"]-1]["name"]}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
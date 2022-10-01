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
                            <h3 class="card-title">{{$problem["problem_name"]}}</h3>
                            <p class="card-text">{{$problem["user_name"]}}</p>
                            <a href="/answerDetail/{{$problem['id']}}" class="btn btn-primary">詳細</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
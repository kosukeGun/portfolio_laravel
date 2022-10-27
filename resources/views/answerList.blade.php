@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <!-- {{$user["name"] }} -->
    <div class="card w-100">
        <div class="card-header">解決法一覧</div>
        <div class="card-body">
            <div class="row justify-content-center">
                @foreach($problems as $problem)
                <div class="col-sm-6 col-xs-12 col-md-4 col-lg-3">
                    <div class="card text-center m-4">
                        <div class="card-header" style="height:50px; font-size:20px; padding:auto; background-color:#FF0000;">{{$problem["problem_name"]}}</div>
                        <div class="card-body">
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
@extends('layouts.app')

@section('content')

    <div class="row justify-content-center ml-0 mr-0 h-100">
        <!-- {{$user["name"] }} -->
        <div class="card w-100">
            <div class="card-header">マイページ</div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-sm-5">
                        <div class="card text-center bg-primary" style="width: 80%;">
                            <div class="card-header">
                                名前
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p>{{$user["name"]}}</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="card text-center bg-info" style="width: 80%;">
                            <div class="card-header">
                                メールアドレス
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p>{{$user["email"]}}</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-5">
                        <div class="card text-center" style="width: 80%; margin-top:30px;">
                            <div class="card-header">
                                質問回数
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p>34</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 ">
                        <div class="card text-center" style="width: 80%; margin-top:30px;">
                            <div class="card-header">
                                回答回数
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p>12</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
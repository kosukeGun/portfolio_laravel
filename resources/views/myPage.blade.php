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
                                質問数
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p>{{$count_question}}</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 ">
                        <div class="card text-center" style="width: 80%; margin-top:30px;">
                            <div class="card-header">
                                回答数
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                <p>{{$count_answer}}</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>                
                </div>
                <div class="row justify-content-center">
                    @foreach($memos_answered as $memo)
                    <div class="col-sm-3">
                        <div class="card text-center m-4">
                            <img src="{{ '/storage/' . $memo['image']}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$titles[$memo["title_id"]-1]["name"]}}</h5>
                                <p class="card-text">{{$memo["updated_at"]}}</p>
                                <a href="/edit/{{$memo['id']}}" class="btn btn-primary">再質問</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
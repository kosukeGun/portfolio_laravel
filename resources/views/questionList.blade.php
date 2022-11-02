@extends('layouts.app')

@section('content')
<div class="col-md-12 p-0">
    <div class="row justify-content-center ml-0 mr-0 h-100">
        <!-- {{$user["name"] }} -->
        <div class="card h-100">
            <div class="card-header d-flex">
                質問一覧 
            </div>
            <div class="card-body py-2 px-2">
                <div class="row justify-content-center">
                <button class="btn btn-success" type="button" onclick="location.href='/home/noanswer'">未回答のみ</button>
                    @foreach($memos_all as $memo)
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-3">
                        <div class="card text-center m-4 ">
                            <img width="100%" height="120px" src="data:image/png;base64,<?= $memo["image"] ?>">
                            <div class="card-body">
                                <h5 class="card-title">{{$memo["title_name"]}}</h5>
                                <p class="card-text">{{$memo["user_name"]}}</p>
                                <a href="/edit/{{$memo['id']}}" class="btn btn-primary">回答</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="col-md-12 p-0">
    <div class="row justify-content-center ml-0 mr-0 h-100">
        <!-- {{$user["name"] }} -->
        <div class="card h-100">
            <div class="card-header d-flex">
                質問一覧 
                <a class='ml-auto' href='/create'><i class="fas fa-plus-circle"></i></a> 
                <a href="/home/noanswer">未回答のみ</a>
            </div>
            <div class="card-body py-2 px-2">
                <div class="row">
                    @foreach($memos as $memo)
                    <div class="col-sm-6 col-xs-12 col-md-3 col-lg-2">
                        <div class="card text-center m-4 ">
                            <img src="{{ '/storage/' . $memo['image']}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$titles[$memo["title_id"]-1]["name"]}}</h5>
                                <p class="card-text">{{$users[$memo["user_id"]-1]["name"]}}</p>
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
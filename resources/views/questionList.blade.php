@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <!-- {{$user["name"] }} -->
    <div class="card h-100">
        <div class="card-header d-flex">
            質問一覧 
            <a class='ml-auto' href='/create'><i class="fas fa-plus-circle"></i></a> 
            <a href="/home/noanswer">未回答のみ</a>
        </div>
        <div class="card-body py-2 px-2">
            @foreach($memos as $memo)
            <a href="/edit/{{$memo['id']}}" class = "d-block">{{$titles[$memo["title_id"]-1]["name"]}}</a>
            @endforeach 
        </div>
    </div> 
</div>
@endsection
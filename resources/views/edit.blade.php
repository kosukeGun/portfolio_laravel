@extends('layouts.app') 

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <!-- {{$user["name"] }} -->
    <div class="card w-100">
        <div class="card-header d-flex justify-content-between">
            メモ編集
            <form method='POST' action="/delete/{{$memo['id']}}" id='delete-form'>
                @csrf
                <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>
            </form>
        </div>
        <div class="card-body">
            <form method='POST' action="{{route('update',['id' => $memo['id']])}}">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                    <label for="title">件名</label>
                    <h2>{{$title[0]["name"]}}</h2>
                </div>
                <div class="answer-icon">
                    @if($memo["answer"]==1)
                    <i class="fas fa-solid fa-bookmark"></i>
                    @endif
                </div>
                <div class="form-group">
                    <label for="content">本文</label>
                     <textarea name='content' class="form-control"rows="10">{{$memo["content"]}}</textarea>
                </div>
                <div class="form-group">
                    <label for="tag">タグ</label>
                    <select class='form-control' name='tag_id'>
                @foreach($tags as $tag)
                    <option value="{{ $tag['id'] }}" {{ $tag['id'] == $memo['tag_id'] ? "selected" : "" }}>{{$tag['name']}}</option>
                @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">未回答・回答済み</label>
                    <select class = "form-control" name = "answer">
                        <option value = 0 {{ $memo['answer']==0 ? "selected" : "" }}>未回答</option>
                        <option value = 1 {{ $memo['answer']==1 ? "selected" : "" }}>回答済み</option>
                    </select>
                </div>
                
                <button type='submit' class="btn btn-primary btn-lg">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection
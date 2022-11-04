@extends('layouts.app') 

@section('content')
<div class="p-0">
    <div class="row justify-content-center ml-0 mr-0">
        <!-- {{$user["name"] }} -->
        <div class="card col-xs-12 col-md-6">
            <div class="card-header d-flex justify-content-between">
                質問回答
                @if(isset($memo["problem_name"]))
                <form method='POST' action="/delete/{{$memo['id']}}" id='delete-form'>
                
                    @csrf
                    <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>
                </form>
                @endif
            </div>
            <div class="card-body">
                <form method='POST' enctype="multipart/form-data" action="{{route('update',['id' => $memo['id']])}}">
                    @csrf
                    <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                    
                    <div class="form-group">
                        <label for="title">件名</label>
                        <h1>{{$memo["title_name"]}}</h1>
                    </div>
                    <div class="form-group">
                        <label for="content">質問内容</label>
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
                        <label for="answer">回答状況 </label>
                        <select class="form-control" name="answer">
                            <option value=0 {{ $memo["answer"]==0 ? "selected" : "" }}>未回答</option>
                            <option value=1 {{ $memo["answer"]==1 ? "selected" : "" }}>回答済み</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="problem">悩みの原因</label>
                        @if($memo["problem_name"] != null)
                        <input name='problem' class="form-control" value={{$memo['problem_name']}} placeholder="悩みの原因を入力（”知識不足”など）">
                        @else
                        <input name='problem' class="form-control" placeholder="悩みの原因を入力（”知識不足”など）">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="explain">原因説明</label>
                        @if($memo["problem_explain"] != null)
                        <textarea name='explain' class="form-control">{{$memo['problem_explain']}}</textarea>
                        @else
                        <textarea name='explain' class="form-control"></textarea>
                        @endif
                    </div>
                    <div class="d-grid gap-2 col-4 mx-auto my-4">
                        <button type='submit' class="btn btn-primary btn-lg">更新</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-xs-12 col-md-6">
            <div class="card-header d-flex justify-content-between">
                添付画像
            </div>
            <div class="card-body">
                <form method='POST' enctype="multipart/form-data" action="{{route('update',['id' => $memo['id']])}}">
                    @csrf
                    <div class="form-group my-7">
                        @if($memo["image"] != null)
                        <div style="margin-top:7%;">
                            <img src="data:image/png;base64,<?= $memo["image"] ?>" class='w-100 mb-3'/>
                        </div>
                        @else
                        <div style="background-color:grey; margin:5%; text-align:center; padding:30%;">
                            <h2 style="color:white;">画像無し</h2>
                        </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
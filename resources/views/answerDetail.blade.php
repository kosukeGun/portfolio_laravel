@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <!-- {{$user["name"] }} -->
    @if(session('review_success'))
    <div class="alert alert-success" role="alert">
    {{ session('review_success') }}
    </div>
    @endif
    <div class="card w-100">
        <div class="card-header">{{$problem["name"]}}</div>
        <div class="card-body">
            <div class="row justify-content-center">
                <h1 style="text-align:center;">説明文</h1>
                @if($problem["explain"] != null)
                <p style="text-align:center;">{{$problem["explain"]}}</p>
                @else
                <p style="text-align:center;">説明は登録されておりません。</p>
                @endif
                <form style="text-align:center; margin-bottom:30px;" method='POST' action="/review/{{$problem['id']}}">
                @csrf
                    <div class="form-group">
                        <label for="review_point">点数</label>
                        <select class="form-control" name = "review_point" style="width:10%; margin:auto; margin-top:20px; margin-bottom:20px; ">
                            @for($i = 1; $i < 6; $i++)
                            <option style="text-align:center;" value = {{$i}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="review_comment">コメント</label>
                        <textarea style="width:70%; margin:auto; margin-bottom:30px;" name='review_comment' class="form-control" placeholder="任意"></textarea>
                    </div>
                    <button type='submit' class="btn btn-danger" style="width:100px;">決定</button>
                </form>
                <a href="/answerList" class="btn btn-primary" style="width:100px;">戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
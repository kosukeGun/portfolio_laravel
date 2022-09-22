@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <!-- {{$user["name"] }} -->
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
                <a href="/answerList" class="btn btn-primary" style="width:100px;">戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
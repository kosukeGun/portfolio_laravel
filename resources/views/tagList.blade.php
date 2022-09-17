@extends('layouts.app')

@section('content')
<div class="col-md-12 p-0">
    <div class="row justify-content-center ml-0 mr-0 h-100">
        <!-- {{$user["name"] }} -->
        <div class="card h-100">
            <div class="card-header">タグ一覧</div>
            <div class="card-body py-2 px-4">
                <a class='d-block' href='/'>全て表示</a>
                @foreach($tags as $tag)
                    <a href="/?tag={{$tag['name']}}" class = "d-block">{{$tag["name"]}}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
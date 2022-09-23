@extends('layouts.app')

@section('content')
<div class="col-md-12 p-0">
    <div class="row justify-content-center ml-0 mr-0 h-100">
        <!-- {{$user["name"] }} -->
        <div class="card h-100">
            <div class="card-header">タグ一覧</div>
            <div class="card-body py-2 px-4">
                <a class='d-block' href='/'>全て表示</a>
                @foreach($tags_list as $tag)
                    <a href="/?tag={{$tag['name']}}" class = "d-block">{{$tag["name"]}}</a>
                @endforeach
                <form method='POST' action="/addTag">
                    @csrf
                    <label　for="new_tag">タグを追加</label>
                    <input name='new_tag' type="text" class="form-control" id="tag" placeholder="タグを追加">
                    <button type='submit' class="btn btn-primary btn-lg">追加</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
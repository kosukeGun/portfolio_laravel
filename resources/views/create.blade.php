@extends('layouts.app')

@section('content')

    <div class="row justify-content-center ml-0 mr-0 h-100">
        <!-- {{$user["name"] }} -->
        <div class="card w-50">
            <div class="card-header">新規質問作成</div>
            <div class="card-body">
                <form method='POST' action="/store" enctype = "multipart/form-data">
                    @csrf   
                    <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                    <div class="form-group">
                        <label for="title">件名</label>
                        <input name='title' type="text" class="form-control" id="title" placeholder="件名を入力">
                    </div>
                    
                    <div class="form-group">
                        <label for="content">本文</label>
                        <textarea name='content' class="form-control"rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="sample_image">
                    </div>
                    <button type='submit' class="btn btn-primary btn-lg">保存</button>
                </form>
            </div>
        </div>
    </div>
@endsection
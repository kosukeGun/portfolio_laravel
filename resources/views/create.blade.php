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
                    
                    <div class="form-group my-4">
                        <label for="content">本文</label>
                        <textarea name='content' class="form-control"rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">添付画像</label>
                        <input class="form-control" type="file" id="formFile" name="sample_image">
                    </div>
                    <div class="d-grid gap-2 col-4 mx-auto my-4">
                        <button type='submit' class="btn btn-primary btn-lg">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
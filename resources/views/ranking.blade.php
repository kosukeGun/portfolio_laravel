@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <!-- {{$user["name"] }} -->
    <div class="card w-100">
        <div class="card-header">ランキング</div>
        <div class="card-body">
            <div class="row justify-content-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">average</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($problems_rank as $problem)
                    <tr>
                        <th scope="row">{{$problem["user_id"]}}</th>
                        <td>{{$problem["user_name"]}}</td>
                        <td>{{$problem["average"]}}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="row justify-content-center ml-0 mr-0 h-100">
    <!-- {{$user["name"] }} -->
    <div class="card w-100">
        <div class="card-header">ランキング</div>
        <div class="card-body">
            <div class="row justify-content-center">
            <table class="table table-info table-striped table-bordered" style="text-align:center;">
                <thead class="thead-dark">
                    <tr style="height:50px;">
                        <th style="width:20%;" scope="col">rank</th>
                        <th style="width:60%;" scope="col">name</th>
                        <th style="width:20%;" scope="col">average</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($problems_rank as $index => $problem)
                    <tr style="height:50px;">
                        <th scope="row">{{$index + 1}}</th>
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
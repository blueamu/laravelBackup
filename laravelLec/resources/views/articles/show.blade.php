@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$article->title}}</h1>
        <small>{{$article->user->name}}</small>
        <p>
            {{$article->content}}
            <small>{{$article->created_at}}</small>
            <br><br>
            <div><img src="http://127.0.0.1:8000/cat.png" alt=""></div>
        </p>
    </div>
@stop

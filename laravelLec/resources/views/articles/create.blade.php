@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>포럼 글 목록</h1>
        <hr/>
        <form action="{{ route('articles.store') }}" method="POST">
            @csrf
            <!-- class="form-group"은 브라우저에서 실행되고, 블레이드 부분~~은 php 에서 실행됨
                error가 발생되 errors 객체가 생성되고 'title'이 있으면 'has-error' 
                class를 추가 없으면 ''으로  -->
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} ">
                <label for="title">제목</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" />
                {!! $errors->first('title', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }} ">
                <label for="content">본문</label>
                <textarea name="content" id="content" rows="10" class="form-control">{{old('content')}}</textarea>
                <!-- old() : 유효성 검사에 실패해서 이 페이지로 다시 돌아왔을 때 
                        사용자가 입력했던 값을 유지하기 위한 헬퍼 함수 -->
                {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                저장하기
                </button>
            </div>
        </form>
    </div>
@stop

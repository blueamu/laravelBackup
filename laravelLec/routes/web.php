<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* 
Route::get('/', function () {
    return view('welcome');
});
 */
//Route::get('/', 'WelcomeController@index');
// GET / 요청을 WelcomeController의 index() 메소드로 위임

// Route::resource('wel', 'WelcomeController');

// Login 첫번째
/* 
Route::get('auth/login', function() {
    $credentials = [
        'email' => 'wdj1@yjc.ac.kr',
        'password' => 'password' // 원래는 암호화처리 필요함 Ex) bcrypt('password')
    ]; // 하드코딩, 로그인 화면이 없어 변수로 로그인 시도
    if (! auth()->attempt($credentials)) {
        return "로그인 정보가 정확하지 않습니다.";
    }
    return redirect('protected'); // redirect 는 페이지전환, 라우팅명으로
});

// auth() : 도우미함수, 로그인 처리 객체 반환
// attemp() : 도우미메서드, 로그인 시도
// 성공 : true, 실패 : false 반환

Route::get('protected', function() {
    dump(session()->all());
    // session() 로그인사용자의 세선졍보 객체반환
    // all() 로그인한 사용자의 정보(객체)를 반환

    
    if (! auth()->check()) {
        // check() :로그인한 상태인지 여부 체크    
        return 'Who are you?';
    }
    return 'Welcome'. auth()->user()->name;
    // user() : 로그인한 사용자의 user 테이블 내용을 객체저장한 것
});

Route::get('auth/logout', function() {
    auth()->logout();
    // logout() :로그아웃 처리
    return "Thanks you.";
});
 */

// Login 2번째
Route::resource('/', 'WelcomeController');

Route::get('auth/login', function() {
    $credentials = [
        'email' => 'wdj1@yjc.ac.kr',
        'password' => 'password' // 원래는 암호화처리 필요함 Ex) bcrypt('password')
    ]; // 하드코딩, 로그인 화면이 없어 변수로 로그인 시도
    if (! auth()->attempt($credentials)) {
        return "로그인 정보가 정확하지 않습니다.";
    }
    return redirect('protected'); // redirect 는 페이지전환, 라우팅명으로
});

// auth() : 도우미함수, 로그인 처리 객체 반환
// attemp() : 도우미메서드, 로그인 시도
// 성공 : true, 실패 : false 반환

Route::get('protected', 
    [
        'middleware'=>'auth', // nodeJS 에서는 isLogginedIn 이랑 같은 내용
        'uses'=>function() {
            dump(session()->all());
            return 'Welcome'. auth()->user()->name;
        },
    ]
);

Route::get('auth/logout', function() {
    auth()->logout();
    // logout() :로그아웃 처리
    return "Thanks you.";
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// 즉시로드와 페이징 테스트 (p.100)
Route::resource('articles', 'ArticlesController');

/* DB::listen(function ($query) {
    var_dump($query->sql); // dump($query) 로 사용가능
}); */

Route::get(
	'reqjson',
	function() {
		//$data = ['name'=>'김영진', 'gender'=>'남'];  // 연관배열
        $data = \App\Article::get();
        
        
		return response()->json(compact('data'));
	}
);

Route::get('mail', function() {
    $article = App\Article::with('user')->find(1);

    return Mail::send( 
        # 인수1 : 메일내용의 뷰파일      #인수2 : 뷰에 전달할 데이터
        'emails.articles.created',
        compact('article'),
        function ($message) use ($article) {
            # use ()
            # inner function 에서 outer function 의 변수를 사용할 수 있다. 
            #( 자바스크립트는 그냥 사용, php 는 명시적으로 선언 해 줘야함.)
            $message->to('youngjoon5877@gmail.com');
            $message->subject('새 글이 등록되었습니다. -' . $article->title);
        }
    );
});

Route::get('markdown', function () {
    $text =<<<MARK
# 마크 다운 예제 1

이 문서는 [마크다운][1]으로 썼습니다. 화면에는 HTML로 변환되어 출력됩니다.

## 순서 없는 목록

- 첫 번째 항목
- 두 번째 항목[^1]

[1] : http://daringfireball.net/projects/markdown

[^1] : 두 번째 항목_ http://google.com
MARK;
    return app(ParsedownExtra::class)->text($text);
    // app() : 헬퍼함수 - 의존성 주입 (p.160)
});


Event::listen('article.created', function($article) {
    var_dump('이벤트 받음, 받은 데이터 표시');
    var_dump($article->toArray());
});

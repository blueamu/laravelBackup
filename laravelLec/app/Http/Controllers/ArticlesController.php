<?php

namespace App\Http\Controllers;
// package App.Http.Controllers;

use Illuminate\Http\Request;

use App\Http\Request\ArticlesRequest;
// use === import
// use App\Http\Request\ArticlesRequest as AR;
/* 
class ArticlesController extends Controller
{
    public function index() {
        // $articles = \App\Article::get(); // N+1 쿼리문제 발생
        
        $articles = \App\Article::with('user')->get(); // 즉시 로딩(eager load) 발생
        
        // $articles = \App\Article::get();
        // $articles->load('user'); // lazy loading(지연 로딩) 발생
        
        $articles = \App\Article::latest()->paginate(5);

        return view('articles.index', compact('articles'));
    }

    public function create() {
        return view('articles.create');
    }

    public function store(Request $request) {
        $rules = [
            'title'=>['required'],
            'content'=>['required', 'min:10'],
        ];
        // 유효성 검사 규칙 설정,   '필드 => '검사조건'
        // https://laravel.kr/docs/6.x/validation#Validation-%EC%9C%A0%ED%9A%A8%EC%84%B1%20%EA%B2%80%EC%82%AC

        $messages = [
            'title.required' => '제목은 필수 입력 항목입니다.',
            'content.required' => '본문은 필수 입력 항목입니다.',
            'content.min' => '본문은 최소 :min 글자 이상이 필요합니다.',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        // make() 메서드의 첫 번째 인자는 검사의 대상이 되는 폼 데이터, 
        //                    두 번째는 검사 규칙, 
        //                    세 번째는 사용자 정의 오류 메세지 지정

        // $this->validate($request, $rules, $messages);
        // Illuminate/Foundation/Validation/ValidatesRequests 트레이트 를 부모클래스(컨트롤러클래스)에서 사용할수 있도록 설정되어 있음

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $article = \App\User::find(1)->articles()->create($request->all());

        if (! $article) {
            return back()->with('flash_message', '글이 저장되지 않았습니다.')->withInput();
        }

        return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
    }
}
 */

// 트레이트의 메서드 이용
 /* 
class ArticlesController extends Controller
{
    public function index() {
        // $articles = \App\Article::get(); // N+1 쿼리문제 발생
        
        $articles = \App\Article::with('user')->get(); // 즉시 로딩(eager load) 발생
        
        // $articles = \App\Article::get();
        // $articles->load('user'); // lazy loading(지연 로딩) 발생
        
        $articles = \App\Article::latest()->paginate(5);

        return view('articles.index', compact('articles'));
    }

    public function create() {
        return view('articles.create');
    }

    public function store(Request $request) {
        $rules = [
            'title'=>['required'],
            'content'=>['required', 'min:10'],
        ];
        // 유효성 검사 규칙 설정,   '필드 => '검사조건'
        // https://laravel.kr/docs/6.x/validation#Validation-%EC%9C%A0%ED%9A%A8%EC%84%B1%20%EA%B2%80%EC%82%AC

        $messages = [
            'title.required' => '제목은 필수 입력 항목입니다.',
            'content.required' => '본문은 필수 입력 항목입니다.',
            'content.min' => '본문은 최소 :min 글자 이상이 필요합니다.',
        ];

        // $validator = \Validator::make($request->all(), $rules, $messages);
        // make() 메서드의 첫 번째 인자는 검사의 대상이 되는 폼 데이터, 
        //                    두 번째는 검사 규칙, 
        //                    세 번째는 사용자 정의 오류 메세지 지정

        $this->validate($request, $rules, $messages);
        // Illuminate/Foundation/Validation/ValidatesRequests 트레이트 를 부모클래스(컨트롤러클래스)에서 사용할수 있도록 설정되어 있음

        // if($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }

        $article = \App\User::find(1)->articles()->create($request->all());

        if (! $article) {
            return back()->with('flash_message', '글이 저장되지 않았습니다.')->withInput();
        }

        return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
    }
} */

// 폼 리퀘스트 클래스 이용

class ArticlesController extends Controller
{
    public function index() {
        // $articles = \App\Article::get(); // N+1 쿼리문제 발생
        
        $articles = \App\Article::with('user')->get(); // 즉시 로딩(eager load) 발생
        
        // $articles = \App\Article::get();
        // $articles->load('user'); // lazy loading(지연 로딩) 발생
        
        $articles = \App\Article::latest()->paginate(5);

        return view('articles.index', compact('articles'));
    }

    public function create() {
        return view('articles.create');
    }

    public function store(\App\Http\Requests\ArticlesRequest $request) {
        // store(\App\Http\Requests\ArticlesRequest $request)
        // store(ArticlesRequest $request)
        $article = \App\User::find(1)->articles()->create($request->all());

        if (! $article) {
            return back()->with('flash_message', '글이 저장되지 않았습니다.')->withInput();
        }

        var_dump('이벤트 throw');
        # 첫번째 이벤트 예제
        // event('article.created', [$article]);
        // event(인자1, 인자2) : 인자1의 이벤트명, 인자2(배열)의 이벤트 데이터를 가지고 이벤트를 fire 함수
        // fire 함수 : 방출하는 함수 , 이벤트 발생 알림
        # 두번째 이벤트 예제
        // event(new \App\Events\ArticleCreated($article));
        // var_dump('이벤트 throw 완료');
        // //return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');
        # 세번째 이벤트 예제
        event(new \App\Events\ArticlesEvent($article));
        var_dump('이벤트3 throw 완료');
        return redirect(route('articles.index'))->with('flash_message', '작성하신 글이 저장되었습니다.');

    }

    public function show($id) {
        // echo $foo;
        // return __METHOD__ . '은(는) {$id}의 값을 조회';
        $article = \App\Article::findOrFail($id);

        return $article->toArray();
        // Illuminate\Database\Eloquent\ModelNotFoundException 
        // 예외 발생 가능성
    }
}

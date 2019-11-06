<?php

namespace App\Listeners;

// use App\Events\article.created;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ArticlesEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  article.created  $event
     * @return void
     */
    // public function handle(article.created $event)
    # 첫번째 이벤트 예제
    // public function handle(\App\Article $article)
    // { // 이벤트 처리하는 메서드
    //     var_dump('이벤트 받음, 받은 데이터 표시');
    //     var_dump($article->toArray());
    // }
    # 두번째 이벤트 예제
    // public function handle(\App\Events\ArticleCreated $event)
    // { // 이벤트 처리하는 메서드
    //     var_dump('이벤트 받음, 받은 데이터 표시한다.');
    //     var_dump($event->article->toArray());
    // }
    # 세번째 이벤트 예재
    public function handle(\App\Events\ArticlesEvent $event)
    { // 이벤트 처리하는 메서드
        if ($event->action === 'created') {
            \Log::info(sprintf(
                '새로운 포럼 글이 등록되었습니다.: %s',
                $event->article->title
            ));
        }
    }
}

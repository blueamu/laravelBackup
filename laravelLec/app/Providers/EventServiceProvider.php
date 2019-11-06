<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\ArticlesEvent::class => [
            \App\Listeners\ArticlesEventListener::class,
        ],
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\UsersEventListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // \Event::listen('article.created', 
        //     function($article) { // 클로저
        //     var_dump('이벤트 받음, 받은 데이터 표시');
        //     var_dump($article->toArray());
        // });
        // 전역 안에 있는 파사드를 끌어오게 하기 위해 Event 앞에 \ 를 붙여야 함
        # 첫번째 이벤트 예제
        // \Event::listen(
        //     'article.created',
        //     \App\Listeners\ArticlesEventListener::class);
        # 두번째 이벤트 예제
        \Event::listen(
            \App\Events\ArticleCreated::class,
            \App\Listeners\ArticlesEventListener::class);
    }
}

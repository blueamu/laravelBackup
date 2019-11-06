<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all(); // $users 는 User 테이블의 모든 데이터가 들어가 있음

        $users->each(function ($user) { 
            // each() 는 객체(사용자) 수 만큼 function 함수를 반복
            $user->articles()->save(
                factory(App\Article::class)->make()
            );
        });
    }
}

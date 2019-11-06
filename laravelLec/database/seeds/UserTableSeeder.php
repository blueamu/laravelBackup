<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* App\User::create([
            'name'=>sprintf('$s $s', Str::random(3), Str::random(4)),
            // sprintf(인수1 [, 인수2, ...]) : 인수1에 지정한 형식으로 문자열 반환
            // ** 6.x에서 지원 x ** str_random(인수) : 인수에 지정한 길이의 문자열 반환
            // Str::random(인수) 로 사용
            // sprintf(str_random(3).' '.str_random(4)) 으로도 사용 가능
            'email'=>Str::random(10) . '@yjc.ac.kr',
            'password'=>bcrypt('password'),
        ]); */

        factory(App\User::class, 5)->create();
    }
}

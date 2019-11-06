<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() // 스키마 생성 및 수정 코드
    {
        Schema::create(
            'posts',  // 스키마 생성 테이블명
            function (Blueprint $table) { // 생성코드
                $table->bigIncrements('id'); // 자동 증가 기본키 설정
                $table->string('title'); // VARCHAR
                $table->string('body'); // TEXT
                $table->timestamps(); // created_at, update_at 필드 생성
                // $table->json(); // mysql 5.7 이상에서 작동
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // 스키마 삭제 코드
    {
        Schema::dropIfExists('posts');
    }
}

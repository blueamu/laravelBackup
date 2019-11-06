<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'authors', 
            function (Blueprint $table) {
                $table->bigIncrements('id'); // 자동 증가 기본키 설정
                $table->string('email', 255); // email
                $table->string('password', 60); // password
                $table->string('nick', 50);
                $table->timestamps(); // created_at, update_at 필드 생성
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // 스키마 삭제 코드
    {
        Schema::dropIfExists('authors');
    }
}

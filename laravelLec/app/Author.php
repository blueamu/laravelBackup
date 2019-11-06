<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // authors 라는 table 생성됨
    // 테이블명 바꿔서 (관례를 벗어나서) 생성하고 싶다면 
    //  ==> 모델 소스코드파일에서 protected $table = 'users';  (p.045)
    public $timestamps = false;
    //create_at, updated_at 필드를 사용하지 않게 설정
    
    protected $fillable = ['email', 'password', 'nick']; 
}

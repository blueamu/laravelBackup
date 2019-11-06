<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'content'];

    public function user() { // 함수명을 user()로 하는 것이 관례
        return $this->belongsTo(User::class); // articles은 User의 클래스에 속해있다
    }

    public function tags() {
        return $this->belongsToMany(Tag::class); // articles는 많은 Tag의 클래스에 속해있다
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function articles() {
        return $this->belongsToMany(Article::class); // Tag 는 많은 Article에 속해있다.
    }
}

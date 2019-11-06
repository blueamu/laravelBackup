<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable; // 트레이트

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ // MassAssignment 가능하게 설정
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ // select 시, get() 할 때 필드조회 방지
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles() {
        return $this->hasMany(Article::class); // User는 많은 articles를 가지고 있다
    }

    protected $dates = ['last_login'];
    // 시각에 관련된 필드 설정해 주면 라라벨에서 해당 값을 제공해줌
}

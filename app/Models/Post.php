<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'path',
    ];

    public function likes()
    {
      return $this->hasMany('App\Models\Like');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function like_by()
    {
      return Like::where('user_id', \Auth::user()->id)->first();
      //Likeテーブルのidをログイン中のユーザーのidを取得
    }
}

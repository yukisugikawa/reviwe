<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Like;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'path',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function likes()
    {
      return $this->hasMany('App\Models\Like');
    }

    public function like_by()
    {
      return Like::where('user_id', Auth::user()->id)->first();
      //Likeテーブルの中にあるuser_id（ログインid）を取得してする
    }
}

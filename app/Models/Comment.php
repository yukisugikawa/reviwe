<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'post_id',
        'created_at',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Like;
use App\Models\Post;
use Auth;

class LikesController extends Controller
{
    public function store(Request $request, $post_id)
    {
        Like::create(
          array(
            'user_id' => Auth::user()->id,
            'post_id' => $post_id
          )
        );

        $post = Post::findOrFail($post_id);

        return redirect()->action('PostController@show', $post->id);
    }

    public function destroy($post_id, $like_id) {
      $post = Post::findOrFail($post_id);
      $post->like_by()->findOrFail($like_id)->delete();
      //いいねしたidを所得して、like_idを削除
      return redirect()->action('PostController@show', $post->id);
    }
}

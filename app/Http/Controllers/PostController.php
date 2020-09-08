<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

use App\Models\Post;
use Image;
use Auth;

class PostController extends Controller
{
    //アクセス制限、投稿を見るだけ
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $items = Post::with('user')->get();

        return view('post.index', compact('items'));
        // //postを新しい順で取得する
        // $items = Post::orderBy('created_at', 'desc')->get();
        // return view('post.index', compact('items', 'like'));
        // // DBから取得した値（$itemの内容）をpost.indexに渡してblade側で使用
    }

    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = $request->user()->id;//postのuser_id取得

        //ファイルが存在しているか
        if($request->hasFile('path')){
            $file = $request->file('path');//ファイルを取得
            $filename = time() . $file->getClientOriginalName();//ファイル名取得
            Image::make($file)
                ->resize(300, 300)
                ->save(public_path( 'storage/post_image/' . $filename ));
            $post->path = $filename;
        }
        $post->save();

        return redirect('/post')->with('success', '投稿しました！');
    }

    public function show($id)
    {
        // DBよりURIパラメータと同じIDを持つPostの情報を取得
        // post->comenntsでリレーションを取得して並び替え
        $post = Post::findOrFail($id);
        // $post = Post::with('comment')->findOrFail($post_id);
        $comments = $post->comments()->orderBy('created_at', 'desc')->get();
        return view('post.show', compact('post', 'comments', 'likes'));
    }

    public function edit($id)
    {
        // $post = Post::findOrFail($post_id);
        $post = Post::with('comment')->findOrFail($id);
        return view('post.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;

        if ($request->file('path')->isValid()) {
            $file = $request->file('path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(300, 300)->save( public_path('public/post_image/' . $filename ) );

            $post->file = $filename;
        }
        $post->save();
    }

    public function destroy($id)
    {
        $items = Post::find($id)->delete();
        return redirect('/post');
    }

}

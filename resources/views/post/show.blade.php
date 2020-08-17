@extends('layouts.app')
@section('title', '詳細記事')

@section('content')

<div class="container">
    <div class="row">
        <div class="mx-auto" style="width: 700px;">

            <div class="border p-4">

                <!-- postの内容 -->
                <img src="{{ asset('storage/post_image/' . $post->path) }} " style="height: 225px; width: 100%;">

                <p class="mb-5">{{ $post->user->name }}</p>
                <h1 class="h5 mb-4">{{ $post->title }}</h1>
                <p class="mb-5">{!! nl2br(e($post->body)) !!}</p>

                @if ($comments->count())
                        コメント {{ $comments->count() }}件
                @endif

                <!-- succeseメッセージ -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- エラーメッセージ -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                {{ Form::open(['action' => 'CommentController@store', 'method' => 'post']) }}
                    {{ Form::textarea('comment', '', ['id' => 'comment', 'rows' => '3', 'class' => 'form-control']) }}
                    {{ Form::hidden('post_id',$post->id) }}
                    <div class="text-right">
                        {{ Form::submit('コメントする', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}

                <!-- コメント欄 -->
                @forelse($comments as $comment)
                    <div class="border-top p-4">
                        <p class="mt-2">{{ $comment->user->name }}</p>
                        <!-- <p class="mt-2">{{ $post->user->name }}</p> -->
                        <p class="mt-2">{!! nl2br(e($comment->comment)) !!}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">削除</button>
                            </div>
                            <small class="text-muted">{{ $comment->created_at}}</small>
                        </div>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
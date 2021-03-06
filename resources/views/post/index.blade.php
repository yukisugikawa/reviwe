@extends('layouts.app')
@section('title', '投稿アプリ')

@section('content')
    @section('maincopy', '投稿してください')

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">飲食店のレビューサイト</h1>
      <p class="lead text-muted">行きつけのお店や、お勧めのお店をみんなに紹介しましょう。</p>

      <!-- successメッセージ -->
      @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
      @endif

      <!-- エラー -->
      @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
      @endif

      <!-- form -->
      {{ Form::open(['action' => 'PostController@index', 'method' => 'post' , 'enctype' => 'multipart/form-data']) }}
        <p>タイトル<br/>{{ Form::text('title', '', ['id' => 'title', 'size' => 50]) }}</p>
        <p>内容<br/>{{ Form::textarea('body', '', ['id' => 'body', 'size' => '50x3']) }}</p>
        {{ Form::file('path') }}
        <div>
            {{ Form::submit('投稿', ['class' => 'btn btn-success btn-lg']) }}
        </div>
      {{ Form::close() }}
    </div>
  </section>

    <!-- 投稿部分 -->
  <div class="album py-5 bg-light">
      <div class="container">
      <div class="row">
      @forelse($items as $item)
          <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
              <a href="{{ route('post.show', [$item->id]) }}">
                <img src="{{ asset('storage/post_image/' . $item->path) }}" class="index-imag">
              </a>
              <div class="card-body">
              <p class="card-text">{{ $item->user->name }}</p>
              <p class="card-text">{{ $item->title}}</p>
              <p class="card-text">{{ $item->body}}</p>
              <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">編集</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">削除</button>
                  </div>

                  <!-- コメント -->
                  <a href="{{ route('post.show', [$item->id]) }}">
                      <i class="far fa-comment"></i>
                      @if ($item->comments->count())
                          {{ $item->comments->count() }}
                      @endif
                  </a>

                  <!-- いいね -->
                  <a href="{{ route('post.show', [$item->id]) }}">
                      <i class="far fa-heart"></i>
                      @if ($item->likes->count())
                          {{ $item->likes->count() }}
                      @endif
                  </a>

                  <small class="text-muted">{{ $item->created_at}}</small>
              </div>
              </div>
          </div>
          </div>
        @empty
            <div>投稿記事がありません</div>
        @endforelse
      </div>
    </div>
  </div>
@endsection
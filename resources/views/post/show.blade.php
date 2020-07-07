@extends('layouts.app')
@section('title', '詳細記事')

@section('content')
    @section('maincopy', '詳細記事')

    @if($item !== '')
        <div class="headcopy">Title</div><hr>
        <div class="text">{{ $item->title }}</div>

        <div class="headcopy">Message</div><hr>
        <div class="text">{{ $item->message }}</div>
    @endif

    <a href="/post"><img src="{{ asset('img/edit.svg') }}" class="add" alt="topへ"></a>
@endsection
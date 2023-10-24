<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href= "{{ asset('css/app.css') }}" >
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

@extends('layouts.app')

@section('content')

    <div class="header">
        @include('works.header')
    </div>

@if(count($works) > 0)
    <h1>キーワード検索結果: "{{ $keyword }}"</h1>

    <div class="container position-relative">
        <img  id="myImage" src="{{ asset('img/indexwindow.png') }}" class="img-fluid" alt="">
            
        <div class="position-absolute top-50 start-50 translate-middle text-center">

            <table class="table table-striped">
                @foreach ($works as $work)
                    <tr>
                        <th>{{ $work->title }}</th>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('storage/images/' . $work->image_path) }}" alt="{{ $work->title }}" width="100%"></td>
                    </tr>
                @endforeach

                </table>

<table class="table table-striped" >
    <thead>
        <!-- テーブルのヘッダーを設定 -->
    </thead>
    <tbody>
        @foreach ($works as $work)    
            <tr>
                <td style="width: 100px;">季節</td>
                <td>{{ $work->season_id }}</td>
            </tr>
            <tr>
                <td style="width: 100px;">材料</td>
                <td>{{ $work->material }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="toSearch">
                <a href="{{ route('search') }}">検索ページへ戻る</a>
            </div>
        </div>
        <div class="mb-4 d-flex justify-content-center">
            {{ $works->appends(['keyword' => $keyword, 'season_id' => $season_idId])->links('pagination::bootstrap-4') }}
        </div>
    </div>

@else
    <div class="message">
        <h1>該当する作品は見つかりませんでした。</h1>
        <img src="{{ asset('img/gomennyasai.png') }}"alt="" class="gomennyasai">
    </div>
@endif

@endsection
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
</head>

<body>
@extends('layouts.app')

@section('content')

    <div class="header">
        @include('works.header')
    </div>

@if($works->isEmpty())
    <div class="message">
        <h1>投稿作品はまだありません。</h1>
        <img src="{{ asset('img/gomennyasai.png') }}" alt="" class="gomennyasai">
    </div>
@else

@foreach ($works as $work)
    <h1>自分の作品一覧</h1>
@endforeach

<div class="container position-relative">
        <img  id="myImage" src="{{ asset('img/indexwindow.png') }}" class="img-fluid" alt="">
            
            <div class="position-absolute top-50 start-50 translate-middle text-center">

    <table class="table table-striped">
        @foreach ($works as $work)
            <tr>
                <th>{{ $work->title }}</th>
            </tr>
            <tr>
                <td><img src="{{ asset('storage/images/' . $work->image_path) }}" alt="{{ $work->title }}" width="100%"></td></td>
            </tr>

        @endforeach
    </table>


<table class="table table-striped" >
      
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

            <tr>
                <td>
                    <a href="{{ route('works.edit', ['work' => $work->id]) }}" class="btn btn-primary">編集</a>
                </td>

                <td>
                    <form method="post" action="{{route('works.destroy',['work' => $work->id])}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？')">
                            削除
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

<div class="likes-count" data-work-id="{{ $work->id }}">いいね数: Loading...</div>

<div class="toSearch">
    <a href="{{ route('search') }}">検索ページへ戻る</a>
</div>

</div>
        <div class="mb-4 d-flex justify-content-center">
            {{ $works->links('pagination::bootstrap-4') }}
        </div>

@endif


<script>
  // ページ読み込み時にいいね数を取得して表示
  document.addEventListener("DOMContentLoaded", function() {
        var workId = "{{ $work->id }}";
        var likesCountElement = document.querySelector('.likes-count[data-work-id="' + workId + '"]');
        
        // いいね数を取得するためのAjaxリクエストを送信
        fetch('/works/' + workId + '/likes')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.likes !== undefined) {
                    likesCountElement.textContent = 'いいね数: ' + data.likes;
                }
            });
    });
</script>








@endsection





    
</body>
</html>


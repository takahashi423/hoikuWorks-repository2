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


<body>

<div class="container">
    <div class="header2">
        @include('works.header')
    </div>
    
    
    <div class="position-relative">
        <img  id="myImage" src="{{ asset('img/footer.png') }}" class="img-fluid" alt="">
            
            <div class="position-absolute top-50 start-50 translate-middle text-center">
    
                <button type="button" class="btn  btn-success btn-lg custom-button" style="width:400px; margin-bottom:50px" id="postButton">投稿する</button>
                <br>
                <button type="button" class="btn  btn-danger btn-lg custom-button" style="width:400px" id="searchButton">閲覧する</button>
                
            </div>
    </div>

    @guest
    <!-- ユーザーがログインしていない場合に表示されるコード -->
    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
@else
    <!-- ユーザーがログインしている場合に表示されるコード -->
    <a class="nav-link" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@endguest

</div>


    <script>
        $(document).ready(function() {
            $("#postButton").click(function() {
                // 投稿するボタンがクリックされたときの処理
                window.location.href = "{{ route('create') }}";
            });
        });

        $(document).ready(function() {
            $("#searchButton").click(function() {
                // 投稿するボタンがクリックされたときの処理
                window.location.href = "{{ route('search') }}";
            });
        });

    </script>
@endsection

</body>
</html>
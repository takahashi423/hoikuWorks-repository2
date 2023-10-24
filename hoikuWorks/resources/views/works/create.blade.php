<!DOCTYPE html>
<html lang="en">
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
    
</head>


@extends('layouts.app')

@section('content')
<body>

    <div class="header">
        @include('works.header')
    </div>


    <div class="position-relative">
        <img src="{{ asset('img/workswindow.png') }}" class="img-fluid" alt="">
    
        <div class="title position-absolute top-50 start-50 translate-middle text-center">
            <h1>作品投稿</h1>
            <form action="{{ route('create_post') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="title">作品名</label>
                    <input type="text" class="form-control" id="title" name="title" required>    
                </div>

                <div class="form-group">
                    <label for="season_id">季節</label>
                    <select class="form-control" id="season_id" name="season_id">
                        <option value="春">春</option>
                        <option value="夏">夏</option>
                        <option value="秋">秋</option>
                        <option value="冬">冬</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="material">材料</label>
                    <textarea class="form-control"  id="material" name="material" rows="4" required></textarea>
                </div>

                <!-- 画像追加 -->
                <div class="form-group">    
                    <label for="image">画像を選択</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>

                <button type="submit" class="btn btn-primary upload-btn" style="width:400px">確認する</button>

            </form>
        </div>
    </div>
</body>

@endsection
</html>
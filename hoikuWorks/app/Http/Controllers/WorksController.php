<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Like;

use Illuminate\Support\Facades\DB;


class WorksController extends Controller
{
    // 作品の作成フォーム表示
    public function create()
    {
        return view('works.create');
    }

    
    // 作品の作成（作品名、季節、材料、画像）
    public function create_post(Request $request)
    {
        // バリデーションルールを定義
        $request->validate([
            'title' => 'required',
            'season_id' => 'required',
            'material' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 画像をアップロードし、パスを取得
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images'); //imagesフォルダに画像保存
            $imagePath = explode('/',$imagePath);  //第一引数をもとに文字列を分け配列にする
            $imagePath = end($imagePath); //配列の最後を変数にする
// dd($imagePath);
        } else {
            return redirect()->route('create')->with('error', '画像がアップロードされていません。');
        }

        // 作品データをセッションに保存
        $workData = [
            'title' => $request->input('title'),
            'season_id' => $request->input('season_id'),
            'material' => $request->input('material'),
            'image_path' => $imagePath,
        ];

        $request->session()->put('work_data', $workData);
// dd($request->all());
        
        // 確認画面にリダイレクト
        return redirect()->route('createConfirm');
    }


    public function createConfirm(Request $request)
    {
        // セッションから投稿フォームデータを取得
        $workData = $request->session()->get('work_data');


        // 確認画面ビューに投稿フォームデータを渡す
        return view('works.createConfirm', ['workData' => $workData]);
    }



    public function createComplete()
    {
        return redirect('createComplete');
    }


    public function complete_send(Request $request)
    {

        $workData = $request->session()->get('work_data');
// dd($workData);

        //データベースへ保存
        $work = new Work();
        $work->user_id = auth()->user()->id; //ユーザーID
        $work->title = $workData['title'];
        $work->image_path = $workData['image_path'];
        $work->material = $workData['material'];
        $work->season_id = $workData['season_id'];

        $work->timestamps =false;
        $work->save();

        //セッションから作品データを削除
        $request->session()->forget('work_data');

        return view('works.createComplete');
    }


    
    


        
}
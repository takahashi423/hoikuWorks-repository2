<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Work;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    //全投稿一覧表示
    public function allIndex()
    {
        // $works=Work::all();
        $works=Work::paginate(1);
        return view('works.allIndex', compact('works'));
    }
    
    
    //検索画面の表示
    public function search()
    {
        return view( 'works.search' );
    }

    //自身の投稿一覧表示
    public function myIndex()
    {
        // ログインユーザーの ID を取得
        $userId = auth()->id();
    
        // ページネーションを含むユーザーごとの作品一覧を取得
        $works = Work::where('user_id', $userId)->paginate(1); 

        // いいね数を取得
        foreach ($works as $work) {
            $work->likesCount = $this->getLikesCount($work->id);
        }

        return view('works.myIndex', compact('works'));    
    }

    //検索表示
    public function searchIndex(Request $request)
    {
        // ユーザーが入力したキーワードと季節を取得
    $keyword = $request->input('keyword');
    $season_idId = $request->input('season_id');
    
    // クエリビルダーを作成
    $query = Work::query();

    // キーワードを含む作品を検索
    if (!empty($keyword)) {
        $query->where('material', 'like', "%{$keyword}%");
    }

    // 季節を指定して検索
    if (!empty($season_idId)) {
        $query->where('season_id', $season_idId);
    }

    // キーワードと季節が両方指定されていない場合、季節のみで検索
    if (empty($keyword) && !empty($season_idId)) {
        $query->where('season_id', $season_idId);
    }

    // ページネーションを適用
// dd($season_idId);
    $works = $query->paginate(1); 
    
    return view('works.searchIndex', compact('works', 'keyword', 'season_idId'));
        
    }


    //削除メソッド
    public function destroy(Work $work)
    {
       $work->delete();
        return redirect()->route('search');
    } 

    //編集メソッド
    public function edit(Work $work)
    {
        return view('works.edit', compact('work'));
    }

    //編集内容を更新
    public function update(Request $request, Work $work)
    {
    // dd($request->all());
        //バリデーション
        $validated = $request->validate ([
            'title' => 'required|string|max:255',
            'season_id' => 'required|string|max:255',
            'material' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // リクエストデータに認証ユーザーのIDを追加
        $validated['user_id'] = auth()->id();

         // 新しい画像がアップロードされた場合に画像を保存し、既存の画像を置き換える
        if ($request->hasFile('image')) {
            $newImagePath = $request->file('image')->store('public/images');
            $newImagePath = basename($newImagePath);
            $validated['image_path'] = $newImagePath;
           
            $work->update($validated);

            $request->session()->flash('message','更新しました');
            return redirect()->route('search');

        }   
    }


    public function toggleLike($workId)
    {
        $work = Work::findOrFail($workId);
        
        // 認証済みユーザーを取得
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'ログインしてください'], 403);
        }

        // 作品に対するユーザーのいいねを切り替える
        $user->toggleLike($work);
        
        // いいねの累計を取得
        $likesCount = $work->likes()->count();

        return response()->json(['likes' => $likesCount]);
    }

    //ページリロード時にいいね数を取得して表示
    public function getLikesCount($workId)
    {
        $work = Work::findOrFail($workId);

        $likesCount = $work->likes()->count();
        return response()->json(['likes' => $likesCount]);
    }




        // パスワード編集フォームを表示
        public function editPassword(Work $work)
        {
            return view('works.editPassword', compact('work'));
        }

        // パスワードを更新
        public function updatePassword(Request $request, Work $work)
        {
            // パスワードのバリデーションルール
            $rules = [
                'password' => 'required|string|min:6|confirmed',
            ];

            // バリデーション実行
            $this->validate($request, $rules);

            // パスワードをハッシュ化して保存
            $work->password = bcrypt($request->password);
            $work->save();

            return redirect()->route('works.main', ['work' => $work])
                ->with('success', 'パスワードが更新されました');
        }
    }



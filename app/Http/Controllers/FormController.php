<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormsRequest;
use App\Form; /* Formモデル（テーブル）を使う */
use App\Coment;
use App\Bookmark;


class FormController extends Controller
{
    public function postpage (Request $request)
    {
        return view ('users.form');
    }

    public function savenew (FormsRequest $request)
    {
        $post = new Form; /*formsテーブルに新規で書き込むためnewと宣言している*/
     
        /*$request->title(フォームで送信されたタイトル)を、
        $post->title(formsテーブルのtitleカラムに新規で保存する)*/
        $post->title = $request->title;
        $post->main = $request->main;
        $post->user_id = Auth::id();
        $post->lat = $request->lat;
        $post->lon = $request->lon;
        $post->address = $request->address;
        $post->spot_name = $request->spot_name;
        
        $post->save(); /*データーベースに保存が実行*/
    
        // 画像の保存
        if($request->post_img){

            if($request->post_img->extension() == 'gif' 
            || $request->post_img->extension() == 'jpeg' 
            || $request->post_img->extension() == 'jpg' 
            || $request->post_img->extension() == 'png')
            {
                
            // 投稿された時のみ、画像以外の拡張子の場合は保存しない
            $request->file('post_img')
            ->storeAs('public/post_img', $post->id.'.'.$request->post_img->extension());
            }
        }
        return view('users.form'); /*元の投稿フォームのページにリダイレクト*/
    }
    
    /*検索機能*/
    public function index (Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Form::query();

        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('main', 'LIKE', "%{$keyword}%")
                ->orWhere('spot_name', 'LIKE', "%{$keyword}%");/*タイトル・本文・タグ部分一致*/
        }

        $data = $query->get();

        return view('web.index', compact('data', 'keyword'));
    }
    
     public function favorite(Form $form)
     {
         $user = Auth::user();

         if ($user->hasFavorited($form)) {
             $user->unfavorite($form);
         } else {
             $user->favorite($form);
         }
 
         return redirect()->route('form.show', ['id' => $form->id]); 
     }
    
    /*function show ( )の中にRequest, $requestではなく、今回は
    フォームに入力された値ではなく、URLの{ }の部分(パラメーター)を
    $id(変数)として受け取るので($id)としています。*/
    public function show($id)
    {
        $query = Coment::query();
        $query->where('form_id', '=', $id);
        $coments = $query->get();

        $data = Form::where('id', $id)->first();
        
        return view('show')->with(['data'=>$data, 'coments'=>$coments, 'user_id'=>Auth::id() ]);
    }
    
    public function destroy($id)
    {
        // Formsテーブルから指定のIDのレコード1件を取得
        $data = Form::find($id);
        // レコードを削除
        $data->delete();
        // 削除したら前の画面に戻る
        return back();
    }

}

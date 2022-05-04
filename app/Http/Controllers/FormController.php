<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form; /* Formモデル（テーブル）を使う */

class FormController extends Controller
{
    public function postpage (Request $request){
     return view ('users.form');
    }
    
    public function savenew (Request $request){
        
        $post = new Form; /*formsテーブルに新規で書き込むためnewと宣言している*/
     
        /*$request->title(フォームで送信されたタイトル)を、
        $post->title(formsテーブルのtitleカラムに新規で保存する)*/
        $post->title = $request->title;
        $post->main = $request->main;
     
        $post->save(); /*データーベースに保存が実行*/
    
        // 画像の保存
        if($request->post_img){

            if($request->post_img->extension() == 'gif' || $request->post_img->extension() == 'jpeg' || $request->post_img->extension() == 'jpg' || $request->post_img->extension() == 'png'){
            $request->file('post_img')->storeAs('public/post_img', $post->id.'.'.$request->post_img->extension());
            }

        }
        return redirect ('/'); /*元の投稿フォームのページにリダイレクト*/
    }
    
    public function index (Request $request){
        
     /*Form::all(); が、データベースへの問い合わせ文(クエリ)
     並び順(orderBy)を投稿日(created_at)の降順(desc)にして全て取得(get)*/
     $data = Form::orderBy('created_at', 'desc')->get(); 
     
     /*return view の所でindex.blade.phpが表示されるように指定し、
       index.bladeに$dataを渡すために、->with(['data' => $data])*/
     return view('web.index')->with(['data' => $data]);
    }
    
    /*function show ( )の中にRequest, $requestではなく、今回は
    フォームに入力された値ではなく、URLの{ }の部分(パラメーター)を
    $id(変数)として受け取るので($id)としています。*/
    public function show ($id){
     $data = Form::where('id', $id)->first();
     return view('show')->with(['data' => $data]);
    }
}
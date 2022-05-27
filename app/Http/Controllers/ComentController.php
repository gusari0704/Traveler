<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Form;
use App\Coment;

class ComentController extends Controller
{
    public function edit($id)
    {
        $coment = Coment::where('id', '=', $id)->first();
        
        if (!$coment) {
          return redirect('/');
        }
        return view('coments.edit')    // show 関数との違いはここだけ
                ->with('coment', $coment);
    }

    public function destroy($id){
        // Comentsテーブルから指定のIDのレコード1件を取得
        $coment = Coment::where('id', '=', $id)->first();
        // レコードを削除
        $coment->delete();
        // 削除したら前の画面に戻る
        return back();
    }
    
    public function update(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|max:20',  // 入力が必須で，最大10文字
            ]);
            
        $coment = Coment::where('id', '=', $request->id)
                  ->first();
                  
        //*if($coment->user_id !== Auth::id()){
        //    return redirect('/');
        //}
        
        if (!$coment) {
            return redirect('/comments');
        }
        
            $coment->text = $request->text;
            $coment->save();
        
        return redirect()->route('form.show', ['id' => $coment->form_id]); 
    }
}
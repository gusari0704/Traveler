<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Form;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function mypage()
    {
        /* ユーザー自身の情報を$userに保存し、それをビューへと渡しビュー側で表示 */
        $user = Auth::user(); 
    
        return view('users.mypage', compact('user'));
    }

    public function form()
    {
        $user = Auth::user();
 
        return view('users.form', compact('user'));
    }
    
    /*投稿履歴一覧*/
    public function history()
    {
        $user = Auth::user();
        $data = Form::where('user_id', Auth::id())->get();
        return view('users.history', compact('user','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();
 
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();
        
        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $user->email = $request->input('email') ? $request->input('email') : $user->email;
        $user->postal_code = $request->input('postal_code') ? $request->input('postal_code') : $user->postal_code;
        $user->address = $request->input('address') ? $request->input('address') : $user->address;
        $user->phone = $request->input('phone') ? $request->input('phone') : $user->phone;
        $user->update();
        
        return redirect()->route('mypage.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
     
    /* 会員の住所変更を行うページ用 */
    public function edit_address()
    {
        $user = Auth::user();
    
        return view('users.edit_address', compact('user'));
    }
    
    /* ユーザー側の退会機能 */
    public function destroy(Request $request)
    {
        $user = Auth::user();
         
        if ($user->deleted_flag) {
            $user->deleted_flag = false;
        } else {
            $user->deleted_flag = true;
        }
 
        $user->update();
 
        Auth::logout();
 
        return redirect('/');
    }
}

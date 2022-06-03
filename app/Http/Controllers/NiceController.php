<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Nice;
use Illuminate\Support\Facades\Auth;

class NiceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function nice(Post $post, Request $request)
    {
        $nice=New Nice();
        $nice->post_id = $post->id;
        $nice->user_id = Auth::user()->id;
        $nice->save();
        return back();
    }

    public function unnice(Post $post, Request $request)
    {
        $use = Auth::user()->id;
        $nice = Nice::where('post_id', $post->id)->where('user_id', $user)->first();
        $nice->delete();
        return back();
    }

    public function show(Post $post)
    {  
        $nice = Nice::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        return view('show', compact('post', 'nice'));
    }
}

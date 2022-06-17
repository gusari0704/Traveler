<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function bookmark_favorites()
    {
        $favorites = Auth::user()->bookmark_Favorites()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'favorites' => $favorites,
        ];
        return view('bookmarks', $data);
    }
}
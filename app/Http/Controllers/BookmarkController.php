<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store($favoriteId) {
        $user = \\Auth::user();
        if (!$user->is_bookmark($favoriteId)) {
            $user->bookmark_Favorites()->attach($favoriteId);
        }
        return back();
    }
    
    public function destroy($favoriteId) {
        $user = \\Auth::user();
        if ($user->is_bookmark($favoriteId)) {
            $user->bookmark_Favorites()->detach($favoriteId);
        }
        return back();
    }
}

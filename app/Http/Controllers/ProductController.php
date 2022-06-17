<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
  use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function favorite(Product $product)
     {
         $user = Auth::user();
 
         if ($user->hasFavorited($product)) {
             $user->unfavorite($product);
         } else {
             $user->favorite($product);
         }
 
         return redirect()->route('show', $product);
     }

}
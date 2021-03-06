<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;
use App\Product;
use App\User;
use DB;

class WishlistController extends Controller
{

    public function addWish(Request $request, $id)
    {
        $user = auth()->user();
        $existing = Wishlist::where('user_id', $user->id)->where('product_id', $id)->first();
        if ($user && $existing == false) {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $id,
            ]);
            return response()->json([
                'success' => true,
                'data' => 'Product added to Wishlist',
            ]);
        } else return "Product is already in wishlist";
    }
    public function deleteWish(Request $request, $id)
    {
        $user = auth()->user();
        if ($user) {
            Wishlist::where('user_id', $user->id)->where('product_id', $id)->delete();
            return response()->json([
                'success' => true,
                'data' => 'Product deleted from Wishlist',
            ]);
        }
    }
}
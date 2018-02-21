<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use DB;

class cartController extends Controller
{
    public function cart(Request $request)
    {
    	$cart = Cart::where('id_cookie', '=', $request->id)->get();
    	// $keranjang = DB::table('cart')->where('id_cookie', $request->id_cookie)->get();

    	// return $request->id;
    	return response()->json($cart);
    }

    public function deleteCart(Request $request)
    {
    	Cart::where('id_cookie', '=', $request->cookie)->where('id', '=', $request->id_product)->delete();
    	// DB::table('cart')->where('id_cookie', '=', $request->cookie)->where('id', '=', $request->id_product)->delete();
    	return response()->json([
    		'delete' => true
    	]);
    }
}

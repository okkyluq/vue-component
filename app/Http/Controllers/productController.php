<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as Barang;
use App\Cart as Keranjang;
use Mail;

class productController extends Controller
{
    public function product()
    {
    	$product = Barang::all();

    	return response()->json($product);
    }

    public function storeProduct(Request $request)
    {
    	$product = Barang::findOrFail($request->id_product);

        $cek = Keranjang::where('id_cookie', $request->id_cookie)->where('product_id', $product->id);

        if ($cek->count() > 0) {
            
            return response()->json([
                'error' => 'Barang Sudah Di keranjang'
            ], 422);

        } else {
            
            $keranjang = new Keranjang;
            $keranjang->id_cookie = $request->id_cookie;
            $keranjang->product_id = $product->id;
            $keranjang->product_name = $product->product_name;
            $keranjang->price = $product->price;
            $keranjang->qty = 1;
            $keranjang->total = $product->price * $keranjang->qty;
            $keranjang->save();

            Mail::send(['text'=> 'mail'], ['name'=>'sarthak'], function ($message) {
                $message->from('mr.luqman14@gmail.com', 'From ini');
                $message->to('mr.luqman14@gmail.com', 'To ini');
                $message->subject('Subject ini');
            });

            return response()->json([
                'created' => true
            ], 200);


            
            
        }

    	
    }

}

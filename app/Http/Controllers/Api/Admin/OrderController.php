<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\WishList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $successStatus = 200;

    public function cart(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
        ]);

        $cart = new Cart();
        $cart->user_id = $request->post('user_id');
        $cart->product_id = $request->post('product_id');
        $cart->qty = $request->post('qty');
        $cart->price = $request->post('price');
        $cart->sku = $request->post('sku') ?? '';
        $cart->save();

        return response()->json(['data' => 'Successfully saved'], $this->successStatus);
    }

    public function wishlist(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'is_wishlist' => 'required'
        ]);
        $wishlist = new WishList();
        $wishlist->user_id = $request->post('user_id');
        $wishlist->product_id = $request->post('product_id');
        $wishlist->save();
        return response()->json(['data' => 'Successfully saved'], $this->successStatus);

    }

    public function order(Request $request) {

    }
}

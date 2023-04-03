<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $user['data'] = Cart::orderby('id','desc')->get();
        return view('admin/cart', $user);
    }
}

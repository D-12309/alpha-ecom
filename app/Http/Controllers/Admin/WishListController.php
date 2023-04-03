<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index()
    {
        $user['data'] = WishList::orderby('id', 'desc')->get();
        return view('admin/wishlist', $user);
    }
}

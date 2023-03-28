<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct() {
         $this->perPage = env('PER_PAGE_RECORD') ?? 1;
    }

    public function index(Request $request)
    {
        $user['data'] = User::orderby('id','desc')->paginate($this->perPage);
        return view('admin/user', $user);
    }
}

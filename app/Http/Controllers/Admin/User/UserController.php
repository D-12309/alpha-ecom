<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCategory;
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

    public function user_category()
    {
        $category['data'] = UserCategory::orderby('id', 'desc')->get();
        return view('admin/user_category', $category);
    }

    public function user_manage_category(Request $request, $id = '')
    {
        if ($id > 0) {
            $category = UserCategory::where(['id' => $id])->first();
            $result['name'] = $category->name;
            $result['id'] = $category->id;
        } else {
            $result['name'] = "";
            $result['id'] = 0;
        }

        return view('admin/user_category_manage', $result);
    }

    public function manage_user_category_process(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:user_categories,name,' . $request->post('id')
        ]);
        if ($request->post('id') > 0) {
            $category = UserCategory::find($request->post('id'));
        } else {
            $category = new UserCategory();
        }

        $category->name = $request->post('name');
        $category->save();
        return redirect('admin/user-categories');
    }

    public function delete(Request $request, $id)
    {
        $category = UserCategory::where('id', $id)->delete();
        return redirect('admin/user-categories');
    }
}

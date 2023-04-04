<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\BusinessDetails;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->perPage = env('PER_PAGE_RECORD') ?? 1;
    }

    public function index(Request $request)
    {
        $user['data'] = User::orderby('id', 'desc')->get();
        return view('admin/user', $user);
    }

    public function user_category()
    {
        $category['data'] = UserCategory::orderby('id', 'desc')->get();
        return view('admin/user_category', $category);
    }

    public function user_manage_category(Request $request, $id = '')
    {

        $users = User::whereNotNull('name')->pluck('name', 'id');
        if ($id > 0) {
            $category = UserCategory::where(['id' => $id])->first();
            $result['name'] = $category->name;
            $result['id'] = $category->id;
            $result['mapUsers'] = json_decode($category->user_id);
            $result['users'] = $users;

        } else {
            $result['name'] = "";
            $result['users'] = $users;
            $result['mapUsers'] = [];
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
        $category->user_id = json_encode($request->post('mapUser'));
        $category->save();
        if ($request->post('mapUser')) {
            User::whereIn('id', $request->post('mapUser'))->update(['user_category' => $request->post('name')]);
        }
        return redirect('admin/user-categories');
    }

    public function delete(Request $request, $id)
    {
        $category = UserCategory::where('id', $id)->delete();
        return redirect('admin/user-categories');
    }

    public function business_details(Request $request)
    {
        $user['data'] = BusinessDetails::orderby('id', 'desc')->get();
        return view('admin/business_detail', $user);
    }

    public function approved(Request $request, $id)
    {
        if ($id) {
            BusinessDetails::where('id', $id)->update(['is_approved' => 1]);
            return redirect('admin/business-details');
        }
    }

    public function rejected(Request $request)
    {
        if ($request->post('id') && $request->post('rejected_message')) {
            BusinessDetails::where('id', $request->post('id'))->update(['rejected_message' => $request->post('rejected_message')]);
            return redirect('admin/business-details');
        }
    }
}

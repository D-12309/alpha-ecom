<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }else{
            return view('admin.login');
        }
        return view('admin.login');
    }

    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();
        if($result){
            if(Hash::check($request->post('password'),$result->password)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                $request->session()->put('ADMIN_EMAIL',$result->email);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('/');
            }
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('/');
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function admin_list()
    {
        $admins = Admin::orderby('id', 'desc')->get();
        $result['data'] = $admins->map(function ($query) {
            $query['typeName'] = Helpers::getType($query->type) ?? '';
            return $query;
        });

        return view('admin/admin_list', $result);
    }

    public function manage_admin_list(Request $request, $id = '')
    {
        if ($id > 0) {
            $admin = Admin::where(['id' => $id])->first();
            $result['email'] = $admin->email;
            $result['type'] = $admin->type;
            $result['name'] = $admin->name;
            $result['types'] = Helpers::getTypes();
            $result['id'] = $admin->id;
            $result['password'] = "";
            $result['confirm_password'] = "";
        } else {
            $result['email'] = "";
            $result['type'] = "";
            $result['name'] = "";
            $result['password'] = "";
            $result['types'] = Helpers::getTypes();
            $result['confirm_password'] = "";
            $result['id'] = 0;
        }

        return view('admin/manage_admin_list', $result);
    }

    public function manage_admin_list_process(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admins,email,' . $request->post('id'),
            'type' => 'required'
        ]);

        if ($request->post('id') > 0) {
            $admin = Admin::find($request->post('id'));
        } else {
            $request->validate([
                'password'=> 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $admin = new Admin();
        }

        $admin->email = $request->post('email');
        $admin->type = $request->post('type');
        $admin->name = $request->post('name');
        $admin->password = Hash::make($request->post('password'));
        $admin->save();
        return redirect('admin/admin-list');
    }

    public function delete(Request $request, $id)
    {
        Admin::where('id', $id)->delete();
        return redirect('admin/admin-list');
    }
}

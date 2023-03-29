<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function manage_privacy_policy(Request $request, $id = '')
    {
        $privacyPolicy = PrivacyPolicy::where(['id' => 1])->first();
        if ($privacyPolicy) {
            $result['description'] = $privacyPolicy->description;
            $result['id'] = $privacyPolicy->id;
        } else {
            $result['id'] = 0;
            $result['description'] = "";
        }

        return view('admin/privacy_policy', $result);
    }

    public function manage_privacy_policy_process(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);


        if ($request->post('id') > 0) {
            $privacyPolicy = PrivacyPolicy::find($request->post('id'));
        } else {
            $privacyPolicy = new PrivacyPolicy();
        }

        $privacyPolicy->description = $request->post('description');
        $privacyPolicy->save();
        return redirect('admin/privacy-policy');
    }
}

<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessDetails;
use App\Models\Faq;
use App\Models\PrivacyPolicy;
use App\Models\TermCondition;
use App\Models\User;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public $successStatus = 200;

    public function faqs(\Illuminate\Support\Facades\Request $request)
    {
        $result['faqs'] = Faq::all();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function privacyPolicy(Request $request)
    {
        $result['privacyPolicy'] = PrivacyPolicy::first();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function user(Request $request)
    {
        $result['user'] = User::find($request->user_id);
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function termCondition(Request $request)
    {
        $result['termCondition'] = TermCondition::first();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function business_detail(Request $request)
    {
        $rules = [
            'owner_name' => 'required',
            'shop_name' => 'required',
            'contact_person_name' => 'required',
            'owner_image' => 'required',
            'recipient_name' => 'required',
            'mobile_no' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'locality' => 'required',
            'landmark' => 'required',
            'city' => 'required',
            'pin_code' => 'required',
            'id_type' => 'required',
            'id_no' => 'required',
            'government_image' => 'required',
            'licence_type' => 'required',
            'licence_no' => 'required',
            'licence_image' => 'required',
            'user_id' => 'required'
        ];
        $validation = validator(
            $request->toArray(),
            $rules
        );
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }
        if ($request->post('business_detail_id')) {
            $businessDetail = BusinessDetails::find($request->post('business_detail_id'));
        } else {
            $businessDetail = new BusinessDetails();
        }
        $businessDetail->owner_name = $request->post('owner_name');
        $businessDetail->shop_name = $request->post('shop_name');
        $businessDetail->contact_person_name = $request->post('contact_person_name');
        $businessDetail->owner_image = $request->post('owner_image');
        $businessDetail->recipient_name = $request->post('recipient_name');
        $businessDetail->mobile_no = $request->post('mobile_no');
        $businessDetail->house_no = $request->post('house_no');
        $businessDetail->street = $request->post('street');
        $businessDetail->locality = $request->post('locality');
        $businessDetail->landmark = $request->post('landmark');
        $businessDetail->city = $request->post('city');
        $businessDetail->pin_code = $request->post('pin_code');
        $businessDetail->id_type = $request->post('id_type');
        $businessDetail->id_no = $request->post('id_no');
        $businessDetail->government_image = $request->post('government_image');
        $businessDetail->licence_type = $request->post('licence_type');
        $businessDetail->licence_no = $request->post('licence_no');
        $businessDetail->licence_image = $request->post('licence_image');
        $businessDetail->user_id = $request->post('user_id');
        $businessDetail->save();

        return response()->json(['id' => $businessDetail->id, 'message' => 'Business Detail Saved Successfully'], $this->successStatus);

    }
}

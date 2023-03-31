<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\PrivacyPolicy;
use App\Models\TermCondition;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public $successStatus = 200;
    public function faqs(\Illuminate\Support\Facades\Request $request) {
        $result['faqs'] = Faq::all();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function privacyPolicy(Request $request) {
        $result['privacyPolicy'] = PrivacyPolicy::first();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function termCondition(Request $request) {
        $result['termCondition'] = TermCondition::first();
        return response()->json(['data' => $result], $this->successStatus);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function __construct()
    {
        $this->perPage = env('PER_PAGE_RECORD') ?? 1;
    }

    public function index()
    {
        $brand['data'] = Faq::orderby('id', 'desc')->get();
        return view('admin/faq', $brand);
    }

    public function manage_faq(Request $request, $id = '')
    {
        if ($id > 0) {
            $faq = Faq::where(['id' => $id])->first();
            $result['question'] = $faq->question;
            $result['answer'] = $faq->answer;
            $result['id'] = $faq->id;
        } else {
            $result['question'] = "";
            $result['answer'] = "";
            $result['id'] = 0;
        }

        return view('admin/manage_faq', $result);
    }

    public function manage_faq_process(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);


        if ($request->post('id') > 0) {
            $faq = Faq::find($request->post('id'));
        } else {
            $faq = new Faq();
        }

        $faq->question = $request->post('question');
        $faq->answer = $request->post('answer');
        $faq->save();
        return redirect('admin/faqs');
    }

    public function delete(Request $request, $id)
    {
        $faq = Faq::where('id', $id)->delete();
        return redirect('admin/faqs');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->perPage = env('PER_PAGE_RECORD') ?? 1;
    }

    public function index()
    {
        $brand['data'] = Offer::orderby('id', 'desc')->get();
        return view('admin/offer', $brand);
    }

    public function manage_offer(Request $request, $id = '')
    {
        if ($id > 0) {
            $offer = Offer::where(['id' => $id])->first();
            $result['name'] = $offer->name;
            $result['value'] = $offer->value;
            $result['type'] = $offer->type;
            $result['id'] = $offer->id;
        } else {
            $result['name'] = "";
            $result['value'] = "";
            $result['type'] = "";
            $result['id'] = 0;
        }

        return view('admin/manage_offer', $result);
    }

    public function manage_offer_process(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:offers,name,' . $request->post('id'),
            'value' => 'required|numeric',
            'type' => 'required|numeric',
        ]);


        if ($request->post('id') > 0) {
            $offer = Offer::find($request->post('id'));
        } else {
            $offer = new Offer();
        }

        $offer->name = $request->post('name');
        $offer->value = $request->post('value');
        $offer->type = $request->post('type');
        $offer->save();
        return redirect('admin/offers');
    }

    public function delete(Request $request, $id)
    {
        $offer = Offer::where('id', $id)->delete();
        return redirect('admin/offers');
    }
}

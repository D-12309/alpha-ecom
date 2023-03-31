<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use App\Models\User;
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
        $products = Product::pluck('name', 'id')->get();
        $user = User::whereNotNull('name')->get();
        if ($id > 0) {
            $offer = Offer::where(['id' => $id])->first();
            $result['name'] = $offer->name;
            $result['value'] = $offer->value;
            $result['type'] = $offer->type;
            $result['start_date'] = $offer->start_date;
            $result['end_date'] = $offer->end_date;
            $result['min_amount'] = $offer->min_amount;
            $result['min_qty'] = $offer->min_qty;
            $result['valid_user'] = json_decode($offer->valid_user);
            $result['valid_product'] = json_decode($offer->valid_product);
            $result['mapProducts'] = $products;
            $result['mapUsers'] = $user;
            $result['id'] = $offer->id;
        } else {
            $result['name'] = "";
            $result['value'] = "";
            $result['type'] = "";
            $result['start_date'] = "";
            $result['end_date'] = "";
            $result['min_amount'] = "";
            $result['min_qty'] = "";
            $result['valid_user'] = [];
            $result['valid_product'] = [];
            $result['mapProducts'] = $products;
            $result['mapUsers'] = $user;
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\OfferCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\UserCategory;
use App\Traits\Helpers;
use Carbon\Carbon;
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

        $products = Product::pluck('name', 'id');
        $user = User::whereNotNull('name')->get();
        if ($id > 0) {
            $offer = Offer::where(['id' => $id])->first();
            $result['name'] = $offer->name;
            $result['value'] = $offer->value;
            $result['type'] = $offer->type;
            $result['start_date'] = Carbon::parse($offer->start_date)->format('m\/d\/Y g:i A');
            $result['end_date'] = Carbon::parse($offer->end_date)->format('m\/d\/Y g:i A');
            $result['date_range'] =  $result['start_date']. ' - '.$result['end_date'];
            $result['min_amount'] = $offer->min_amount;
            $result['min_qty'] = $offer->min_qty;
            $result['mapUsers'] = json_decode($offer->valid_user);
            $result['mapProducts'] = json_decode($offer->valid_product);
            $result['products'] = $products;
            $result['users'] = $user;
            $result['code'] = $offer->code;
            $result['id'] = $offer->id;
        } else {
            $result['name'] = "";
            $result['value'] = "";
            $result['type'] = "";
            $result['start_date'] = "";
            $result['end_date'] = "";
            $result['min_amount'] = "";
            $result['min_qty'] = "";
            $result['mapUser'] = [];
            $result['users'] = $user;
            $result['products'] = $products;
            $result['mapProducts'] = [];
            $result['date_range'] = [];
            $result['code'] = [];
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
            'code' => 'required',
        ]);


        if ($request->post('id') > 0) {
            $offer = Offer::find($request->post('id'));
        } else {
            $offer = new Offer();
        }
        if($request->post('date_range')) {
            $startDate = explode('-',$request->post('date_range'))[0];
            $endDate = explode('-',$request->post('date_range'))[1];
            $offer->start_date =  Carbon::parse($startDate)->format('Y-m-d H:i:s');
            $offer->end_date =  Carbon::parse($endDate)->format('Y-m-d H:i:s');
        }
        $offer->name = $request->post('name');
        $offer->code = $request->post('code');
        $offer->min_amount = $request->post('min_amount');
        $offer->min_qty = $request->post('min_qty');
        $offer->valid_product = json_encode($request->post('mapProduct')) ?? null;
        $offer->valid_user = json_encode($request->post('mapUser')) ?? null;
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



    public function offer_category()
    {
        $category['data'] = OfferCategory::orderby('id', 'desc')->get();
        return view('admin/offer_category', $category);
    }

    public function offer_manage_category(Request $request, $id = '')
    {

        $users = User::whereNotNull('name')->pluck('name','id');
        $products = Product::pluck('name','id');
        if ($id > 0) {
            $category = OfferCategory::where(['id' => $id])->first();
            $result['name'] = $category->name;
            $result['id'] = $category->id;
            $result['mapUsers'] = json_decode($category->valid_user);
            $result['mapProducts'] = json_decode($category->valid_product);
            $result['users'] = $users;
            $result['products'] = $products;

        } else {
            $result['name'] = "";
            $result['users'] = $users;
            $result['products'] = $products;
            $result['mapUsers'] = [];
            $result['mapProducts'] = [];
            $result['id'] = 0;
        }

        return view('admin/offer_category_manage', $result);
    }

    public function manage_offer_category_process(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:offer_categories,name,' . $request->post('id')
        ]);
        if ($request->post('id') > 0) {
            $category = OfferCategory::find($request->post('id'));
        } else {
            $category = new OfferCategory();
        }

        $category->name = $request->post('name');
        $category->valid_user = json_encode($request->post('mapUser'));
        $category->valid_product = json_encode($request->post('mapProduct'));
        $category->save();
        return redirect('admin/offer-categories');
    }

    public function deleteCategory(Request $request, $id)
    {
        $category = OfferCategory::where('id', $id)->delete();
        return redirect('admin/offer-categories');
    }
}

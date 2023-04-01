<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Models\OfferCategory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $successStatus = 200;

    public function categories(Request $request)
    {
        $result['categories'] = Category::all();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function brands(Request $request)
    {
        $result['brands'] = Brand::all();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function offers(Request $request)
    {
        $result['offers'] = Offer::all();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function products(Request $request)
    {
        $result['products'] = Product::with(['productImages', 'category', 'brand'])->get();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function trending(Request $request)
    {
        $result['trending'] = Product::with(['productImages'])->select('id', 'name', 'qty', 'sku', 'mrp', 'price')->get();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function bestSelling(Request $request) {
        $result['bestSelling'] = Product::with(['productImages'])->select('id', 'name', 'qty', 'sku', 'mrp', 'price')->get();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function recentView(Request $request) {
        $result['recentView'] = Product::with(['productImages'])->select('id', 'name', 'qty', 'sku', 'mrp', 'price')->get();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function OfferCategories(Request $request) {
        $offerCategories = OfferCategory::get();
        if(count($offerCategories) > 0) {
            $prepareOfferObj = [];
            foreach ($offerCategories as $category) {
                $prepareOffer = [];
                $validUser = json_decode($category->valid_user) ?? [];
                $validProduct = json_decode($category->valid_product) ?? [];
                $prepareOffer['category_name'] = $category->name;
                $users = User::whereIn('id',$validUser)->get();
                $products = Product::with('productImages')->whereIn('id',$validProduct)->get();
                $products = collect($products)->map(function ($product){
                    $product->mrp =  json_decode($product->mrp);
                    $product->price =  json_decode($product->price);
                    $product->qty =  json_decode($product->qty);
                    $product->slab_price =  json_decode($product->slab_price);
                    return $product;
                });
                $prepareOffer['valid_users'] = count($users) ? $users : [];
                $prepareOffer['valid_products'] = count($products) ? $products : [];
                $prepareOfferObj[] = $prepareOffer;
            }
        }
        $result['offerCategories'] = $prepareOfferObj;
        return response()->json(['data' => $result], $this->successStatus);
    }
}

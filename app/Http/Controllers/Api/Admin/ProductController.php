<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Offer;
use App\Models\OfferCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\UserCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $successStatus = 200;

    public function categories(Request $request)
    {
        $result['categories'] = Category::all();
        return response()->json(['data' => $result], $this->successStatus);
    }

    public function category(Request $request)
    {
        if($request->post('category_id')){
            $category = Category::where('id',$request->post('category_id'))->first();
            if($category) {
                $productIds = json_decode($category->product_id);
                $products = Product::with('productImages')->whereIn('id',$productIds)->get();
                $products = collect($products)->map(function ($product){
                    $product->mrp =  json_decode($product->mrp);
                    $product->price =  json_decode($product->price);
                    $product->qty =  json_decode($product->qty);
                    $product->slab_price =  json_decode($product->slab_price);
                    return $product;
                });
                $result['products'] = $products;
                return response()->json(['data' => $result], $this->successStatus);
            }
        }
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

    public function product(Request $request)
    {
        if($request->post('product_id')){
            $products = Product::with('productImages')->where('id',$request->post('product_id'))->get();
            $products = collect($products)->map(function ($product){
                $product->mrp =  json_decode($product->mrp);
                $product->price =  json_decode($product->price);
                $product->qty =  json_decode($product->qty);
                $product->slab_price =  json_decode($product->slab_price);
                return $product;
            });
            $result['product'] = $products;
            return response()->json(['data' => $result], $this->successStatus);
        }
        return response()->json(['error' => "Please Enter valid product id"], $this->successStatus);
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
                $prepareOffer['category_id'] = $category->id;
                $users = UserCategory::whereIn('id',$validUser)->get();
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

    public function OfferCategory(Request $request) {
        if($request->post('offer_category_id')) {
            $offerCategories = OfferCategory::where('id',$request->post('offer_category_id'))->get();
            foreach ($offerCategories as $category) {
                $prepareOffer = [];
                $validUser = json_decode($category->valid_user) ?? [];
                $validProduct = json_decode($category->valid_product) ?? [];
                $prepareOffer['category_name'] = $category->name;
                $prepareOffer['category_id'] = $category->id;
                $users = UserCategory::whereIn('id',$validUser)->get();
                $products = Product::with('productImages')->whereIn('id',$validProduct)->get();
                $products = collect($products)->map(function ($product){
                    $product->mrp =  json_decode($product->mrp);
                    $product->price =  json_decode($product->price);
                    $product->qty =  json_decode($product->qty);
                    $product->slab_price =  json_decode($product->slab_price);
                    return $product;
                });
                $prepareOffer['valid_products'] = count($products) ? $products : [];
                $prepareOfferObj[] = $prepareOffer;
            }
            $result['products'] = $prepareOfferObj;
            return response()->json(['data' => $result], $this->successStatus);
        }
    }
}

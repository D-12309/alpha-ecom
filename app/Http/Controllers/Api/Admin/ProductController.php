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
use SebastianBergmann\ObjectReflector\InvalidArgumentException;

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
        if ($request->post('category_id') && $request->post('user_id')) {
            $category = Category::where('id', $request->post('category_id'))->first();
            if ($category) {
                $productIds = json_decode($category->product_id);
                $validUserCategory = User::where('id', $request->post('user_id'))->value('user_category');
                $products = Product::with('productImages')->whereIn('id', $productIds)->get();
                $products = collect($products)->map(function ($product) use ($validUserCategory) {
                    $product->mrp = json_decode($product->mrp);
                    $product->price = json_decode($product->price);
                    $product->qty = json_decode($product->qty);
                    $product->slab_price = json_decode($product->slab_price);
                    foreach ($product->mrp as $mrp) {
                        if ($mrp->name == $validUserCategory) {
                            $product->mrp = $mrp->mrp;
                        }
                    }
                    foreach ($product->price as $price) {
                        if ($price->name == $validUserCategory) {
                            $product->price = (int)$price->price;
                        }
                    }
                    foreach ($product->qty as $qty) {
                        if ($qty->name == $validUserCategory) {
                            $product->qty = $qty->qty;
                        }
                    }
                    foreach ($product->slab_price as $key => $slab_price) {
                        if ($key == $validUserCategory) {
                            $product->slab_price = $slab_price;
                        }
                    }
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
        if ($request->post('user_id')) {
            $validUserCategory = User::where('id', $request->post('user_id'))->value('user_category');
            $products = Product::with('productImages');
            if ($request->post('sort_order')) {
                $products = $products->orderBy('name', $request->post('sort_order'))->get();
            } else {
                $products = $products->get();
            }
            $products = collect($products)->map(function ($product) use ($validUserCategory) {
                $product->mrp = json_decode($product->mrp);
                $product->price = json_decode($product->price);
                $product->qty = json_decode($product->qty);
                $product->slab_price = json_decode($product->slab_price);
                foreach ($product->mrp as $mrp) {
                    if ($mrp->name == $validUserCategory) {
                        $product->mrp = $mrp->mrp;
                    }
                }
                foreach ($product->price as $price) {
                    if ($price->name == $validUserCategory) {
                        $product->price = (int)$price->price;
                    }
                }
                foreach ($product->qty as $qty) {
                    if ($qty->name == $validUserCategory) {
                        $product->qty = $qty->qty;
                    }
                }
                foreach ($product->slab_price as $key => $slab_price) {
                    if ($key == $validUserCategory) {
                        $product->slab_price = $slab_price;
                    }
                }
                return $product;
            });
           /* if ($request->post('sort_price') == 'high_to_low') {
                $result = $products->sortBy('price',SORT_REGULAR,'desc');
                $result['products'] = collect($result);
            }else{
                $result['products'] = $products;
            }*/
            $result['products'] = $products;
            //$result['products'] = $products;
            return response()->json(['data' => $result], $this->successStatus);
        }

    }

    public function product(Request $request)
    {
        if ($request->post('product_id') && $request->post('user_id')) {
            $validUserCategory = User::where('id', $request->post('user_id'))->value('user_category');
            $products = Product::with('productImages')->where('id', $request->post('product_id'))->get();
            $products = collect($products)->map(function ($product) use ($validUserCategory) {
                $product->mrp = json_decode($product->mrp);
                $product->price = json_decode($product->price);
                $product->qty = json_decode($product->qty);
                $product->slab_price = json_decode($product->slab_price);
                foreach ($product->mrp as $mrp) {
                    if ($mrp->name == $validUserCategory) {
                        $product->mrp = $mrp->mrp;
                    }
                }
                foreach ($product->price as $price) {
                    if ($price->name == $validUserCategory) {
                        $product->price = $price->price;
                    }
                }
                foreach ($product->qty as $qty) {
                    if ($qty->name == $validUserCategory) {
                        $product->qty = $qty->qty;
                    }
                }
                foreach ($product->slab_price as $key => $slab_price) {
                    if ($key == $validUserCategory) {
                        $product->slab_price = $slab_price;
                    }
                }
                return $product;
            });
            $result['product'] = $products;
            return response()->json(['data' => $result], $this->successStatus);
        }
        return response()->json(['error' => "Please Enter valid product id"], $this->successStatus);
    }

    public function trending(Request $request)
    {
        if ($request->post('user_id')) {
            $validUserCategory = User::where('id', $request->post('user_id'))->value('user_category');
            $products = Product::with(['productImages'])->select('id', 'name', 'qty', 'sku', 'mrp', 'price','slab_price')->get();
            $products = collect($products)->map(function ($product) use ($validUserCategory) {
                $product->mrp = json_decode($product->mrp);
                $product->price = json_decode($product->price);
                $product->qty = json_decode($product->qty);
                $product->slab_price = json_decode($product->slab_price);
                foreach ($product->mrp as $mrp) {
                    if ($mrp->name == $validUserCategory) {
                        $product->mrp = $mrp->mrp;
                    }
                }
                foreach ($product->price as $price) {
                    if ($price->name == $validUserCategory) {
                        $product->price = $price->price;
                    }
                }
                foreach ($product->qty as $qty) {
                    if ($qty->name == $validUserCategory) {
                        $product->qty = $qty->qty;
                    }
                }
                foreach ($product->slab_price as $key => $slab_price) {
                    if ($key == $validUserCategory) {
                        $product->slab_price = $slab_price;
                    }
                }
                return $product;
            });
            $result['trending'] = $products;
            return response()->json(['data' => $result], $this->successStatus);
        }

    }

    public function bestSelling(Request $request)
    {
        if ($request->post('user_id')) {
            $validUserCategory = User::where('id', $request->post('user_id'))->value('user_category');
            $products = Product::with(['productImages'])->select('id', 'name', 'qty', 'sku', 'mrp', 'price','slab_price')->get();
            $products = collect($products)->map(function ($product) use ($validUserCategory) {
                $product->mrp = json_decode($product->mrp);
                $product->price = json_decode($product->price);
                $product->qty = json_decode($product->qty);
                $product->slab_price = json_decode($product->slab_price);
                foreach ($product->mrp as $mrp) {
                    if ($mrp->name == $validUserCategory) {
                        $product->mrp = $mrp->mrp;
                    }
                }
                foreach ($product->price as $price) {
                    if ($price->name == $validUserCategory) {
                        $product->price = $price->price;
                    }
                }
                foreach ($product->qty as $qty) {
                    if ($qty->name == $validUserCategory) {
                        $product->qty = $qty->qty;
                    }
                }
                foreach ($product->slab_price as $key => $slab_price) {
                    if ($key == $validUserCategory) {
                        $product->slab_price = $slab_price;
                    }
                }
                return $product;
            });
            $result['bestSelling'] = $products;
            return response()->json(['data' => $result], $this->successStatus);
        }
    }

    public function recentView(Request $request)
    {
        if ($request->post('user_id')) {
            $validUserCategory = User::where('id', $request->post('user_id'))->value('user_category');
            $products = Product::with(['productImages'])->select('id', 'name', 'qty', 'sku', 'mrp', 'price','slab_price')->get();
            $products = collect($products)->map(function ($product) use ($validUserCategory) {
                $product->mrp = json_decode($product->mrp);
                $product->price = json_decode($product->price);
                $product->qty = json_decode($product->qty);
                $product->slab_price = json_decode($product->slab_price);
                foreach ($product->mrp as $mrp) {
                    if ($mrp->name == $validUserCategory) {
                        $product->mrp = $mrp->mrp;
                    }
                }
                foreach ($product->price as $price) {
                    if ($price->name == $validUserCategory) {
                        $product->price = $price->price;
                    }
                }
                foreach ($product->qty as $qty) {
                    if ($qty->name == $validUserCategory) {
                        $product->qty = $qty->qty;
                    }
                }
                foreach ($product->slab_price as $key => $slab_price) {
                    if ($key == $validUserCategory) {
                        $product->slab_price = $slab_price;
                    }
                }
                return $product;
            });
            $result['recentView'] = $products;
            return response()->json(['data' => $result], $this->successStatus);
        }
    }

    public function OfferCategories(Request $request)
    {
        $prepareOfferObj = [];
        if ($request->post('user_id')) {
            $offerCategories = OfferCategory::get();
            if (count($offerCategories) > 0) {
                foreach ($offerCategories as $category) {
                    $validUser = json_decode($category->valid_user) ?? [];
                    if (in_array($request->post('user_id'), $validUser)) {
                        $prepareOffer = [];
                        $prepareOffer['category_name'] = $category->name;
                        $prepareOffer['category_id'] = $category->id;
                        $prepareOfferObj[] = $prepareOffer;
                    }
                }
            }
            $result['offerCategories'] = $prepareOfferObj;
            return response()->json(['data' => $result], $this->successStatus);
        }
    }

    public function OfferCategory(Request $request)
    {
        if ($request->post('offer_category_id') && $request->post('offer_category_id')) {
            $offerCategories = OfferCategory::where('id', $request->post('offer_category_id'))->get();
            foreach ($offerCategories as $category) {
                $prepareOffer = [];
                $validProduct = json_decode($category->valid_product) ?? [];
                $userCategories = json_decode($category->valid_user) ?? [];
                $userCategoryName = null;
                foreach ($userCategories as $userCategory) {
                    $validUserCategory = UserCategory::where('id', $userCategory)->value('name');
                    $userCategoryName = $validUserCategory;
                    $prepareOffer['category_name'] = $category->name;
                    $prepareOffer['category_id'] = $category->id;
                    $products = Product::with('productImages')->whereIn('id', $validProduct)->get();
                    $products = collect($products)->map(function ($product) use ($userCategoryName) {
                        $product->mrp = json_decode($product->mrp);
                        $product->price = json_decode($product->price);
                        $product->qty = json_decode($product->qty);
                        $product->slab_price = json_decode($product->slab_price);
                        foreach ($product->mrp as $mrp) {
                            if ($mrp->name == $userCategoryName) {
                                $product->mrp = $mrp->mrp;
                            }
                        }
                        foreach ($product->price as $price) {
                            if ($price->name == $userCategoryName) {
                                $product->price = $price->price;
                            }
                        }
                        foreach ($product->qty as $qty) {
                            if ($qty->name == $userCategoryName) {
                                $product->qty = $qty->qty;
                            }
                        }
                        foreach ($product->slab_price as $key => $slab_price) {
                            if ($key == $userCategoryName) {
                                $product->slab_price = $slab_price;
                            }
                        }
                        return $product;
                    });
                    $prepareOffer['valid_products'] = count($products) ? $products : [];
                    $prepareOfferObj[] = $prepareOffer;
                }
            }
            $result['products'] = $prepareOfferObj;
            return response()->json(['data' => $result], $this->successStatus);
        }
    }
}

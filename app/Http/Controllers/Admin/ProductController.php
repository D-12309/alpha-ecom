<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\UserCategory;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->perPage = env('PER_PAGE_RECORD') ?? 1;
    }

    public function index()
    {
        $Products['data'] = Product::with('productImages')->orderby('id', 'desc')->get();
        return view('admin/product', $Products);
    }

    public function manage_product(Request $request, $id = '')
    {
        $userCategory = UserCategory::get();
        if (!count($userCategory)) return redirect('admin/products');

        if ($id > 0) {
            $product = Product::with('productImages')->where(['id' => $id])->first();
            $result['name'] = $product->name;
            $result['sku'] = $product->sku;
            $result['quantity'] = json_decode($product->qty);
            $result['mrps'] = json_decode($product->mrp);
            $result['prices'] = json_decode($product->price);
            $result['brand_id'] = $product->brand_id;
            $result['category_id'] = $product->category_id;
            $result['description'] = $product->description;
            $result['key_highlight'] = $product->key_highlight;
            $result['specification'] = $product->specification;
            $result['legal_disclaimer'] = $product->legal_disclaimer;
            if (!isset($product['productImages'][0])) {
                $result['productImagesArr']['0']['id'] = '';
                $result['productImagesArr']['0']['image'] = '';
            } else {
                $result['productImagesArr'] = $product['productImages'];
            }
            $result['id'] = $product->id;

        } else {
            $preparedQtyObject = $preparedMrpObject = $preparedPriceObject = $preparedSlabPriceObj = [];
            foreach ($userCategory as $key => $category) {
                $qtyObject = $mrpObject = $priceObject = $slabPriceObj = $slabPrice = [];
                $qtyObject['name'] = $category->name;
                $qtyObject['qty'] = '';
                $mrpObject['name'] = $category->name;
                $mrpObject['mrp'] = '';
                $priceObject['name'] = $category->name;
                $priceObject['price'] = '';
                $slabPriceObj['name'] = $category->name;
                $slabPriceObj['qty'] = '';
                $slabPriceObj['price'] = '';
                $slabPriceObj['margin'] = '';
                $slabPrice[] = $slabPriceObj;
                $preparedQtyObject[] = $qtyObject;
                $preparedMrpObject[] = $mrpObject;
                $preparedPriceObject[] = $priceObject;
                $preparedSlabPriceObj[] = $slabPrice;
            }

            $result['quantity'] = $preparedQtyObject;
            $result['name'] = "";
            $result['sku'] = "";
            $result['mrps'] = $preparedMrpObject;
            $result['prices'] = $preparedPriceObject;
            $result['slab_prices'] = $preparedSlabPriceObj;
            $result['brand_id'] = "";
            $result['category_id'] = "";
            $result['description'] = "";
            $result['key_highlight'] = "";
            $result['specification'] = "";
            $result['legal_disclaimer'] = "";
            $result['image'] = "";
            $result['productImagesArr']['0']['id'] = '';
            $result['productImagesArr']['0']['image'] = '';
            $result['id'] = 0;
        }
        $result['categories'] = Helpers::getCategory();
        $result['brands'] = Helpers::getBrand();
        return view('admin/manage_product', $result);
    }

    public function manage_product_process(Request $request)
    {

        $request->validate([
            //'sku' => 'required|unique:products,sku,' . $request->post('id'),
            //'price' => 'required|array',
            //'mrp' => 'required|array',
            //'qty' => 'required|array',
            //'qty.*' => 'string',
            //'document' => 'required',
            'name' => 'required'
        ]);
        $productImage = null;

        $destinationPath = 'products';

        if ($request->post('id') > 0) {
            $product = Product::find($request->post('id'));
            $product->name = $request->post('name');
            $product->sku = $request->post('sku');
            $preparedQtyObject = $preparedMrpObject = $preparedPriceObject = [];
            $price = $request->post('price');
            $mrp = $request->post('mrp');
            foreach ($request->post('qty') as $key => $qty) {
                $categoryName = Helpers::getUserCategory($key);
                $qtyObject = $mrpObject = $priceObject = [];
                $qtyObject['name'] = $categoryName;
                $qtyObject['qty'] = $qty;
                $mrpObject['name'] = $categoryName;
                $mrpObject['mrp'] = $mrp[$key];
                $priceObject['name'] = $categoryName;
                $priceObject['price'] = $price[$key];
                $preparedQtyObject[] = $qtyObject;
                $preparedMrpObject[] = $mrpObject;
                $preparedPriceObject[] = $priceObject;
            }
            $product->qty =json_encode($preparedQtyObject);
            $product->mrp = json_encode($preparedMrpObject);
            $product->price = json_encode($preparedPriceObject);
            $product->description = $request->post('description');
            $product->brand_id = $request->post('brand_id');
            $product->category_id = $request->post('category_id');
            $product->key_highlight = $request->post('key_highlight');
            $product->specification = $request->post('specification');
            $product->legal_disclaimer = $request->post('legal_disclaimer');
            $product->save();
            foreach ($request->input('document', []) as $file) {
                $productImage = new ProductImage();
                $productImage->product_id = $request->post('id');
                $productImage->image = $file;
                $productImage->save();
            }

        } else {
            $product = new Product();
            $product->name = $request->post('name');
            $product->sku = $request->post('sku');
            $preparedQtyObject = [];
            $price = $request->post('price');
            $mrp = $request->post('mrp');
            foreach ($request->post('qty') as $key => $qty) {

                $categoryName = Helpers::getUserCategory($key);
                $qtyObject = $mrpObject = $priceObject = [];
                $qtyObject['name'] = $categoryName;
                $qtyObject['qty'] = $qty;
                $mrpObject['name'] = $categoryName;
                $mrpObject['mrp'] = $mrp[$key];
                $priceObject['name'] = $categoryName;
                $priceObject['price'] = $price[$key];
                $preparedQtyObject[] = $qtyObject;
                $preparedMrpObject[] = $mrpObject;
                $preparedPriceObject[] = $priceObject;
            }
            $product->qty =json_encode($preparedQtyObject);
            $product->mrp = json_encode($preparedMrpObject);
            $product->price = json_encode($preparedPriceObject);
            $product->description = $request->post('description');
            $product->brand_id = $request->post('brand_id');
            $product->category_id = $request->post('category_id');
            $product->key_highlight = $request->post('key_highlight');
            $product->specification = $request->post('specification');
            $product->legal_disclaimer = $request->post('legal_disclaimer');
            $product->save();
            foreach ($request->input('document', []) as $file) {
                $productImage = new ProductImage();
                $productImage->image = $file;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }
        return redirect('admin/products');
    }

    public function delete(Request $request, $id)
    {
        $category = Product::where('id', $id)->delete();
        return redirect('admin/products');
    }

    public function product_images_delete(Request $request, $paid, $pid)
    {
        $arrImage = ProductImage::where(['id' => $paid])->get();
        if (env('APP_ENV') == 'production') {
            if (Storage::disk('s3')->exists($arrImage[0]->image)) {
                Storage::disk('s3')->delete($arrImage[0]->image);
            }
        } else {
            if (file_exists(public_path($arrImage[0]->image))) {
                unlink($arrImage[0]->image);
            }
        }
        ProductImage::where(['id' => $paid])->delete();
        return redirect('admin/products/manage_product/' . $pid);
    }

    public function storeMedia(Request $request)
    {
        $destinationPath = 'products';
        $file = $request->file('file');
        if (env('APP_ENV') == 'production') {
            $productImagefile = Helpers::storeFileInS3($file, $destinationPath);
        } else {
            $productImagefile = Helpers::storeFileInLocal($file, $destinationPath);
        }

        return response()->json([
            'name' => $productImagefile,
            'original_name' => $file,
        ]);
    }

    public function store(Request $request)
    {
        foreach ($request->input('document', []) as $file) {
            storage_path('tmp/uploads/' . $file);
        }

        return redirect()->route('projects.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
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
        $Products['data'] = Product::with('productImages')->orderby('id', 'desc')->paginate($this->perPage);
        return view('admin/product', $Products);
    }

    public function manage_product(Request $request, $id = '')
    {
        if ($id > 0) {
            $product = Product::with('productImages')->where(['id' => $id])->first();
            $result['name'] = $product->name;
            $result['sku'] = $product->sku;
            $result['qty'] = $product->qty;
            $result['mrp'] = $product->mrp;
            $result['price'] = $product->price;
            $result['brand_id'] = $product->brand_id;
            $result['category_id'] = $product->category_id;
            $result['description'] = $product->description;
            $result['key_highlight'] = $product->key_highlight;
            $result['specification'] = $product->specification;
            $result['legal_disclaimer'] = $product->legal_disclaimer;
            if(!isset($product['productImages'][0])){
                $result['productImagesArr']['0']['id']='';
                $result['productImagesArr']['0']['image']='';
            }else{
                $result['productImagesArr']=$product['productImages'];
            }
            $result['id'] = $product->id;

        } else {
            $result['name'] = "";
            $result['sku'] = "";
            $result['qty'] = "";
            $result['mrp'] = "";
            $result['price'] = "";
            $result['brand_id'] = "";
            $result['category_id'] = "";
            $result['description'] ="";
            $result['key_highlight'] = "";
            $result['specification'] = "";
            $result['legal_disclaimer'] = "";
            $result['image'] = "";
            $result['productImagesArr']['0']['id']='';
            $result['productImagesArr']['0']['image']='';
            $result['id'] = 0;
        }
        $result['categories'] = Helpers::getCategory();
        $result['brands'] = Helpers::getBrand();
        return view('admin/manage_product', $result);
    }

    public function manage_product_process(Request $request)
    {
        $request->validate([
            'sku' => 'required|unique:products,sku,' . $request->post('id'),
            'price' => 'required|numeric',
            'mrp' => 'required|numeric',
            'qty' => 'required|numeric',
            'images.*' =>'mimes:jpg,jpeg,png'
        ]);
        $productImage = null;

        $destinationPath = 'products';

        if ($request->post('id') > 0) {

            $product = Product::find($request->post('id'));
            $product->name = $request->post('name');
            $product->sku = $request->post('sku');
            $product->qty = $request->post('qty');
            $product->mrp = $request->post('mrp');
            $product->price = $request->post('price');
            $product->description = $request->post('description');
            $product->brand_id = $request->post('brand_id');
            $product->category_id = $request->post('category_id');
            $product->key_highlight = $request->post('key_highlight');
            $product->specification = $request->post('specification');
            $product->legal_disclaimer = $request->post('legal_disclaimer');
            $product->save();
            $piidArr=$request->post('piid');
            foreach($piidArr as $key=>$val){
                if($request->hasFile("images.$key")){
                    if($piidArr[$key]!=''){
                        $arrImage=ProductImage::where(['id'=>$piidArr[$key]])->get();

                        if(env('APP_ENV') == 'production') {
                            if (Storage::disk('s3')->exists($arrImage[0]->image)) {
                                Storage::disk('s3')->delete($arrImage[0]->image);
                            }
                        } else {
                            if (file_exists(public_path($arrImage[0]->image))) {
                                unlink($arrImage[0]->image);
                            }
                        }

                    }
                    $fileName=$request->file("images.$key");
                    //$ext=$images->extension();
                    //$image_name=$rand.'.'.$ext;
                    if(env('APP_ENV') == 'production') {
                        $productImagefile = Helpers::storeFileInS3($fileName, $destinationPath);
                    }else{
                        $productImagefile = Helpers::storeFileInLocal($fileName, $destinationPath);
                    }
                    //$request->file("images.$key")->move('products',$image_name);
                    $productImageArr['image']= $productImagefile;

                    if($piidArr[$key]!=''){
                       ProductImage::where(['id'=>$piidArr[$key]])->update($productImageArr);
                    }else{
                        $productImage = new ProductImage();
                        $productImage->product_id = $request->post('id');
                        $productImage->image = $productImagefile;
                        $productImage->save();
                    }

                }
            }

        } else {
            $product = new Product();
            $product->name = $request->post('name');
            $product->sku = $request->post('sku');
            $product->qty = $request->post('qty');
            $product->mrp = $request->post('mrp');
            $product->price = $request->post('price');
            $product->description = $request->post('description');
            $product->brand_id = $request->post('brand_id');
            $product->category_id = $request->post('category_id');
            $product->key_highlight = $request->post('key_highlight');
            $product->specification = $request->post('specification');
            $product->legal_disclaimer = $request->post('legal_disclaimer');
            $product->save();
            $piidArr=$request->post('piid');
            foreach($piidArr as $key=>$val){
                if($request->hasFile("images.$key")){
                    $fileName=$request->file("images.$key");
                    if(env('APP_ENV') == 'production') {
                        $productImagefile = Helpers::storeFileInS3($fileName, $destinationPath);
                    }else{
                        $productImagefile = Helpers::storeFileInLocal($fileName, $destinationPath);
                    }
                    $productImageArr['images']=$productImage;
                    $productImage = new ProductImage();
                    $productImage->image = $productImagefile;
                    $productImage->product_id = $product->id;
                    $productImage->save();
                }
            }

        }
        return redirect('admin/products');
    }

    public function delete(Request $request, $id)
    {
        $category = Product::where('id', $id)->delete();
        return redirect('admin/products');
    }

    public function product_images_delete(Request $request,$paid,$pid){
        $arrImage=ProductImage::where(['id'=>$paid])->get();
        if(env('APP_ENV') == 'production') {
            if (Storage::disk('s3')->exists($arrImage[0]->image)) {
                Storage::disk('s3')->delete($arrImage[0]->image);
            }
        } else {
            if (file_exists(public_path($arrImage[0]->image))) {
                unlink($arrImage[0]->image);
            }
        }
        ProductImage::where(['id'=>$paid])->delete();
        return redirect('admin/products/manage_product/'.$pid);
    }
}

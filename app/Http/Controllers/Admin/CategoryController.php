<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->perPage = env('PER_PAGE_RECORD') ?? 1;
    }

    public function index()
    {
        $category['data'] = Category::orderby('id', 'desc')->get();
        return view('admin/category', $category);
    }

    public function manage_category(Request $request, $id = '')
    {
        $products = Product::pluck('name', 'id');
        if ($id > 0) {
            $category = Category::where(['id' => $id])->first();
            $result['name'] = $category->name;
            $result['image'] = $category->image;
            $result['mapProducts'] = json_decode($category->product_id);
            $result['products'] = $products;
            $result['id'] = $category->id;
        } else {
            $result['name'] = "";
            $result['image'] = "";
            $result['products'] = $products;
            $result['mapProducts'] = [];
            $result['id'] = 0;
        }

        return view('admin/manage_category', $result);
    }

    public function manage_category_process(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $request->post('id')
        ]);
        $categoryImage = null;
        $destinationPath = 'categories';

        if ($request->post('id') > 0) {
            $category = Category::find($request->post('id'));
            $msg = "Project updated";

            if ($image = $request->file('image')) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if (env('APP_ENV') == 'production') {
                    if (Storage::disk('s3')->exists($category->image)) {
                        Storage::disk('s3')->delete($category->image);
                    }
                    $categoryImage = Helpers::storeFileInS3($image, $destinationPath);
                } else {
                    if (file_exists(public_path($category->image))) {
                        unlink($category->image);
                    }
                    $categoryImage = Helpers::storeFileInLocal($image, $destinationPath);
                }
                $category->image = $categoryImage;
            }

        } else {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $category = new Category();
            $msg = "Project saved";
            if ($image = $request->file('image')) {
                $destinationPath = 'categories';
                if (env('APP_ENV') == 'production') {
                    $categoryImage = Helpers::storeFileInS3($image, $destinationPath);
                } else {
                    $categoryImage = Helpers::storeFileInLocal($image, $destinationPath);
                }
                $category->image = $categoryImage;
            }
        }

        $category->name = $request->post('name');
        $category->product_id = json_encode($request->post('mapProduct'));
        $category->save();
        return redirect('admin/categories');
    }

    public function delete(Request $request, $id)
    {
        $category = Category::where('id', $id)->delete();
        return redirect('admin/categories');
    }
}

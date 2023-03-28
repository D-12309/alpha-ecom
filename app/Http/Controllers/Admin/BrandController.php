<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\Helpers;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->perPage = env('PER_PAGE_RECORD') ?? 1;
    }

    public function index()
    {
        $brand['data'] = Brand::orderby('id', 'desc')->paginate($this->perPage);
        return view('admin/brand', $brand);
    }

    public function manage_brand(Request $request, $id = '')
    {
        if ($id > 0) {
            $brand = Brand::where(['id' => $id])->first();
            $result['name'] = $brand->name;
            $result['image'] = $brand->image;
            $result['id'] = $brand->id;
        } else {
            $result['name'] = "";
            $result['image'] = "";
            $result['id'] = 0;
        }

        return view('admin/manage_brand', $result);
    }

    public function manage_brand_process(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,' . $request->post('id')
        ]);
        $brandImage = null;
        $destinationPath = 'brands';

        if ($request->post('id') > 0) {
            $brand = Brand::find($request->post('id'));

            if ($image = $request->file('image')) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if (env('APP_ENV') == 'production') {
                    if (Storage::disk('s3')->exists($brand->image)) {
                        Storage::disk('s3')->delete($brand->image);
                    }
                    $brandImage = Helpers::storeFileInS3($image, $destinationPath);
                } else {
                    if (file_exists(public_path($brand->image))) {
                        unlink($brand->image);
                    }
                    $brandImage = Helpers::storeFileInLocal($image, $destinationPath);
                }
                $brand->image = $brandImage;
            }

        } else {
            $brand = new Brand();
            if ($image = $request->file('image')) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $destinationPath = 'brands';
                if (env('APP_ENV') == 'production') {
                    $brandImage = Helpers::storeFileInS3($image, $destinationPath);
                } else {
                    $brandImage = Helpers::storeFileInLocal($image, $destinationPath);
                }
                $brand->image = $brandImage;
            }
        }

        $brand->name = $request->post('name');
        $brand->save();
        return redirect('admin/brands');
    }

    public function delete(Request $request, $id)
    {
        $category = Brand::where('id', $id)->delete();
        return redirect('admin/brands');
    }
}

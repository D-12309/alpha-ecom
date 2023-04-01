<?php

namespace App\Traits;


use App\Models\Brand;
use App\Models\Category;
use App\Models\UserCategory;

trait Helpers
{
    public static function storeFileInS3($fileName, $filePath)
    {
        $generateFileName = rand('1111111111', '9999999999') . "." . $fileName->getClientOriginalExtension();
        $destinationFileUrl = $filePath . "/" . $generateFileName;
        $filePath = $filePath."/";
        $fileName->storeAs($filePath, $generateFileName, 's3');
        return $destinationFileUrl;
    }

    public static function storeFileInLocal($fileName, $filePath)
    {
        $generateFileName = rand('1111111111', '9999999999') . "." . $fileName->getClientOriginalExtension();
        $destinationFileUrl = $filePath . "/" . $generateFileName;
        $filePath = $filePath."/";
        $fileName->move($filePath, $generateFileName);
        return $destinationFileUrl;
    }

    public static function getCategory() {
        return Category::pluck('name','id');
    }

    public static function getBrand() {
        return Brand::pluck('name','id');
    }

    public static function getUserCategory($id) {
         $userCategory = UserCategory::pluck('name');
         return $userCategory[$id];
    }

    public static function getTypes() {
        return [
            1 => "Super Admin",
            "Sub Admin",
        ];
    }
    public static function getType($type) {
        if (!$type) return null;
        $types = [
            1 => "Super Admin",
            "Sub Admin",
        ];
        $typeName = $types[$type];
        return $typeName;
    }

}

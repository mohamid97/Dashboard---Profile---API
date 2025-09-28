<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Api\Admin\Category;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ResponseTrait;
    public function getBrand(Request $request){
        try{
            $request->validate([
                'id'=>'required|exists:categories,id'
            ]);
            $category = Category::with('brands')->findOrFail($request->id);
            return $this->success(
                [
                    
                   $category->brands->map(
                        fn($brand) => [
                            'id'    => $brand->id,
                            'title' => $brand->title, 
                        ]
                    )
                ]
                    , __('main.brands')
            );


        }catch(\Exception $e){
          return $this->error($e->getMessage(), 500);

        }
        
    }
}
<?php

namespace App\Http\Resources\Api\Admin;

use App\Traits\HandlesImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    use HandlesImage;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


      
    return [      
        'id' => $this->id,
        'title' => $this->getColumnLang('title'),
        'slug' => $this->getColumnLang('slug'),
        'price' => $this->price,
        'category_id' => $this->category_id,
        'category' => $this->whenLoaded('category' , function(){
                return [
                    'id'=>$this->category ? $this->category->id : null,
                    'title'=>$this->category ? $this->category->title : null,
                    'slug' => $this->slug  ? $this->category->slug : null
                ];
        }),
        'order' => $this->order,
        'small_des' => $this->getColumnLang('small_des'),
        'des' => $this->getColumnLang('des'),
        'image' => $this->getImageUrl($this->product_image),
        'breadcrumb' => $this->getImageUrl($this->breadcrumb),
        'title_image' => $this->getColumnLang('title_image'),
        'alt_image' => $this->getColumnLang('alt_image'),
        'meta_title' => $this->getColumnLang('meta_title'),
        'meta_des' => $this->getColumnLang('meta_des'),
        'order'=>$this->order,
        'category' => $this->whenLoaded('category', function () {
                    return [
                        'id' => $this->category->id,
                        'name' => $this->category->title,
                        'slug' => $this->category->slug,
                    ];
        }),
        'barcode'=>$this->barcode,
        'status'=>$this->status,
        'created_at' => $this->created_at?->format('Y-m-d'),
        'updated_at' => $this->updated_at?->format('Y-m-d'),
    
    ];

    

        

        
    }


    

    
}
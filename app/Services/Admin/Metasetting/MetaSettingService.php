<?php

namespace App\Services\Admin\Metasetting;

use App\Models\Api\Admin\MetaSetting;
use App\Services\BaseModelService;
use App\Traits\StoreMultiLang;
class MetasettingService extends BaseModelService
{
    use StoreMultiLang;
    
   protected string $modelClass = MetaSetting::class;


   public function store()
   {
   

        foreach ($this->data['models'] as $key => $value) {
   
            $metasetting = MetaSetting::where('name', $key)->first();
            $banner = $this->uploadSingleImage(['banner'], 'uploads/banners'); 
               
                
            if (isset($metasetting)) {
                $metasetting->update(['name' => $key , 'banner'=>($banner) ? $banner :  $metasetting->banner]);
            } else {  
                        
                $metasetting = MetaSetting::create([
                    'name'   => $key,
                    'banner' => $banner
                ]);             
               
            }
            
            
            $this->processTranslations($metasetting, $this->data['models'][$key], ['meta_title',  'meta_des']);
        }

        return $this->modelClass::all();

       
   }

   

     
}
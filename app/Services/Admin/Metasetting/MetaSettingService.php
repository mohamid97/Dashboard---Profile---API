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
            $metasetting = MetaSetting::where('name', $this->data['models'][$key])->first();
                $this->uploadSingleImage(['banner'], 'uploads/banners'); 
            if ($metasetting) {
                $metasetting->update(['name' => $this->data['models'][$key]]);
            } else {
                $metasetting = new MetaSetting(['name' => $this->data['models'][$key]]);
            }
            $this->processTranslations($metasetting, $this->data['models'][$key], ['meta_title',  'meta_des']);
        }
        return $this->modelClass::all();

       
   }

   

     
}
<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Controller;
use App\Services\Front\Profile\FrontendService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\ResponseTrait;
class FrontendController extends Controller
{
    use ResponseTrait;
    
    public $frontend;
    public function __construct(FrontendService $frontend)
    {
        $this->frontend = $frontend;
        
    }

    public function get(Request $request){

       
        try{
            if(!$request->has('model')){              
                return $this->error(__('main.no_model') , 404);
            }
            $studlyName    = Str::studly($request->model);
            $modelClass    = $this->frontend->getModel($studlyName);
            $resourceClass =  "App\\Http\\Resources\\Api\\Admin\\{$studlyName}Resource";
            return  $this->frontend->getQuery($modelClass , $resourceClass , $request);

        }catch(\Exception $e){
            return $this->error($e->getMessage() , 500);
        }


         

       
        


        
        return $this->success($reponseData, __('main.stored_successfully', ['model' => $studlyName]));
        

        
        
    }



    
}
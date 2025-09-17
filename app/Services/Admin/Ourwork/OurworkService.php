<?php

namespace App\Services\Admin\Ourwork;

use App\Models\Api\Admin\Ourwork;
use App\Services\BaseModelService;
use App\Traits\HandlesImage;
use App\Traits\StoreMultiLang;
use Illuminate\Database\Eloquent\Builder;

class OurworkService extends BaseModelService{
    use StoreMultiLang , HandlesImage;
    protected string $modelClass = Ourwork::class;

    private function uploadOurworkImages(&$data){
        
        $data['images'] = array_map(function($image) {
            return $this->uploadImage($image, 'uploads/ourworks');
        }, $data['images']);
        return $data['images'];

        
    }


    public function all($request){
        $ourworks = parent::all($request);
        return $ourworks;
    }

    public function view($id){
        $details = parent::view($id);
        return $details;
    }

    public function store()
    {

        $this->uploadSingleImage(['breadcrumb' , 'ourwork_image'], 'uploads/ourworks');   
        $ourwork = parent::store($this->getBasicColumn(['ourwork_image','link','type' ,'breadcrumb' ,'clinet_id','category_id','date']));
        $this->processTranslations($ourwork, $this->data, ['title', 'des','meta_des' , 'meta_title' , 'slug' , 'small_des' , 'location']);  
        return $ourwork;
        
    }
    


    public function update($id){

        $this->uploadSingleImage(['breadcrumb' , 'ourwork_image'], 'uploads/ourworks');

        $ourwork = parent::update($id , $this->getBasicColumn(['ourwork_image','link', 'type','breadcrumb' ,'clinet_id','category_id','date']));
        $this->processTranslations($ourwork, $this->data, ['title', 'des','meta_des' , 'meta_title' , 'slug' , 'small_des' , 'location']);
        return $ourwork;
        
    }

    public function delete($id){
        $ourwork = parent::delete($id);
        return $ourwork;
        
    }


    public function applySearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->whereHas('translations', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('des', 'like', "%{$search}%");
            });
        });
        
    }


    public function orderBy(Builder $query, string $orderBy, string $direction)
    {
        return $query->orderBy($orderBy, $direction);
    }

    public function type(Builder $query, string $type)
    {
        return $query->where('type', $type);
    }
    
    

}
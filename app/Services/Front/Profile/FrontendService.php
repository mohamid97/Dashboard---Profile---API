<?php 
namespace App\Services\Front\Profile;

class FrontendService{
    
    private $reponseData = [];
    
    public function getModel($studlyName){
        $modelClass = "App\\Models\\Api\\Admin\\{$studlyName}";
        if (!class_exists($modelClass)) {
            throw new \Exception("Model {$studlyName} does not exist.");
        }

        return $modelClass;
    }

    public function getQuery($modelClass, $resourceClass , $request){
    
        $query = $modelClass::query();
            if ($request->has('order') && in_array($request->order, ['asc', 'desc' , 'ASC', 'DESC'])) {
                    $orderBy = $request->order_by ?? 'id';
                    $query->orderBy($orderBy, $request->order);
        }

        
        if ($request->has('pagination') && $request->pagination > 0) {
            $query = $query->paginate($request->pagination);
            $this->createResponsePaginate($query);

        } else {
            if($request->has('id')){
                $query = $query->where('id' , $request->id)->get();
            }else{
              $query = $query->get();
            }
            
            
        }

        $this->createResponseItem($query , $resourceClass);



        return $this->reponseData;
    }

    private function createResponsePaginate($query){
           $this->reponseData['pagination'] = 
            [      
                        'current_page' => $query->currentPage(),
                        'last_page' => $query->lastPage(),
                        'per_page' => $query->perPage(),
                        'total' => $query->total(),
            ];
    }


    private function createResponseItem($query , $resourceClass){
         $this->reponseData['item'] = $resourceClass::collection($query);
    }

    

    
}
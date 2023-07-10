<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use App\models\firstModel;
use Illuminate\Http\Request;

class getListController extends Controller
{
    //read data from db and return json
    public function read(Request $r){
        if($r->query('take')){

            //convert query to int
            $take=$r->query('take');
            settype($take, 'int');
            
            //perform comparison operation
            if($take<=50)
                return json_encode(firstModel::paginate($take),JSON_UNESCAPED_SLASHES);
            else
                return json_encode(firstModel::paginate(50),JSON_UNESCAPED_SLASHES); 
        }
        else
            return json_encode(firstModel::paginate(10),JSON_UNESCAPED_SLASHES);
    }
}

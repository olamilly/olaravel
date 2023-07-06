<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use App\models\firstModel;
use Illuminate\Http\Request;

class getListController extends Controller
{
    //read data from db and return json
    public function read(){
        return json_encode(firstModel::paginate(10),JSON_UNESCAPED_SLASHES);
    }
}

<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use App\models\firstModel;
use Auth;
use Illuminate\Http\Request;

class todoController extends Controller
{
    //  
    public function create(Request $data){
        $newData = new firstModel;
        $newData->name = $data->name;
        $newData->content = $data->content;
        $newData->save();
        return response()->json(firstModel::all());
    }

    public function read(Request $r){
        $max = 50;
        $take = $r->has('take') ? $r->query('take') : 10;
        $take = ($take>$max) ? 50 : $take;
        return response()->json(firstModel::paginate($take), 200, [], JSON_UNESCAPED_SLASHES);
    }
    
    public function update(string $id, Request $r){
        $model = firstModel::where("id",$id)->first();
        if($model->user_id != Auth::User()->id){
            return response()->json(["message"=>"You are not authorized to modify this item."]);
            
        }
        $model->name = $r->name;
        $model->content = $r->content;
        $model->update();
        return response()->json($model);
    }
    public function complete(string $id){
        $model = firstModel::where("id",$id)->first();
        if($model->user_id != Auth::User()->id){
            return response()->json(["message"=>"You are not authorized to modify this item."]);
        }
        $model->completed = 1;
        $model->update();
        return response()->json($model); 
    }
    public function delete(string $id){
        $tbd = firstModel::where("id",$id)->first();
        if($tbd->user_id != Auth::User()->id){
            return response()->json(["message"=>"You are not authorized to modify this item."]);
        }
        $tbd->delete();
        return response()->json(firstModel::all()); 
    }


}

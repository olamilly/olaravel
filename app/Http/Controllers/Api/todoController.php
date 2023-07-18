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
    
    public function update(Request $r){
        //\Log::info($r->id);
        $model = firstModel::where("id",$r->id)->first();
        if($model->user_id == Auth::User()->id){
            $model->name = $r->name;
            $model->content = $r->content;
            $model->update();
            return response()->json($model);
        }
        else{
            return response()->json(["message"=>"You are not authorized to modify this item."]);
        } 
    }
    public function complete(string $id){
        $model = firstModel::where("id",$id)->first();

        if($model->user_id == Auth::User()->id){
            $model->completed = 1;
            $model->update();
            return response()->json($model);
        }
        else{
            return response()->json(["message"=>"You are not authorized to modify this item."]);
        } 
    }
    public function delete(Request $id){
        $tbd = firstModel::where("id",$id->id)->first();

        if($tbd->user_id == Auth::User()->id){
            $tbd->delete();
            return response()->json(firstModel::all());
        }
        else{
            return response()->json(["message"=>"You are not authorized to modify this item."]);
        } 
    }


}

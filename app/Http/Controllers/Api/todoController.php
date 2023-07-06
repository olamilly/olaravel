<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use App\models\firstModel;
use Illuminate\Http\Request;

class todoController extends Controller
{
    //
    public function index(){
        return json_encode(
            ['Routes'=>["login"=>"http://localhost:8080/ltestwauth/public/api/login","sign-up"=>"http://localhost:8080/ltestwauth/public/api/register"],
            'Protected Routes'=>["create/add_new_item"=>"http://localhost:8080/ltestwauth/public/api/create", 'read/list_items'=>"http://localhost:8080/ltestwauth/public/api/list", 'update_item'=>"http://localhost:8080/ltestwauth/public/api/update/{id}", 'delete_item'=>"http://localhost:8080/ltestwauth/public/api/delete/{id}", 'current_user_info'=>"http://localhost:8080/ltestwauth/public/api/user"]], JSON_UNESCAPED_SLASHES
        );
        
    }
    
    public function create(Request $data){
        $newData = new firstModel;
        $newData->name = $data->name;
        $newData->content = $data->content;
        $newData->save();
        return response()->json(firstModel::all());
    }
    
    public function update(Request $r){
        //\Log::info($r->id);
        $model = firstModel::where("id",$r->id)->first();
        $model->name = $r->name;
        $model->content = $r->content;
        $model->update();
        return response()->json(firstModel::all());
    }
    public function delete(Request $id){
        $tbd = firstModel::where("id",$id->id)->first();
        $tbd->delete();
        return response()->json(firstModel::all());
    }


}

<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Http\Request;
use App\models\firstModel;

class apiAuthController extends Controller
{
    //
    public function index(){
        return json_encode(
            ['Routes'=>["login"=>"http://localhost:8080/ltestwauth/public/api/login","sign-up"=>"http://localhost:8080/ltestwauth/public/api/register"],
            'Protected Routes'=>["create/add_new_item"=>"http://localhost:8080/ltestwauth/public/api/create", 'read/list_items'=>"http://localhost:8080/ltestwauth/public/api/list", 'update_item'=>"http://localhost:8080/ltestwauth/public/api/update/{id}", 'delete_item'=>"http://localhost:8080/ltestwauth/public/api/delete/{id}", 'current_user_info'=>"http://localhost:8080/ltestwauth/public/api/user"]], JSON_UNESCAPED_SLASHES
        );
        
    }
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'confirm_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('user-token')-> plainTextToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], 200); 
    }

    public function login(Request $r){ 
        \Log::info($r);
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('user-token')-> plainTextToken; 
            return response()->json(['success' => $success], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Credentials incorrect, Login Unauthorised. Register or check login data and try again'], 401); 
        } 
    }

    public function create(Request $data){
        $newData = new firstModel;
        $newData->name = $data->name;
        $newData->content = $data->content;
        $newData->save();
        return response()->json(firstModel::all());
    }
    public function read(){
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

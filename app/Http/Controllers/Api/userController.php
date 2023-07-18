<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    //
    public function read(){
        return Auth::user();
    }
    public function update(Request $r){
        $id = Auth::id();
        $model = User::where("id",$id)->first();
        if($r->name){
            $model->name = $r->name;
        }
        if($r->email){
            $model->email = $r->email;
        }
        $model->update();
        return $model;
    }
    public function delete(){
        $id = Auth::id();
        $model = User::where("id",$id)->first();
        $message=str_replace("name", $model->name, "User name has been deleted successfully");
        $model->delete();
        return response->json(["message"=>$message]);
    }
}

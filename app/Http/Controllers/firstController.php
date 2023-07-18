<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\firstModel;
use App\models\User;
use Illuminate\Support\Facades\Auth;
class firstController extends Controller
{
    //
    public function form()
    {
        return view("form");
    }
    public function successful(Request $myData){
        $user = User::find(Auth::User()->id);
        $newData = new firstModel;
        $newData->username = $myData->name;
        $newData->content = $myData->content;
        $user = $user->todoItems()->save($newData);
        return redirect ("/home");
    }
    public function delete(Request $r){
        $tbd=firstModel::find($r->item_id);
        if($tbd->user_id == Auth::User()->id){
            $tbd->delete();
            return redirect ("/home");
        }
        else{
            return redirect ("/home");
        }
        
    }
    public function edit($id){
        $editdata = firstModel::find($id);
        if($editdata->user_id == Auth::User()->id){
            return view("edit",["editData"=>$editdata]);
        }
        else{
            return redirect ("/home");
        }
    }
    public function update(Request $myData){
        $model = firstModel::find($myData->id);
        if($model->user_id == Auth::User()->id){
            $model->username = $myData->name;
            $model->content = $myData->content;
            $model->update();
            return redirect ("/home");
        }
        else{
            return redirect ("/home");
        }     
    }
}

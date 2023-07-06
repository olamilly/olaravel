<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\firstModel;
class firstController extends Controller
{
    //
    public function form()
    {
        return view("form");
    }
    public function successful(Request $myData){
        $newData = new firstModel;
        $newData->name = $myData->name;
        $newData->content = $myData->content;
        $newData->save();
        return redirect ("/home");
    }
    public function delete($id){
        \Log::info($id);
        $tbd=firstModel::find($id);
        $tbd->delete();
        return redirect ("/home");
    }
    public function edit($id){
        return view("edit",["editData"=>firstModel::find($id)]);
    }
    public function update(Request $myData){
        $tbd=firstModel::find($myData->id);
        $tbd->name = $myData->name;
        $tbd->content = $myData->content;
        $tbd->update();
        return redirect ("/home");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\firstModel;
use App\Models\User;

class adminController extends Controller
{
    //
    public function index(){
        $todolist = firstModel::all();
        $userlist = User::all();
        $userCount = count($userlist);
        $todoCount = count($todolist);
        return view("admindashboard",["userNumber"=>$userCount, "todoNumber"=>$todoCount]);
    }
    public function users(){
        $userlist = User::all();
        return view("users", ["users"=>$userlist]);
    }
    public function items(){
        return view("itemlist",["items"=>firstModel::all()]);
    }
    public function userdetails(string $id){
        $useritems = firstModel::where('user_id', $id)->get();
        return view("userdetails", ["items"=>$useritems, "user"=>User::where("id",$id)->first()]);
    }
}

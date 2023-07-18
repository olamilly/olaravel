<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class webUserController extends Controller
{
    //
    public function read(){
        return view('profile');
    }
    public function editpage(string $id){
        $model = User::where("id",$id)->first();
        if(Auth::User()->id == $id || Auth::User()->role =="admin"){
            $name = $model->name;
            $email = $model->email;
            return view('edituser', ["name"=>$name, "email"=>$email, "id"=>$id]);
        }
        else{
            return redirect("home");
        }
        
    }
    public function update(Request $r){
        \Log::info($r);
        if(Auth::User()->role =="admin" || Auth::User()->id == $r->id){
            $model = User::where("id",$r->id)->first();
            if($r->name){
                $model->name = $r->name;
            }
            if($r->email){
                $model->email = $r->email;
            }
            if($r->role){
                $model->role = $r->role;
            }
            $model->update();
            if(Auth::User()->role =="admin"){
                return redirect('/admin/users');
            }
            return redirect('/user');
        }
    }
    public function deleteadmin(Request $r){
        $model = User::where("email",$r->email)->first();
        if($model){
            if($model->role == "admin"){
                if (Hash::check($r->password, $model->password)) {
                    $m2 = User::where("id",$r->tbd_id)->first();
                    if (Auth::User()->id == $m2->id ){
                        $m2->delete();
                        return redirect ("/login");
                    }
                    else{
                        $m2->delete();
                        return redirect('/admin/users');
                    }
                }
                else
                    \Log::info("Incorrect credentials");
                    return redirect('/admin/users');
            }
            else{
                \Log::info("User Not Admin");
                return redirect('/admin/users');
            }      
        }
        else{
            \Log::info("User Not found");
            return redirect('/admin/users');
        }
            
    }
   
    public function delete(Request $r){
        \Log::info($r);
        $model = User::where("id",$r->user_id)->first();
        if (Auth::User()->id != $model->id && Auth::User()->role!="admin"){
            return redirect ("/home");
        }
        if (Auth::User()->id == $model->id ){
            $model->delete();
            return redirect ("/login");
        }
        if (Auth::User()->id != $model->id && Auth::User()->role=="admin"){
            $model->delete();
            return redirect('/admin/users');
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\firstModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',["items"=>firstModel::paginate(3)]);
    }
}

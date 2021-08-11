<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return view('home');
    }

    public function handleAdmin()
    {
        return view('handleAdmin');
    }

    public function userUpdate(request $request)
    {
        // dd($request->all());
        if(($request->status) == "Student")
        {
            $request->status = 0;
        }
        else{
            $request->status =1;
        }
        print_r ($request->status);
    }
}

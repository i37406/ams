<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\storage;

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
        if ($request->hasFile('image')) {
            $filename= $request->image->getClientOriginalName();
            $extension = $request->image->getClientOriginalExtension();
            if($extension == 'jpg' || $extension == 'png'){
                if(auth()->user()->avatar){
                storage::delete('/public/images/'. auth()->user()->avatar );
                }
                $request->image->storeAs('images', $filename, 'public');
                }
                else
               {
               return redirect()->back()->with('error' , 'Upload image only(.jpg or .png).');
               }
        }
             auth()->User()->update([
            'dob' => $request->dob,
            'address' => $request->address,
            'cell' => $request->cellNo,
            'avatar' => $filename
        ]);

        return redirect(route('home'))->with('message','Updated Sucessfull');
    }

    public function updateImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $filename= $request->image->getClientOriginalName();
            $extension = $request->image->getClientOriginalExtension();
            if($extension == 'jpg' || $extension == 'png'){
                if(auth()->user()->avatar){
                storage::delete('/public/images/'. auth()->user()->avatar );
                }
                $request->image->storeAs('images', $filename, 'public');
                auth()->User()->update([
                    'avatar' => $filename
                ]);
                return redirect()->back()->with('message' , 'Image Updated Sucessfully');
                }
                else
               {
               return redirect()->back()->with('error' , 'Upload image only(.jpg or .png).');
               }
        }else{
            return redirect()->back()->with('error' , 'Select Image first');
        }
    }

    

}

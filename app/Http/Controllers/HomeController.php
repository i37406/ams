<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $data = auth()->User();
        if ($data->is_admin){
            $data->is_admin = "Administrator";
        }else{
            $data->is_admin = "Student";
        }
        return view('handleAdmin',compact(['data']));
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

    public function applyLeave(Request $request)
    {
        $s_date= Carbon::parse($request->sdate);
        $e_date= Carbon::parse($request->edate);
        $n_date=$s_date;
        $t_days = 0;
            $check = DB::table('attendances')
            ->where('user_id', '=', auth()->user()->id)
            ->where('leave_apply_status', '=', 1)
            ->Where(function($query) {
                $query->where('leave_approved_status', '=', 0)
                      ->where('leave_disapprove_status', '=', 0);
            })
            ->count();
            if($check == 0){
                while ($n_date <= $e_date) {
                    $data = new Attendance;
                    $data->user_id = auth()->user()->id;
                    $data->attendance_date = $n_date;
                    $data->leave_reason = $request->reason;
                    $data->leave_apply_status = '1';
                    $data->save();
                    $n_date->addDay();
                    $t_days++;
                    }
                    return redirect(route('home'))->with('message','Your Leave Application for '.$t_days.' day(s) submitted sucessfully');
            }else{
                return redirect(route('home'))->with('error','You Already Apply for Leave. For more Assistant contact with supervisior');
            }
            
            
        
        
    }

    public function handleLeaves()
    {
        return view('admin.leaves');
    }

}

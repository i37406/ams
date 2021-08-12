<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = DB::table('attendances')
                ->where('user_id', '=', auth()->user()->id)
                ->where('attendance_date', '=', today())
                ->get();

        if($check->isEmpty()){
            $data = new Attendance;
            if(Arr::has($request, 'attend')){
                $data->attendance = $request->attend;
                $message = "Present";
            }else{               
                $data->attendance = 'A';
                $message = "Absent";                
            } 
            
            $data->user_id = auth()->user()->id;
            $data->attendance_date = today();
            $data->save();
            return redirect(route('home'))->with('message',$message.' Marked Successfully');
            
        }else{
            return redirect(route('home'))->with('error','You Already Marked Attendance for Today');
        }            
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function today($format=null)
    {
	    $format = $format ? $format:'Y-m-d';
	    return Carbon::today()->format($format);
    }

    
}

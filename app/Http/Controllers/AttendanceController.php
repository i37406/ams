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
        //If marked by Admin
        if(Arr::has($request, 's_id')){
            // dd($request->all());
            $check = DB::table('attendances')
            ->where('user_id', '=',$request->s_id)
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
        
        $data->user_id = $request->s_id;
        $data->attendance_date = today();
        $data->save();
        return redirect()->back()->with('message',$message.' Marked Successfully');
        
    }else{
        return redirect()->back()->with('error','Today Attendance already marked. For further action you are able to update it.');
    }
        }
        //if marked by student
        else{
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
        // dd($id);
        $data = Attendance::where('id', $id)->get();
        // dd($data);
        return view('admin.attendanceEdit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
       
        if(Arr::has($request, ['date'])){
            // dd($request->all());
            $data = Attendance::find($id);
            $data->leave_approved_status = 0;
            $data->attendance = $request->attend;
            $data->attendance_date = $request->date;
            $data->save();
            return redirect(route('admin.populate'))->with('message','Updated Sucessfully!!');
        }else{
        if(Arr::has($request, ['approved','disaprove'])){
            return redirect(route('admin.route'))->with('error','Please Select one choice at a time Approved or Disapproved.');
        } else if(Arr::has($request, ['approved'])){
            $data = Attendance::find($id);
            $data->leave_approved_status = 1;
            $data->attendance = 'L';
            $data->save();
            return redirect(route('admin.route'))->with('message','Approved successfully');       
        } else if(Arr::has($request, ['disaprove'])){
            $data = Attendance::find($id);
            $data->leave_disapprove_status = 1;
            $data->save();
            return redirect(route('admin.route'))->with('message','Disapproved successfully');
        }
        else{
            return redirect(route('admin.route'))->with('error','Select one Approved/Disapproved');
        }
    }
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

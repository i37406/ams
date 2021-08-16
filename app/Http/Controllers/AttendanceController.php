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

    

    public function store(Request $request)
    {
        $data = new Attendance;
        if(Arr::has($request, 'attend')){
            $data->attendance = $request->attend;} else {$data->attendance = 'A';}
            $data->attendance_date = today();
        //if marked by admin
        if(Arr::has($request, 's_id')){
            $user_id= $request->s_id;
            $data->user_id = $request->s_id;
        }else{ //if marked by student
            $user_id=auth()->user()->id;
            $data->user_id = auth()->user()->id;
        }
        //if db contain record with today date
        $check = DB::table('attendances')
            ->where('user_id', '=',$user_id)
            ->where('attendance_date', '=', today())
            ->count();
        if($check){ //yes db contain
                //if user apply for leave but not approve/disaprove
                if( $check = DB::table('attendances')
                ->where('user_id', '=',$user_id)
                ->where('attendance_date', '=', today())
                ->where('leave_apply_status','1')
                ->where('leave_approved_status','0')
                ->where('leave_disapprove_status','0')
                ->count()){
                    return redirect(route('home'))->with('error','User apply for leave. Application is not Approved/Disapproved.');
                }
                //if user granted leave for today
                else if( $check = DB::table('attendances')
                ->where('user_id', '=',$user_id)
                ->where('attendance_date', '=', today())
                ->where('leave_apply_status','1')
                ->where('leave_approved_status','1')
                ->where('leave_disapprove_status','0')
                ->count()){
                    return redirect(route('home'))->with('error','User is on leave for today');
                }
                //if disapprove today leave
                else if( $check = DB::table('attendances')
                ->where('user_id', '=',$user_id)
                ->where('attendance_date', '=', today())
                ->where('leave_apply_status','1')
                ->where('leave_approved_status','0')
                ->where('leave_disapprove_status','1')
                ->count()){
                            $query = Attendance::where('user_id', '=',$user_id)
                                                ->where('attendance_date', '=', today())
                                                ->where('leave_apply_status','1')
                                                ->where('leave_approved_status','0')
                                                ->where('leave_disapprove_status','1')
                                                ->update([
                                                        'attendance' => $data->attendance
                                                ]);
                return redirect(route('home'))->with('message','User apply leave for today which is disapproved for some reason. Now '.$data->attendance.' Marked Successfully');
                }
                //if user already marked attendance for today
                else if( $check = DB::table('attendances')
                ->where('user_id', '=',$user_id)
                ->where('attendance_date', '=', today())
                ->where('leave_apply_status','0')
                ->where('leave_approved_status','0')
                ->where('leave_disapprove_status','0')
                ->count()){
                    return redirect(route('home'))->with('error','Attendance already marked for today');
                }
        }else{ //no not contain
            $data->save();
            return redirect(route('home'))->with('message',$data->attendance.' Marked Successfully');
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
       //Update Attendance
        if(Arr::has($request, ['date'])){
            // dd($request->all());
            $data = Attendance::find($id);
            $data->leave_approved_status = 0;
            $data->attendance = $request->attend;
            $data->attendance_date = $request->date;
            $data->save();
            return redirect(route('admin.leave'))->with('message','Updated Sucessfully!!');
        }else{
            //Approved Leaves
        if(Arr::has($request, ['approved','disaprove'])){
            return redirect(route('admin.leave'))->with('error','Please Select one choice at a time Approved or Disapproved.');
        } else if(Arr::has($request, ['approved'])){
            $data = Attendance::find($id);
            $data->leave_approved_status = 1;
            $data->attendance = 'L';
            $data->save();
            return redirect(route('admin.leave'))->with('message','Approved successfully');       
        } else if(Arr::has($request, ['disaprove'])){
            $data = Attendance::find($id);
            $data->leave_disapprove_status = 1;
            $data->save();
            return redirect(route('admin.leave'))->with('message','Disapproved successfully');
        }
        else{
            return redirect(route('admin.leave'))->with('error','Select one Approved/Disapproved');
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
        // dd($id);
        // $id->delete();
        $user=Attendance::find($id);
        $user->delete();
		return redirect()->back()->with('message',' Deleted successfully');
    }
    public function today($format=null)
    {
	    $format = $format ? $format:'Y-m-d';
	    return Carbon::today()->format($format);
    }

    
}

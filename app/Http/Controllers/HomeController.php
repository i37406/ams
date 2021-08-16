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
        return view('admin.dashboard',compact(['data']));
    }

    public function userUpdate(request $request)
    {
        if ($request->hasFile('image')) {
            $filename= $request->image->getClientOriginalName();
            $extension = $request->image->getClientOriginalExtension();
            if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg'){
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
            if($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg'){
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
    public function viewStudents()
    {
        return view('admin.students');
    }
    public function manageAttendance()
    {
        $data = User::all();
        // dd($data);
        return view('admin.manageAttendance',compact('data'));
    }
    //generate Report for specific User
    public function populateAttendance(Request $request)
    {
        
        if(Arr::has($request, 'sdate')){
            // dd($request->all());
            $s_date= Carbon::parse($request->sdate);
            $e_date= Carbon::parse($request->edate);
            // $s_date->subDays(1);
            // $e_date->addDays(1);
            $str = ' From '.$request->sdate.' To '.$request->edate;
            $user= User::find($request->s_id);
            $data = Attendance::where('user_id', $request->s_id)
                                ->whereBetween('attendance_date', [$s_date, $e_date])
                                ->orderBy('attendance_date','DESC')
                                ->get();
                                // dd($e_date);
            
            return view('admin.specificStuReport',compact(['data','user','str']));
        }else{
        $user= User::find($request->s_id);
        $data = Attendance::where('user_id', $request->s_id)->orderBy('attendance_date','DESC')->get();
        return view('admin.population',compact(['data','user']));}
    }
    
    public function manageReports()
    {
        
        $users = DB::table('attendances')
            ->join('users', 'users.id', '=', 'attendances.user_id')
            ->select('users.name','users.id')
            ->selectRaw('COUNT(attendances.attendance) as TotalAttendance ')
            ->selectRaw("count(case when attendance = 'P' then 1 end) as present")
            ->selectRaw("count(case when attendance = 'A' then 1 end) as absent")
            ->selectRaw("count(case when attendance = 'L' then 1 end) as leav")
            ->groupBy('users.name','users.id')
            ->get();
            // dd($users);
        return view('admin.reports',compact(['users']));
    }
    
    public function allUserReportRange(Request $request)
    {
        $s_date= Carbon::parse($request->sdate);
        $e_date= Carbon::parse($request->edate);
        $s_date->subDays(1);
        $e_date->addDays(1);
        $str = ' From '.$request->sdate.' To '.$request->edate;
        // $data = Attendance::join('users', 'users.id', '=', 'attendances.user_id')
        //                     ->whereBetween('attendance_date', [$s_date, $e_date])
        //                     ->groupBy('users.name')
        //                     ->get();
        $data = User::join('attendances', 'user_id', '=', 'users.id')
                            ->select('users.name','users.id','attendances.attendance','attendances.attendance_date')
                            ->whereBetween('attendance_date', [$s_date, $e_date])
                            ->orderBy('attendance_date')
                            ->get()
                            ->groupBy('users.name');
       
        // $data = array();
        
        // $user_count = User::all()->count();
        //     for ($i=1; $i <=$user_count ; $i++) { 
        //         $userName = User::find($i)->name;
        //         $query = User::find($i)->attends;
        //         // $data = Arr::add(['username' => null, 'data' => null],'username',$userName,'data',$query);
        //         $data = Arr::add(['username' => null],'username',$userName);
        //         $data = Arr::add(['data' => null],'data',$query);
        //         // $array = Arr::add(['name' => 'Desk', 'price' => null], 'price', 100);
        //     }
        //                     dd($data);
        
        
        return view('admin.reportRange',compact(['data','str']));
       
    }

    //Student Function
    public function seeAttendance()
    {
        // dd(auth()->user()->name);
        $user_name = auth()->user()->name;
        $data = DB::table('attendances')
            ->select('user_id')
            ->selectRaw('COUNT(attendances.attendance) as TotalAttendance ')
            ->selectRaw("count(case when attendance = 'P' then 1 end) as present")
            ->selectRaw("count(case when attendance = 'A' then 1 end) as absent")
            ->selectRaw("count(case when leave_apply_status = '1' then 1 end) as leav")
            ->selectRaw("count(case when leave_approved_status = '1' then 1 end) as a_leav")
            ->selectRaw("count(case when leave_disapprove_status = '1' then 1 end) as d_leav")
            ->where('user_id',auth()->user()->id)
            ->groupBy('user_id')
            ->get();

            $leave = DB::table('attendances')
            ->select('user_id','leave_reason','leave_approved_status','leave_disapprove_status','attendance_date')
            ->where('user_id',auth()->user()->id)
            ->where('leave_apply_status','1')
            ->paginate(10);
            // dd($leave);
            $d_atten = DB::table('attendances')
            ->select('user_id','attendance','attendance_date')
            ->where('user_id',auth()->user()->id)
            ->where('attendance','!=','')
            ->orderBy('attendance_date','DESC')
            ->paginate(10);
            return view('attendanceStatus',compact(['data','leave','user_name','d_atten']));
    }

    public function gradeStudent(Request $request)
    {
        // dd($request->all());
        $grade= '';
        $check= DB::table('attendances')
                    ->where('user_id',$request->s_id)
                    ->where('attendance','P')
                    ->count();
                    // dd($check);
                    if($check >=26){
                        $grade='A';
                    }else if($check >=20){
                        $grade='B';
                    }else  if($check >=15){
                        $grade='C';
                    }else  if($check >=10){
                        $grade='D';
                    }else  if($check >=5){
                        $grade='F';
                    }else  if($check >=1){
                        $grade='E';
                    }
                    $update_grade = DB::table('users')
                            ->where('id', $request->s_id)
                            ->update(['grade' => $grade]);
                    return redirect()->back()->with('message','Grade '.$grade.' asigned to '.$request->s_name.'.');
    }

    

}

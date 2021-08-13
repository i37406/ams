<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class leaveApp extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $users = DB::table('users')
            ->join('attendances', 'users.id', '=', 'attendances.user_id')
            ->where('attendances.leave_apply_status', '=', '1')
            ->where('attendances.leave_approved_status', '=', '0')
            ->where('attendances.leave_disapprove_status', '=', '0')
            ->select('*')
            ->get();
        return view('components.leave-app',compact(['users']));
    }
}

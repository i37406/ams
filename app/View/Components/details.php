<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Blade;

class details extends Component
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
        $data = auth()->User();
        if ($data->is_admin){
            $data->is_admin = "Administrator";
        }else{
            $data->is_admin = "Student";
        }
        return view('components.details',compact('data'));
    }

   
}

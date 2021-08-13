@extends('layouts.app')
@section('navbar')
<li class="nav-item">
  <a class="nav-link active"  href="{{route('admin.route')}}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link active"  href="{{route('admin.leave')}}">Leave Applications</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active"  href="{{route('admin.leave')}}">Students</a>
  </li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(176, 203, 245);  text-align: center;  font-family: Times New Roman;"><h2>Admin Dashboard</h2></div>
                <x-alert /> 
                <div class="card-header" style="background-color: rgb(217, 224, 233); "><h5>@yield('p_head')</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">                   
                    <div class="container-sm m-4">
                        <div class="row">
                          <div class="col align-self-start">
                           @section('p_content')
                           @show
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(176, 203, 245);  text-align: center;  font-family: Times New Roman;"><h2>Student Dashboard</h2></div>
                <x-alert /> 
                <div class="card-header" style="background-color: rgb(217, 224, 233); "><h5>Update Personal Information</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">
                   
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    
                    <x-details/>
                </div>
            </div>
        </div>
       
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: rgb(176, 203, 245);"><h5>Mark Attendance</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">
                     
                    <div class="container-sm m-4">
                        <div class="row justify-content-center">
                            <div class="col align-self-center">
                                <form method="POST" action="{{route('attendance.store')}}">
                                    @csrf
                                    <div class="col-sm-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="P" id="attend" name="attend" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                          Present
                                        </label>
                                      </div>
                                    </div>
                                   
                                      <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary m-3">Done</button>
                                      </div>
                                </form>
                                <form method="POST" action="{{route('updateUserImage')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-12">
                                        <div class="col-md-6">
                                            <label for="image" class="form-label">Update Image</label>
                                            <input type="file" class="form-control" id="image" name="image">
                                          </div>
                                    </div>
                                   
                                      <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary m-4">Update</button>
                                      </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: rgb(176, 203, 245);"><h5>Apply For Leave</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">
                   
                    <div class="container-sm m-4">
                        <div class="row justify-content-center">
                            <div class="col align-self-center">
                                <form method="POST" action="{{route('apply.leave')}}" >
                                    @csrf
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Reason</label>
                                        <input type="text" class="form-control" id="reason" name="reason" placeholder="Give reason. Why apply Leave?">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="From" class="form-label">From</label>
                                        <input type="text" class="form-control" id="sdate" name="sdate" value="" placeholder="yyyy-mm-dd">
                                      </div>
                                      <div class="col-md-6">
                                        <label for="To" class="form-label">To</label>
                                        <input type="text" class="form-control" id="edate" name="edate" value="" placeholder="yyyy-mm-dd">
                                      </div>
                                      <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary">Apply</button>
                                      </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>


@endsection

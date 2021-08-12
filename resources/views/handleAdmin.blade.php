@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(176, 203, 245);  text-align: center;  font-family: Times New Roman;"><h2>Admin Dashboard</h2></div>
                <x-alert /> 
                <div class="card-header" style="background-color: rgb(217, 224, 233); "><h5>Personal Information</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">                   
                    <div class="container-sm m-4">
                        <div class="row">
                          <div class="col align-self-start">
                            <table class="table">
                              <tr class="table-active">
                                <td>User Name</td>
                                <td>{{$data->name}}</td>
                              </tr>
                              <tr class="table-active">
                                <td>User Email</td>
                                <td> {{$data->email}}</td>
                              </tr>
                              <tr class="table-active">
                                <td>Role</td>
                                <td>{{$data->is_admin}}</td>
                              </tr>
                              <tr class="table-active">
                                <td>Joined</td>
                                <td>{{$data->created_at->diffForHumans()}}</td>
                              </tr>
                              <tr class="table-active">
                                <td>Last Profile Updated</td>
                                <td>{{$data->updated_at->diffForHumans()}}</td>
                              </tr>
                            </table>
                          </div>
                          <div class="col align-self-end">
                            <img src="{{asset('/storage/images/'.Auth::user()->avatar) }}" alt="avatar" width="120" style="border-radius: 50%;display: block; margin: auto;">
                          </div>
                        </div>
                          
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <div class="card-header" style="background-color: rgb(217, 224, 233); "><h5>Leave Applications</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">                   
                    <div class="container-sm">
                        <div class="row">
                          <div class="col align-self-start">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                <td>Student Name</td>
                                <td>Reason</td>
                                <td>Date</td>
                                <td>Action</td>
                                </tr>
                              </thead>
                              @foreach ($users as $item)
                              <tbody>
                              <tr >
                                <td>{{$item->name}}</td>
                                <td>{{$item->leave_reason}}</td>
                                <td>{{$item->attendance_date}}</td>
                                <td><form method="post" action="{{route('attendance.update',$item->id)}}">@csrf @method('put')
                                  <input class="form-check-input" type="checkbox" value="Approved"  name="approved" checked>
                                  <label class="form-check-label" for="flexCheckDefault">
                                    Approved
                                  </label>
                                  <input type="text" name="id" value="{{$item->id}}" hidden>
                                  <input class="form-check-input" type="checkbox" value="Disapproved"  name="disaprove" >
                                  <label class="form-check-label" for="flexCheckDefault">
                                    Disapproved
                                  </label>
                                  <button type="submit" class="btn btn-sm btn-primary">Done</button>
                                  </form></td>
                              </tr>
                              <tbody>
                               @endforeach
                              </table>
                            
                          </div>
                        </div>
                          
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
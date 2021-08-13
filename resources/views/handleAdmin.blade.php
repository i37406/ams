@extends('layouts.app')
@section('navbar')
<li class="nav-item">
  <a class="nav-link actine"  href="{{route('admin.route')}}">Home</a>
</li>
<li class="nav-item">
  <a class="nav-link active"  href="{{route('admin.leave')}}">Leave Applications</a>
</li>
@endsection
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
              <div class="card-header" style="background-color: rgb(176, 203, 245);"><h5>Image Update</h5></div>

              <div class="card-body" style="background-color: rgb(199, 202, 207); ">
                 
                  <div class="container-sm m-4">
                      <div class="row justify-content-center">
                          <div class="col align-self-center">
                            <form method="POST" action="{{route('updateUserImage')}}" enctype="multipart/form-data">
                              @csrf
                              <div class="col-sm-12">
                                  <div class="col-md-6">
                                      <label for="image" class="form-label">Update Image</label>
                                      <input type="file" class="form-control" id="image" name="image" required>
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
     
  </div>
</div>
@endsection
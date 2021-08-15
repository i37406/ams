@extends('admin.adminlayout')
@section('p_head','Personal Information')

@section('p_content')
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
 
@endsection
@section('admin_avatar')
<div class="col align-self-end">
    <img src="{{asset('/storage/images/'.Auth::user()->avatar) }}" alt="avatar" width="120" style="border-radius: 50%;display: block; margin: auto;">
  </div>
@endsection

@section('second_container')
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


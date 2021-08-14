@extends('admin.adminlayout')
@section('p_head','Manage Attendance')
@section('p_content')



    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(197, 215, 238); "><h5>Mark Today Attendance</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">                   
                    <div class="container-sm m-4">
                        <div class="row">
                          <div class="col align-self-start">
                            <form method="POST" action="{{route('attendance.store')}}">
                                @csrf
                                <div class="col-sm-6">
                                    <select class="form-select" aria-label="" name="s_id" required>
                                        {{-- <option selected>Select Student</option> --}}
                                        @foreach ($data as $item)
                                        <?php
                                        if($item->is_admin)
                                        continue;
                                        ?>
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                      </select>
                                </div>
                                <div class="col-sm-6 my-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="P" id="attend" name="attend" >
                                    <label class="form-check-label" for="flexCheckDefault">
                                      Present
                                    </label>
                                </div>    
                                </div>
                               
                                  <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary m-3">Done</button>
                                  </div>
                            </form>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center my-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(197, 215, 238); "><h5>Update Attendance</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">                   
                    <div class="container-sm m-4">
                        <div class="row">
                          <div class="col align-self-start">
                            <form method="POST" action="{{route('admin.populate')}}">
                                @csrf
                                <div class="col-sm-6">
                                    <select class="form-select" aria-label="" name="s_id" required>
                                        {{-- <option selected>Select Student</option> --}}
                                        @foreach ($data as $item)
                                        <?php
                                        if($item->is_admin)
                                        continue;
                                        ?>
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                      </select>
                                      <button type="submit" class="btn btn-primary my-3">Search</button>
                                </div>
                               
                               
                                  <div class="col-sm-12">
                                   
                                  </div>
                            </form>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@extends('layouts.app')
@section('navbar')
<li class="nav-item">
    <a class="nav-link "  href="{{ route('home') }}">Home</a>
  </li>
<li class="nav-item">
    <a class="nav-link active"  href="{{route('s.seeAttendance')}}">Attendance</a>
  </li>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(176, 203, 245);  text-align: center;  font-family: Times New Roman;"><h2>Student Dashboard</h2></div>
                <x-alert /> 
                <div class="card-header" style="background-color: rgb(217, 224, 233); "><h5>Attendance Summary</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Total Present</th>
                            <th>Total Absent</th>
                            <th>Total Applied Leaves</th>
                            <th>Approved Leaves</th>
                            <th>Disapproved Leaves</th>
                            <th>Total Attendance</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $index)
                            
                  
                          <tr>
                            <td>{{$index->present}}</td>
                            <td>{{$index->absent}}</td>
                            <td>{{$index->leav}}</td>
                            <td>{{$index->a_leav}}</td>
                            <td>{{$index->d_leav}}</td>
                            <td>{{$index->TotalAttendance}}</td>
                          </tr>
                          @empty
                              <tr>
                                  <td colspan="9"><h5>No Record found</h5></td>
                              </tr>
                          @endforelse
                        </tbody>
                      </table>
                <a href="{{route('home')}}" class="btn btn-primary"> Back</a>
                </div>
            </div>
        </div>
       
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(176, 203, 245);"><h5>Leave Summary</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">
                     
                    <div class="container-sm m-4">
                        <div class="row justify-content-center">
                            <div class="col align-self-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <?php $sr=0; ?>
                                      <tr>
                                        <th>Sr</th>
                                        <th>Leave Reason</th>
                                        <th>Leave Status</th>
                                        <th>Date</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse($leave as $index)
                                        
                              
                                      <tr>
                                        <td>{{++$sr}}</td>
                                        <td>{{$index->leave_reason}}</td>
                                        @if (($index->leave_approved_status == 0) && ($index->leave_disapprove_status == 0) )
                                            <td>Not Processed Yet</td>
                                        @elseif ($index->leave_approved_status == 1 )
                                                <td>Approved</td>
                                        @else
                                                <td>Disapproved</td>
                                        @endif
                                        <td>{{substr($index->attendance_date,0,11)}}</td>
                            
                                      </tr>
                                     
                                      @empty
                                          <tr>
                                              <td colspan="9"><h5>No Record found</h5></td>
                                          </tr>
                                      @endforelse
                                      <tr>
                                          <td colspan="4"> {{ $leave->links() }}</td>
                                      </tr>
                                     
                                    </tbody>
                                  </table>
                                <a href="{{route('home')}}" class="btn btn-primary"> Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 my-3">
            <div class="card">
                <div class="card-header" style="background-color: rgb(176, 203, 245);"><h5>Detailed Attendance Summary</h5></div>

                <div class="card-body" style="background-color: rgb(199, 202, 207); ">
                   
                    <div class="container-sm m-4">
                        <div class="row justify-content-center">
                            <div class="col align-self-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <?php $sr=0; ?>
                                      <tr>
                                        <th>Sr</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse($d_atten as $index)
                                        
                              
                                      <tr>
                                        <td>{{++$sr}}</td>
                                        <td>{{$index->attendance}}</td>
                                        <td>{{substr($index->attendance_date,0,11)}}</td>
                            
                                      </tr>
                                     
                                      @empty
                                          <tr>
                                              <td colspan="9"><h5>No Record found</h5></td>
                                          </tr>
                                      @endforelse
                                      <tr>
                                          <td colspan="4"> {{ $d_atten->links() }}</td>
                                      </tr>
                                     
                                    </tbody>
                                  </table>
                                <a href="{{route('home')}}" class="btn btn-primary"> Back</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>


@endsection


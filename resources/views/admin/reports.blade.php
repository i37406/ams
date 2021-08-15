@extends('admin.adminlayout')
@section('p_head','Manage Reports')
@section('p_content')



<div class="row justify-content-center ">
  <div class="col-md-12">
      <div class="card">
          <div class="card-header" style="background-color: rgb(197, 215, 238); "><h5>All Students</h5></div>

          <div class="card-body" style="background-color: rgb(199, 202, 207); ">                   
              <div class="container-sm m-4">
                  <div class="row">
                    <div class="col align-self-start">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Sr.</th>
                            <th>Student Name</th>
                            <th>Total Days</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Leave</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sr=0;
                            ?>
                            @forelse($users as $index)
                            
                      
                          <tr>
                            <td>{{++$sr}}</td>
                            <td>{{$index->name}}</td>
                            <td>{{$index->TotalAttendance}}</td>
                            <td>{{$index->present}}</td>
                            <td>{{$index->absent}}</td>
                            <td>{{$index->leav}}</td>
                            <td>
                              <form method="POST" action="{{route('admin.populate')}}" >
                                @csrf
                                <input type="text" name="s_id" value="{{$index->id}}" hidden >
                                <input type="text" name="s_name" value="{{$index->name}}" hidden >
                               <button type="submit" class="btn btn-sm btn-primary"  >View</button>
                              </form>
                              
                          </td>
                          </tr>
                          @empty
                              <tr>
                                  <td colspan="9"><h5>No Record found</h5></td>
                              </tr>
                          @endforelse
                        </tbody>
                      </table>
                      <div class="mb-3 border border-secondary border-2 rounded my-3 p-3">
                      <h4 class="card-header" style="background-color: rgb(197, 215, 238); ">Generate Reports</h4>
                      <form method="POST" action="{{route('admin.allUserReportRange')}}" >
                        @csrf
                  
                          <div class="col-md-4">
                            <label for="From" class="form-label">From</label>
                            <input type="text" class="form-control datetimepicker" name="sdate" >
                          </div>
                          <div class="col-md-4">
                            <label for="To" class="form-label">To</label>
                            <input type="text" class="form-control datetimepicker" name="edate" >
                          </div>
                          <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary my-3">Generate</button>
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


<div class="row justify-content-center my-4">
  <div class="col-md-12">
      <div class="card">
          <div class="card-header" style="background-color: rgb(197, 215, 238); "><h5>Student Report</h5></div>

          <div class="card-body" style="background-color: rgb(199, 202, 207); ">                   
              <div class="container-sm m-4">
                  <div class="row">
                    <div class="col align-self-start">
                      <form method="POST" action="{{route('admin.populate')}}" >
                        @csrf
                        <div class="col-sm-4">
                          <select class="form-select" aria-label="" name="s_id" required>
                              {{-- <option selected>Select Student</option> --}}
                              @foreach ($users as $index)
                              <option value="{{$index->id}}">{{$index->name}}</option>
                              @endforeach
                            </select>
                      </div>
                          <div class="col-sm-4 my-2">
                            <label for="From" class="form-label">From</label>
                            <input type="text" class="form-control datetimepicker" name="sdate" >
                          </div>
                          <div class="col-sm-4">
                            <label for="To" class="form-label">To</label>
                            <input type="text" class="form-control datetimepicker" name="edate" >
                          </div>
                          <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary my-3">Generate</button>
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

@section('js')
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
          format: 'YYYY-MM-DD',
          daysOfWeekDisabled: [0,6]
        });

    });
    $(function () {
        $('.datetimepicker1').datetimepicker({
          format: 'YYYY-MM-DD',
          daysOfWeekDisabled: [0,6],
          maxDate:new Date()
        });

    });
</script>
@endsection



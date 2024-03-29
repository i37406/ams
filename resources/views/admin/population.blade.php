@extends('admin.adminlayout')
@section('p_head','Student Name : '.$user->name)
@section('p_content')
<div class="">          
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Date</th>
          <th>Attendance Status</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
          @forelse($data as $index)
          <?php
          if($index->attendance == 'P'){$index->attendance='Present';}else
          if($index->attendance == 'A'){$index->attendance='Absent';}else
          if($index->attendance == 'L'){$index->attendance='Leave';}else
          if($index->attendance == ''){$index->attendance='Not Marked Yet';}
          ?>

        <tr>
          <td>{{substr($index->attendance_date,0,11)}}</td>
          <td>{{$index->attendance}}</td>
          <td>
            <a class="btn btn-sm btn-primary" href="{{route('attendance.edit',$index->id)}}" >Update</a>
          </td>
          <td>
            <form  method="POST" action="{{route('attendance.destroy',$index->id)}}">
              @csrf
              @method('delete')
              <button class="btn btn-sm btn-primary  align-left ">Delete</button>
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
    </div>
@endsection

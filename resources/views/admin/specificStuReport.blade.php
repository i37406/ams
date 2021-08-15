@extends('admin.adminlayout')
@section('p_head','Student Name : '.$user->name.' attendance report '.$str)
@section('p_content')
<div class="">          
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Date</th>
          <th>Attendance Status</th>

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
          {{-- <td>{{Carbon::createFromFormat('Y-m-d H:i:s', $index->attendance_date)->format('d-m-Y')}}</td> --}}
          <td>{{$index->attendance}}</td>
          
        </tr>
        @empty
            <tr>
                <td colspan="9"><h5>No Record found</h5></td>
            </tr>
        @endforelse
      </tbody>
    </table>
    <a href="{{route('admin.reports')}}" class="btn btn-primary my-3">Back</a>
    </div>
@endsection

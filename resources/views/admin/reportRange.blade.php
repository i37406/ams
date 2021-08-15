@extends('admin.adminlayout')
@section('p_head','Generalized Report'.$str)
@section('p_content')
<div class="">          
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Student Name</th>
          @foreach ($data as $index)
            @foreach ($index as $item)
            <th>{{substr($item->attendance_date,0,11)}}</th>
            @endforeach
        @endforeach
        </tr>
      </thead>
      <tbody>
          @foreach ($data as $index)
                <?php $str= "" ?>
            @foreach ($index as $item)
                @if($loop->first)
                    <?php $str = $item->name; ?>
                    <tr>
                    <td>{{$item->name}}<td>
                 @elseif ($str!= $item->name)
                    <?php $str = $item->name; ?>
                    </tr>
                    <tr>
                    <td>{{$item->name}}<td>
            
                @endif
                <td>{{$item->attendance}}</td>
            @endforeach
          @endforeach
          {{-- @forelse($data as $index)
          <?php
          if($data->attendance == 'P'){$data->attendance='Present';}else
          if($data->attendance == 'A'){$data->attendance='Absent';}else
          if($data->attendance == 'L'){$data->attendance='Leave';}else
          if($data->attendance == ''){$data->attendance='Not Marked Yet';}
          ?>

        <tr>
          <td>{{substr($index->attendance_date,0,11)}}</td>
          <td>{{$index->attendance}}</td>
          <td>
            <a class="btn btn-sm btn-primary" href="{{route('attendance.edit',$index->id)}}" >Update</a>
            
        </td>
        </tr>
        @empty
            <tr>
                <td colspan="9"><h5>No Record found</h5></td>
            </tr>
        @endforelse --}}
      </tbody>
    </table>
    <a href="{{route('admin.reports')}}" class="btn btn-primary my-3">Back</a>
    </div>
@endsection

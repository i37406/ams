@extends('admin.adminlayout')
@section('p_content')
@foreach ($data as $item)
<form method="POST" action="{{route('attendance.update',$item->id)}}">
    @csrf
    @method('PUT')
    
    <div class="col-sm-6">
        <select class="form-select" aria-label="" name="attend" required>
            
            <option value="P">Present</option>
            <option value="A">Absent</option>
           
          </select>
          <input type="text" class="form-control" id="" name="date" value="{{$item->attendance_date}}" hidden >
          <input type="text" class="form-control" id="" name="a_id" value="{{$item->id}}" hidden >
               
    </div>
   
   
   
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary my-3">Update</button>
      </div>
</form>
@endforeach
@endsection

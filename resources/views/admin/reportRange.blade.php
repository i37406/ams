@extends('admin.adminlayout')
@section('p_head','Generalized Report'.$str)
@section('p_content')
<div class="">          
    <table class="table table-bordered">
      
      <tbody>
          @foreach ($data as $index)
          <tr>
            @foreach ($index as $item)
               
                    
                    <td>{{$item->name}}<br>{{substr($item->attendance_date,0,11)}}[{{$item->attendance}}]<td>
                    
                
                
            @endforeach
          </tr>
          @endforeach


          
         
      </tbody>
    </table>
    <a href="{{route('admin.reports')}}" class="btn btn-primary my-3">Back</a>
    </div>
@endsection

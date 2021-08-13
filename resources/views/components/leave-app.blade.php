<table class="table table-striped">
    <thead>
      <tr>
      <td>Student Name</td>
      <td>Reason</td>
      <td>Date</td>
      <td>Action</td>
      </tr>
    </thead>
    @forelse ($users as $item)
    <tbody>
    <tr >
      <td>{{$item->name}}</td>
      <td>{{$item->leave_reason}}</td>
      <td>{{$item->attendance_date}}</td>
      <td><form method="post" action="{{route('attendance.update',$item->id)}}">@csrf @method('put')
        <input class="form-check-input" type="checkbox" value="Approved"  name="approved" >
        <label class="form-check-label" for="flexCheckDefault">
          Approved
        </label>
        <input type="text" name="id" value="{{$item->id}}" hidden>
        <input class="form-check-input" type="checkbox" value="Disapproved"  name="disaprove" >
        <label class="form-check-label" for="flexCheckDefault">
          Disapproved
        </label>
        <button type="submit" class="btn btn-sm btn-primary">Done</button>
        </form></td>
    </tr>
    <tbody>
      @empty
      <tr>
        <td colspan="4"><h4 class="text-center">No Leave Applications Yet</h4></td>
      </tr>
      
     @endforelse
    </table>
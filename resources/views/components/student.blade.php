<div class="table-responsive">          
    <table class="table">
      <thead>
        <tr>
          <th>Sr</th>
          <th>Student Name</th>
          <th>Status</th>
          <th>Grade</th>
          <th>Email</th>
          <th>Address</th>
          <th>Cell</th>
          <th>DOB</th>
          <th>Joining Date</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          <?php 
          $i = 0;
          ?>
          @forelse($data as $index)
          <?php 
          if($index->is_admin)
          continue;
          ?>

        <tr>
          <td>{{++$i;}}</td>
          <td>{{$index->name}}</td>
          @if ($index->is_login == 1)
            <td class="table-success">Online</td>
            @else
            <td>Offline</td>
          @endif
          <td>{{$index->grade}}</td>
          <td>{{$index->email}}</td>
          <td>{{$index->address}}</td>
          <td>{{$index->cell}}</td>
          <td>{{substr($index->dob,0,11)}}</td>
          <td>{{substr($index->created_at,0,11)}}<br>{{$index->created_at->diffForHumans()}}</td>
          <td> <img src="{{asset('/storage/images/'.$index->avatar) }}" alt="avatar" width="40"></td>
          <td>
            <form action="{{route('admin.grade')}}" method="POST">
              @csrf
              <input type="text" name="s_id" value="{{$index->id}}" hidden>
              <input type="text" name="s_name" value="{{$index->name}}" hidden>
              <button class="btn btn-sm btn-primary">Grade</button>
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
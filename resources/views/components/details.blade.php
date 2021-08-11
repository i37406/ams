<div class="container-sm m-4">
  <div class="row">
    <div class="col align-self-start">
      <table class="table">
        <tr class="table-active">
          <td>User Name</td>
          <td>{{$data->name}}</td>
        </tr>
        <tr class="table-active">
          <td>User Email</td>
          <td> {{$data->email}}</td>
        </tr>
        <tr class="table-active">
          <td>Role</td>
          <td>{{$data->is_admin}}</td>
        </tr>
        <tr class="table-active">
          <td>Joined</td>
          <td>{{$data->created_at->diffForHumans()}}</td>
        </tr>
        <tr class="table-active">
          <td>Last Profile Updated</td>
          <td>{{$data->updated_at->diffForHumans()}}</td>
        </tr>
      </table>

      
    </div>
    <div class="col align-self-end">
      <img src="{{asset('/storage/images/'.Auth::user()->avatar) }}" alt="avatar" width="120" style="border-radius: 50%;display: block; margin: auto;">
    </div>
  </div>
    <div class="row align-items-center">
        <div class="col align-self-center">
            <form class="row g-3" action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
              @csrf
              
                             
                
                <div class="col-md-6">
                  <label for="status" class="form-label">Date of Birth</label>
                  <input type="text" class="form-control" id="dob" name="dob" value="" placeholder="yyyy-mm-dd">
                </div>
                <div class="col-md-6">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
                </div>
               
                
                <div class="col-md-6">
                  <label for="cellNo" class="form-label">Contact No</label>
                  <input type="text" class="form-control" id="cellNo" name="cellNo">
                </div>
                <div class="col-md-6">
                  <label for="image" class="form-label">Image</label>
                  <input type="file" class="form-control" id="image" name="image">
                </div>
                 <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
          </div>
    </div>
</div>
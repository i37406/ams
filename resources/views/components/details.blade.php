<div class="container-sm m-4">
    <div class="row align-items-center">
        <div class="col align-self-center">
            <form class="row g-3" action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="col-md-6">
                <label for="userName" class="form-label">User Name</label>
                <input type="text" class="form-control" id="userName" placeholder="" value="{{$data->name}}" disabled>
              </div>
                <div class="col-md-6">
                  <label for="uEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" id="uEmail" name="uEmail" value="{{$data->email}}" disabled>
                </div>
                <div class="col-md-6">
                  <label for="status" class="form-label">Joined As</label>
                  <input type="text" class="form-control" id="status" name="status" value="{{$data->is_admin}}" disabled>
                </div>
                <div class="col-md-6">
                  <label for="status" class="form-label">Date of Birth</label>
                  <input type="text" class="form-control" id="dob" name="dob" value="" placeholder="yyyy-mm-dd">
                </div>
                <div class="col-12">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
                </div>
               
                
                <div class="col-md-6">
                  <label for="cellNo" class="form-label">Contact No</label>
                  <input type="text" class="form-control" id="cellNo" name="cellNo">
                </div>
                <div class="col-md-6">
                  <label for="image" class="form-label">Contact No</label>
                  <input type="file" class="form-control" id="image" name="image">
                </div>
                 <div class="col-12">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
          </div>
    </div>
</div>
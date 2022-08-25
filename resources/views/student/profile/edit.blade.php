@extends( 'layouts.backend.app' )

@section( 'title','Department' )
@push('css')

@endpush

@section( 'content' )

    <section class="card">
        <div class="col-md-12 col-lg-6 mt-3">
            <div class="card-body box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Update Profile</h3>
                </div>
                <!-- /.box-header -->
                <div>
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <!-- form start -->
                <form role="form" action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')
                  <div class="box-body">
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label for="name">Student Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Student Name" value="{{ $user->name }}">
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label for="email">Student Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Student Email" value="{{ $user->email }}">
                            </div>
                        </div>
                      
                    </div>
                    <div class="d-grid mb-3">
                      <label for="student_id">Student Id</label>
                    <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student Id" value="{{ $user->student_id }}">
                    </div>
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label for="department">Student Department</label>
                      <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department name" value="{{ $user->department }}">
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label for="shift">Shift</label>
                      <input type="text" class="form-control" id="shift" name="shift" placeholder="ex: Day or Evening" value="{{ $user->shift }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label for="old_password" class="col-form-label">Old Password:</label>
                                <input class="form-control" type="password" id="old_password" name="old_password" placeholder="password">
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <label for="password" class="col-form-label">New Password:</label>
                                <input id="password" type="password" class="form-control"
                               name="password" autocomplete="current-password" placeholder="Password">
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="d-grid mb-3">
                        <label for="avatar">Upload avatar</label>
                        <input type="file" class="form-control form-control-sm" id="avatar" name="avatar">
      
                        <p class="help-block">Upload your avatar here.</p>
                      </div>

                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-outline-primary btn-flat">Update</button>
                  </div>
                </form>
            </div>
        </div>

    </section>

@endsection

@push('js')

@endpush
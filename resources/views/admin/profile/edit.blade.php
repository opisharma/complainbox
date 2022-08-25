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
                <!-- form start -->
            <form role="form" action="{{ route('admin.update',$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
              <div class="box-body">
                <div class="d-grid mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <label for="name" class="col-form-label">Admin Name:</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Admin name" value="{{ $user->name }}">
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label for="email" class="col-form-label">Admin Email:</label>
                    <input class="form-control" type="text" id="email" name="email" placeholder="Admin email" value="{{ $user->email }}">
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
                            <label for="password" class="col-form-label">Password:</label>
                            <input id="password" type="password" class="form-control"
                           name="password" autocomplete="current-password" placeholder="Password">
                        </div>
                    </div>
                    
                </div>
                <div class="d-grid mb-3">
                    <label for="avatar">Upload avatar</label>
                    <input type="file" class="form-control form-control-sm" id="avatar" name="avatar">
  
                    <p class="help-block">Upload your avatar.</p>
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
@extends( 'layouts.backend.app' )

@section( 'title','Users' )
@push('css')

@endpush

@section( 'content' )

    <section class="content">
        <div class="col-md-12 col-lg-6 mt-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">New Department</h3>
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
                <form role="form" action="{{ route('admin.users.update',$user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                  <div class="box-body">
                    <div class="form-group">
                        <label for="role_id" class="col-form-label">Role:</label>
                        <select name="role_id" id="role_id" class="form-control">
                                <option value="">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Author</option>
                                <option value="3">Subscriber</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <label for="name">Name:</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                        </div>
                      
                    </div>
                    
                    <div class="student_id_input" style="display: none">
                        <div class="form-group">
                        <label for="student_id">Student Id</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student Id">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <label for="department">Student Department</label>
                        <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department name">
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <label for="shift">Shift</label>
                        <input type="text" class="form-control" id="shift" name="shift" placeholder="ex: Day or Evening">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="author_id_input" style="display: none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <label for="category_id" class="col-form-label">Category:</label>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id}}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <label for="sub_category_designation" class="col-form-label">Employee designation:</label>
                            <input class="form-control" type="text" id="sub_category_designation" name="sub_category_designation" placeholder="Employee designation">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="password">Account Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                    </div>
                    
                    <div class="form-group">
                        <label for="avatar">Upload avatar</label>
                        <input type="file" id="avatar" name="avatar">
      
                        <p class="help-block">Upload your avatar here.</p>
                    </div>
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success btn-flat">Submit</button>
                    <a href="{{ route('admin.users.index') }}"><button type="submit" class="btn btn-primary btn-flat">Back</button></a>
                  </div>
                </form>
            </div>
        </div>

    </section>

@endsection

@push('js')
<script src="{{ asset('backend/assets/dist/js/user.js') }}"></script>
@endpush
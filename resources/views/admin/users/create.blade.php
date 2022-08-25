@extends( 'layouts.backend.app' )

@section( 'title','Users' )
@push('css')

@endpush

@section( 'content' )

<div class="row">
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">Add User</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <div>
                    @if($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <form role="form" action="{{ route('admin.u.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="role_id" class="col-form-label">Role:</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="">Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Employee</option>
                                    <option value="3">Student</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-gird mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                        </div>
                    </div>
                    <div class="student_id_input" style="display: none">
                        <div class="d-grid mb-3">
                        <label for="student_id">Student Id</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student Id">
                        </div>
                        <div class="d-grid mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="department">Student Department</label>
                        <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department name">
                                </div>
                                <div class="col">
                                    <label for="shift">Shift</label>
                        <input type="text" class="form-control" id="shift" name="shift" placeholder="ex: Day or Evening">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="author_id_input" style="display: none">
                        <div class="d-grid mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="category_id" class="col-form-label">Category:</label>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id}}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                                </div>
                                <div class="col">
                                    <label for="sub_category_designation" class="col-form-label">Employee designation:</label>
                            <input class="form-control" type="text" id="sub_category_designation" name="sub_category_designation" placeholder="Employee designation">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <label for="password" class="form-label">Account Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                    </div>

                    <div class="d-grid mb-3">
                        <input class="form-control form-control-sm" id="avatar" name="avatar" type="file">
                        <p class="help-block">Upload your avatar.</p>
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('backend/assets/dist/js/user.js') }}"></script>
@endpush
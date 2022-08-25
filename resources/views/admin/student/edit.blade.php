@extends( 'layouts.backend.app' )

@section( 'title','Users' )
@push('css')

@endpush

@section( 'content' )

<div class="row">
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">Update Student Data</h6>
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
                <form role="form" action="{{ route('admin.users.update',$user->id) }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label">Student Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Student Name" value="{{ $user->name }}">
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">Student Email</label>
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
                            <div class="col">
                                <label for="department" class="form-label">Student Department</label>
                      <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department name" value="{{ $user->department }}">
                            </div>
                            <div class="col">
                                <label for="shift" class="form-label">Shift</label>
                      <input type="text" class="form-control" id="shift" name="shift" placeholder="ex: Day or Evening" value="{{ $user->shift }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="old_password" class="form-label">Old Password:</label>
                                <input class="form-control" type="password" id="old_password" name="old_password" placeholder="password">
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <label for="password" class="form-label">New Password:</label>
                                <input id="password" type="password" class="form-control"
                               name="password" autocomplete="current-password" placeholder="Password">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <input class="form-control form-control-sm" id="avatar" name="avatar" type="file">
                        <p class="help-block">Upload your avatar.</p>
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                    <a href="{{ route('admin.users.index') }}"><button type="submit" class="btn btn-sm btn-primary">Back</button></a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
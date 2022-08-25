@extends( 'layouts.backend.app' )

@section( 'title','Users' )
@push('css')

@endpush

@section( 'content' )
<div class="row">
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">Add Student</h6>
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
                <form role="form" action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label">Student Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Student Name">
                            </div>
                            <div class="col">
                                <label for="email" class="form-label">Student Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Student Email">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <label for="student_id">Student Id</label>
                        <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student Id">
                    </div>
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="department" class="form-label">Student Department</label>
                      <input type="text" class="form-control" id="department" name="department" placeholder="Enter Department name">
                            </div>
                            <div class="col">
                                <label for="shift" class="form-label">Shift</label>
                      <input type="text" class="form-control" id="shift" name="shift" placeholder="ex: Day or Evening">
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
                    <a href="{{ route('admin.users.index') }}"><button type="submit" class="btn btn-sm btn-primary">Back</button></a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush
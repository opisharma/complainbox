@extends( 'layouts.backend.app' )

@section( 'title','Employee' )
@push('css')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section( 'content' )
<div class="row">
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">Add Employee</h6>
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
                <form role="form" action="{{ route('admin.sub_category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-grid mb-3">
                        <label for="category_id" class="col-form-label">Category:</label>
                        <select name="category_id" class="single-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id}}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid">
                        <label for="sub_category_name" class="form-label">Employee Name</label>
                        <input type="text" class="form-control mb-3" id="sub_category_name" name="sub_category_name"
                            placeholder="Enter Employee Name">
                    </div>
                    <div class="d-grid">
                        <label for="sub_category_designation" class="form-label">Employee designation</label>
                        <input class="form-control" type="text" id="sub_category_designation" name="sub_category_designation" placeholder="Employee designation">
                    </div>
                    <div class="d-grid">
                        <label for="sub_category_email" class="col-form-label">Email Address</label>
                        <input class="form-control" type="email" name="sub_category_email" id="sub_category_email" placeholder="Email Address">
                    </div>

                    <div class="d-grid mb-3">
                        <label for="password" class="col-form-label">Password:</label>
                            <input id="password" type="password" class="form-control"
                           name="password" autocomplete="current-password" placeholder="Password">
                    </div>

                    <div class="d-grid mb-3">
                        <input class="form-control form-control-sm" id="employee_avatar" name="employee_avatar" type="file">
                        {{-- <input type="file" id="employee_avatar" name="employee_avatar"> --}}
                        <p class="help-block">Upload your avatar.</p>
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                    <a href="{{ route('admin.sub_category.index') }}"><button type="submit" class="btn btn-sm btn-primary">Back</button></a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/form-select2.js') }}"></script>
@endpush
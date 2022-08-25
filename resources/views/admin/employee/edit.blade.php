@extends( 'layouts.backend.app' )

@section( 'title','Employee' )
@push('css')

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
                <form role="form" action="{{ route('admin.sub_category.update',$subCategory->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-grid mb-3">
                        <label for="category_id" class="col-form-label">Category:</label>
                        <select name="category_id" class="single-select">
                            @foreach ($categories as $category)
                            <option 
                            @if($category->id == $subCategory->category_id)
                            selected
                            @endif
                            value="{{ $category->id}}">{{ $category->category_name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="d-grid">
                        <label for="sub_category_name" class="form-label">Employee Name</label>
                        <input type="text" class="form-control mb-3" id="sub_category_name" name="sub_category_name"  value="{{ $subCategory->sub_category_name }}" placeholder="Enter Employee Name">
                    </div>
                    <div class="d-grid">
                        <label for="sub_category_designation" class="form-label">Employee designation</label>
                        <input class="form-control" type="text" id="sub_category_designation" name="sub_category_designation" value="{{ $subCategory->sub_category_designation }}" placeholder="Employee designation">
                    </div>
                    <div class="d-grid">
                        <label for="sub_category_email" class="col-form-label">Email Address</label>
                        <input class="form-control" type="email" name="sub_category_email" id="sub_category_email" value="{{ $subCategory->sub_category_email }}"  placeholder="Email Address">
                    </div>

                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col">
                                <label for="old_password" class="form-label">Old Password:</label>
                                <input id="old_password" type="password" class="form-control"
                               name="old_password" autocomplete="current-password" placeholder="Old Password">
                            </div>
                            <div class="col">
                                <label for="password" class="form-label">Password:</label>
                                <input id="password" type="password" class="form-control"
                               name="password" autocomplete="current-password" placeholder="Password">
                            </div>
                        </div>
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

@endpush
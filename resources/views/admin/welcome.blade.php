@extends( 'layouts.backend.app' )

@section( 'title','Dashboard' )

@section( 'content' )
<div class="image-wrapping">
<section class="content-header">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.category.index') }}" class="card-color card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Department</p>
                            <h4 class="my-1 text-white">{{ App\Category::count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="bx bx-book-add"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.sub_category.index') }}" class="card radius-10 card-color">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Emlpoyee</p>
                            <h4 class="my-1 text-white">{{ App\SubCategory::count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="bx bx-group"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.users.index') }}" class="card radius-10 card-color">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Students</p>
                            <h4 class="my-1 text-white">{{ App\User::where([['role_id', '=', 3],])->count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="bx bx-group"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.u.index') }}" class="card radius-10 card-color">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Users</p>
                            <h4 class="my-1 text-white">{{ App\User::count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="bx bx-group"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.emails') }}" class="card radius-10 card-color">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Complains</p>
                            <h4 class="my-1 text-white">{{ App\Mail::count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="lni lni-envelope"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.emails') }}" class="card radius-10 card-color">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Approved</p>
                            {{-- <h4 class="my-1 text-white">{{ App\Mail::count() }}</h4> --}}
                            <h4 class="my-1 text-white">{{ App\Mail::where([['status', '=', 1],])->count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="lni lni-envelope"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.emails') }}" class="card radius-10 card-color">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Declined</p>
                            {{-- <h4 class="my-1 text-white">{{ App\Mail::count() }}</h4> --}}
                            <h4 class="my-1 text-white">{{ App\Mail::where([['status', '=', 2],])->count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="lni lni-envelope"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('admin.emails') }}" class="card radius-10 card-color">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Pending</p>
                            {{-- <h4 class="my-1 text-white">{{ App\Mail::count() }}</h4> --}}
                            <h4 class="my-1 text-white">{{ App\Mail::where([['status', '=', null],])->count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="lni lni-envelope"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</section>
</div>
@endsection

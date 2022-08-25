@extends( 'layouts.backend.app' )

@section( 'title','Dashboard' )

@section( 'content' )
<section class="content-header">
    {{-- <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol> --}}
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
            <a href="{{ route('user.emails') }}" class="card radius-10 card-color">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Complains</p>
                            <h4 class="my-1 text-white">{{ App\Mail::where('user_id','=',Auth::user()->id)->count() }}
                            </h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="bx bx-envelope-open"></i>
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
                            <h4 class="my-1 text-white">{{ App\Mail::where([['status', '=', 1],['user_id','=',Auth::user()->id]])->count() }}</h4>
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
                            <h4 class="my-1 text-white">{{ App\Mail::where([['status', '=', 2],['user_id','=',Auth::user()->id]])->count() }}</h4>
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
                            <h4 class="my-1 text-white">{{ App\Mail::where([['status', '=', null],['user_id','=',Auth::user()->id]])->count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="lni lni-envelope"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>
</section>
@endsection

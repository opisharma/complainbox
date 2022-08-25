@extends( 'layouts.backend.app' )

@section( 'title','Dashboard' )

@section( 'content' )
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
            <a href="{{ route('author.emails') }}" class="card radius-10 card-color">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary text-white">Total Complains</p>
                            <h4 class="my-1 text-white">
                                {{ App\SubCategory::findOrfail(Auth::user()->subcategory_id)->mails->count() }}</h4>
                        </div>
                        <div class="text-primary ms-auto font-35 text-white"><i class="bx bx-envelope-open"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        

    </div>
</section>
@endsection

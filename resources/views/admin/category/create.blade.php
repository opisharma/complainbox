@extends( 'layouts.backend.app' )

@section( 'title','Department' )
@push('css')

@endpush

@section( 'content' )
<div class="row">
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">Add Department</h6>
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
                <form role="form" action="{{ route('admin.category.store') }}" method="post">
                  @csrf
                  
                  <label for="category_name" class="form-label">Department Name</label>
                  <input type="text" class="form-control mb-3" id="category_name" name="category_name"
                      placeholder="Enter Department Name">

                      <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button>
                    <a href="{{ route('admin.category.index') }}"><button type="submit"
                            class="btn btn-sm btn-primary">Back</button></a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush

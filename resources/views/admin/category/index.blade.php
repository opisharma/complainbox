@extends( 'layouts.backend.app' )

@section( 'title','Department' )
@push('css')

   @endpush

@section( 'content' )
<div class="card">
    <a href="{{ route('admin.category.create') }}"><button class="btn btn-outline-primary m-2"> <i class="bx bx-plus"></i> New Department</button></a>
    <div class="card-body">
        <div class="table-responsive">
            <table id="categoryDataTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $categories as $key => $category )
                    <tr>
                        <td>{{ $key + 1}}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <button onclick="deleteCategory({{ $category->id }})" class="btn btn-sm btn-danger flat-btn "><i class="bx bx-trash-alt"></i></button>
                                <form action="{{ route('admin.category.destroy',$category->id) }}" method="post"
                                        style="display: none" id="delete-form-{{ $category->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            <a href="{{ route('admin.category.edit',$category->id) }}"><span class="btn btn-sm btn-warning flat-btn"><i class="bx bx-edit"></i></span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Department Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $("#categoryDataTable").DataTable({
                    'paging'      : true,
                    'lengthChange': true,
                    'searching'   : true,
                    'ordering'    : true,
                    'info'        : true,
                    'autoWidth'   : true
                });
            });
        })(jQuery);

        function deleteCategory(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'This user data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
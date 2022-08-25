@extends( 'layouts.backend.app' )

@section( 'title','Employee' )
@push('css')
@endpush

@section( 'content' )
<div class="card">
    <a href="{{ route('admin.sub_category.create') }}"><button class="btn btn-outline-primary m-2"> <i class="bx bx-plus"></i> New Employee</button></a>
    <div class="card-body">
        <div class="table-responsive">
            <table id="categoryDataTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Department Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $subCategorys as $key => $subCategory )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $subCategory->sub_category_name }}</td>
                        <td>{{ $subCategory->sub_category_designation }}</td>
                        <td>{{ $subCategory->category->category_name }}</td>
                        <td>{{ $subCategory->sub_category_email }}</td>
                        <td>
                            <button onclick="deleteSubCategory({{ $subCategory->id }})" class="btn btn-danger btn-sm "><i class="bx bx-trash-alt"></i></button>
                                <form action="{{ route('admin.sub_category.destroy',$subCategory->id) }}" method="post"
                                      style="display: none" id="delete-form-{{ $subCategory->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            <a href="{{ route('admin.sub_category.edit',$subCategory->id) }}"><span class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></span></a>
                            <a href=" {{ route('admin.sub_category.show',$subCategory->id) }} "><button class="btn btn-sm btn-info flat-btn text-white"><i class="lni lni-eye"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Department Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $("#categoryDataTable").DataTable({
                    'paging'      : true,
                    'lengthChange': false,
                    'searching'   : true,
                    'ordering'    : true,
                    'info'        : true,
                    'autoWidth'   : true
                });
            });
        })(jQuery);

        function deleteSubCategory(id) {
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
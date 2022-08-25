@extends( 'layouts.backend.app' )

@section( 'title','Users' )
@push('css')
@endpush

@section( 'content' )
<div class="card">
    <a href="{{ route('admin.users.create') }}"><button class="btn btn-outline-primary m-2"> <i class="bx bx-plus"></i> New Student</button></a>
    <div class="card-body">
        <div class="table-responsive">
            <table id="userDataTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Shift</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $users as $key => $user )
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->student_id }}</td>
                        <td>{{ $user->student_email }}</td>
                        <td>{{ $user->department }}</td>
                        <td>{{ $user->shift }}</td>
                        <td>
                            @if( $user->role_id == 1 )
                                <button class="btn btn-sm btn-danger flat-btn disabled"><i class="fa fa-frown-o"></i></button>
                            @else
                                <button onclick="deleteUser({{ $user->id }})" class="btn btn-sm btn-danger flat-btn "><i class="bx bx-trash-alt"></i></button>
                                <form action="{{ route('admin.users.destroy',$user->id) }}" method="post"
                                      style="display: none" id="delete-form-{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                            <a href="{{ route('admin.users.edit',$user->id) }}"><span class="btn btn-sm btn-warning flat-btn"><i class="bx bx-edit"></i></span></a>
                            <a href=" {{ route('admin.users.show',$user->id) }} "><button class="btn btn-sm btn-info flat-btn text-white"><i class="lni lni-eye"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Shift</th>
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
                $("#userDataTable").DataTable({
                    'paging'      : true,
                    'lengthChange': false,
                    'searching'   : true,
                    'ordering'    : true,
                    'info'        : true,
                    'autoWidth'   : true
                });
            });
        })(jQuery);

        function deleteUser(id) {
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
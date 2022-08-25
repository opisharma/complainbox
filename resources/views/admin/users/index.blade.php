@extends( 'layouts.backend.app' )

@section( 'title','Users' )
@push('css')

@endpush

@section( 'content' )
<div class="card">
    <a href="{{ route('admin.u.create') }}"><button class="btn btn-outline-primary m-2"> <i class="bx bx-plus"></i> Add User</button></a>
    <div class="card-body">
        <div class="table-responsive">
            <table id="userDataTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach( $users as $key => $user )
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td style="text-align: left">
                                @if($user->role_id == 1)
                                    <small class="btn btn-sm text-white bg-green">Admin</small>
                                @elseif($user->role_id == 2)
                                    <small class="btn btn-sm text-white bg-green">Author</small>
                                @else 
                                    <small class="btn btn-sm text-white bg-green">Student</small>
                                @endif
                            </td>
                            <td style="text-align: center">
                                @if( $user->role_id == 1 )
                                    <button class="btn btn-sm btn-danger flat-btn disabled"><i class="lni lni-cross-circle"></i></button>
                                @else
                                    <button onclick="deleteUser({{ $user->id }})" class="btn btn-sm btn-danger flat-btn "><i class="bx bx-trash-alt"></i></button>
                                    <form action="{{ route('admin.u.destroy',$user->id) }}" method="post"
                                          style="display: none" id="delete-form-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
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
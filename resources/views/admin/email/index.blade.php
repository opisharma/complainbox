@extends( 'layouts.backend.app' )

@section( 'title','All Emails' )
@push('css')
@endpush

@section( 'content' )
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="box-header" style="display: inline-block">
                        <h3>{{ __(' Complain or Suggestion ') }}<span class="pull-right-container">
                          </span></h3>
                    </div>
                    <div class="box-body">
                        <table id="emailDataTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Permission</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($mails as $key => $mail)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $mail->user->name }}</td>
                                <td> {{ $mail->subject }} </td>
                                @if($mail->status == 1)

                                    <td class="text-center">
                                        <span class="btn btn-sm bg-green text-white">
                                            Approved
                                        </span>
                                    </td>
                                @elseif($mail->status == 2)
                                    <td class="text-center">
                                        <span class="btn btn-sm bg-red text-white">
                                            Declined
                                        </span>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <span class="btn btn-sm bg-red text-white">
                                            Pending
                                        </span>
                                    </td>

                                @endif
                                
                                <td>
                                    {{ date('F d, Y | h:i:s', strtotime($mail->created_at)) }}
                                </td>
                                
                                <td>
                                    <button onclick="deleteCategory({{ $mail->id }})" class="btn btn-sm btn-danger flat-btn "><i class="bx bx-trash-alt"></i></button>
                                    <form action="{{ route('admin.email.delete',$mail->id) }}" method="post"
                                        style="display: none" id="delete-form-{{$mail->id}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="{{ route('admin.email.show',$mail->id) }}"><span class="btn btn-sm btn-info flat-btn text-white"><i class="lni lni-eye"></i></span></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
@endsection

@push('js')
    {{-- sweet alert js --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $("#emailDataTable").DataTable({
                    'paging'      : true,
                    'lengthChange': false,
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
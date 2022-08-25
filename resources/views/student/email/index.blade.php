@extends( 'layouts.backend.app' )

@section( 'title','Complains' )
@push('css')
@endpush

@section( 'content' )
<div class="card">
    <a href="{{ route('user.email.form') }}"><button class="btn btn-outline-primary m-2"> <i class="bx bx-send"></i> Send Complain</button></a>
    <div class="card-body">
        <div class="table-responsive">
            <table id="emailDataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Subject Name</th>
                    <th>Is Approved</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $mails as $key => $mail )
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $mail->subject }}</td>
                    
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
                    <a href="{{ route('user.email.show',$mail->id) }}"><button class="btn btn-sm text-white btn-info flat-btn btn-sm"><i class="lni lni-eye"></i></button></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section( 'content' )
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ route('user.email.form') }}"><button class="btn btn-success flat-btn"><i class="mdi mdi-plus"></i>Compose Email</button></a>
                        </div>
                        <div class="box-body">
                            <table id="emailDataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject Name</th>
                                    <th>Is Approved</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $mails as $key => $mail )
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $mail->subject }}</td>
                                    
                                        @if($mail->status == 1)

                                            <td class="text-center">
                                                <span class="label bg-green">
                                                    Approved
                                                </span>
                                            </td>

                                        @else
                                            <td class="text-center">
                                                <span class="label bg-red">
                                                    Pending
                                                </span>
                                            </td>

                                        @endif
                                    
                                    <td>
                                        {{ date('F d, Y | h:i:s', strtotime($mail->created_at)) }}
                                    </td>
                                    <td>
                                    <a href="{{ route('user.email.show',$mail->id) }}"><button class="btn btn-info flat-btn btn-sm"><i class="fa fa-eye"></i></button></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </section>
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
    </script>
@endpush
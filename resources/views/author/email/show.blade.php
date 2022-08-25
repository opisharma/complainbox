@extends( 'layouts.backend.app' )

@section( 'title','Email' )
@push('css')
    <!-- DataTables -->
    <link href="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section( 'content' )
    <section class="card">
        <div class="row">
            <div class="col-md-12">
                    <div class="card-body">
                        {{-- {{ $mail->employees }} --}}
                        <div class="box-header">
                            <table id="showEmailTable" class="table table-bordered table-striped">
                                <tr>
                                    <td>To: </td>
                                    <td>
                                        @foreach ($mail->employees as $employee)
                                            {{ $employee->sub_category_name }} &nbsp;&nbsp;
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>From: </td>
                                    <td>{{ $mail->user->name }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Department: </td>
                                    <td>{{ $mail->user->department }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Shift: </td>
                                    <td>{{ $mail->user->shift }}</td>
                                </tr>

                                <tr>
                                    <td>Student Id: </td>
                                    <td>{{ $mail->user->student_id }}</td>
                                </tr>

                            </table>
                        </div>
                        {{-- end box-header --}}
                            <hr>
                            <div class="box box-widget">
                                <div class="box-header with-border">
                                  <div class="user-block">
                                    
                                  </div>
                                  <!-- /.user-block -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                  <!-- post text -->
                                    <h3>Message: </h3>
                                    <p>{!! $mail->message !!}</p>
                    
                                  <!-- /.attachment-block -->
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <p><strong>Application status:</strong> </p>
                                    @if ($mail->status === NULL)
                                        <a href="{{ route('author.approve',$mail->id) }}"><button class="btn bg-green flat-btn btn-sm text-white"><i class="lni lni-checkmark-circle"></i>Approve</button></a>
                                        <a href="{{ route('author.decline',$mail->id) }}"><button class="btn bg-red flat-btn btn-sm text-white"><i class="bx bx-shield-x"></i>Decline</button></a>
                                    @else
                                        @if($mail->status == 1) 
                                            <span class="btn btn-sm bg-green text-white">Approved</span>
                                        @else
                                            <span class="btn btn-sm bg-red text-white">Declined</span>
                                        @endif
                                    @endif
                                    <p class="mt-3"><strong>Documents</strong></p>
                                @if(!empty($mail->document))
                                    <span class="btn btn-sm bg-yellow"><i class="bx bx-file"></i><a class="text-white" href="{{ Storage::disk('public')->url('docs/'.$mail->document) }}">Attachment</a></span>
                                @endif
                                </div>
                              </div>
                        </div>
                        {{-- end box-body --}}
            </div> <!-- end col -->
        </div> <!-- end row -->
    </section>
@endsection

@push('js')
   <!-- Required datatable js -->
   <script src="{{ asset('backend/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
   <!-- Responsive examples -->
   <script src="{{ asset('backend/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('backend/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

   <!-- Datatable init js -->
   <script src="{{ asset('backend/assets/pages/jquery.table-datatable.js') }}"></script>
   {{-- sweet alert js --}}
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
   <script type="text/javascript">
       (function ($) {
           $(document).ready(function () {
               $("#showEmailTable").DataTable();
           });
       })(jQuery);

       
   </script>
@endpush
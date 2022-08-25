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
                                            {{ $employee->sub_category_name }}({{$employee->sub_category_designation}}) &nbsp;&nbsp;
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>From: </td>
                                    <td>{{ $mail->user->name }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Subject: </td>
                                    <td>{{ $mail->subject }}</td>
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
                                {{-- <p><strong>Current Status</strong></p>
                                @if ($mail->status === NULL)
                                    <span class="btn btn-sm bg-red text-white">Pending</span>
                                @else 
                                    <span class="btn btn-sm text-white bg-green">Approved</span>
                                @endif --}}
                                <p class="mt-3"><strong>Documents</strong></p>
                                @if(!empty($mail->document))
                                    <span class="btn btn-sm bg-yellow"><i class="bx bx-file"></i><a class="text-white" href="{{ Storage::disk('public')->url('docs/'.$mail->document) }}">Attachment</a></span>
                                @endif
                            </div>
                          </div>
                    </div>
                        {{-- end box-body --}}
                    </div>
                    {{-- end box --}}
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
@extends( 'layouts.backend.app' )

@section( 'title','Profile' )
@push('css')
    <!-- DataTables -->
    <link href="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .user-profile {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            position: relative;
            display: block;
        }
    </style>
@endpush

@section( 'content' )
    <section class="card">
        <div class="row">
            <div class="col-md-12">
                {{-- end box-header --}}
                <div class="card-body box-widget">
                    <div class="box-header with-border">
                        <div class="user-block">
                        @if ($user->avatar !== NULL)
                        <div class="user-profile" style="text-align: center">
                            <img src="{{ Storage::disk('public')->url('users/'.$user->avatar) }}" alt="">
                        </div>
                        @endif
                        <h3 style="text-align: center" >{{ $user->name }}</h3>
                        </div>
                        <!-- /.user-block -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- post text -->
                        <table id="showProfileTable" class="table table-bordered table-striped">
                            <tr>
                                <td> Email: </td>
                                <td>{{ $employee->sub_category_email }}</td>
                            </tr>
                            <tr>
                                <td> Department: </td>
                                <td> {{ $employee->category->category_name }} </td>
                            </tr>
                            <tr>
                                <td> Desgination: </td>
                                <td> {{ $employee->sub_category_designation }} </td>
                            </tr>
                            <tr>
                                <td>Action: </td>
                                <td> 
                                    <a href=" {{ route('author.edit',$user->id) }} "><button class="btn btn-warning btn-sm flat-btn"><i class="bx bx-edit"></i></button></a>    
                                </td>
                            </tr>
                        </table>
                    <!-- /.box-body -->
                        <div class="box-footer">
                            
                        </div>
                    </div>{{-- end box-body --}}
                </div>{{-- end box --}}
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
               $("#showProfileTable").DataTable();
           });
       })(jQuery);

       
   </script>
@endpush
@extends( 'layouts.backend.app' )

@section( 'title', 'Email' )

@push( 'css' )
    <!--Summer Note CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/summernote-bs4.css') }}">
    <!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/bower_components/select2/dist/css/select2.min.css') }}">

@endpush

@section('content')
    <section class="card">
        <div class="card-body">
            <div class="box-header">
                <h3>{{ __('Complain or Suggestion') }}</h3>
            </div>
            <div class="box-body">
                <div>
                    @if($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <form role="form" action="{{ route('user.email.send') }}" method="post" enctype="multipart/form-data">
                    
                    {{csrf_field()}}
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <input type="text" class="form-control" name="name" placeholder="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <select class="form-control" name="category" id="ct">
                                    <option>Select Department</option>
                                    @foreach( $categories as $category )
                                        <option  value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-grid mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <select class="form-control select2" data-live-search="true" multiple="multiple" name="email[]" id="sct" data-placeholder="Select Email Person" style="width: 100%">
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control select2" data-live-search="true" multiple="multiple" name="employee_id[]" id="sct_id" data-placeholder="Confirm Email Person" style="width: 100%">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mb-3">
                        <input type="text" class="form-control" placeholder="Subject" name="subject">
                    </div>
                    <div class="d-grid mb-3">
                        <textarea name="message" id="message" class="form-control" rows="10" cols="80"></textarea>
                    </div>
                    <div class="d-grid mb-3">
                        <label for="document">Document:</label>
                        <input type="file" class="form-control" name="document">
                    </div>
                    <div class="btn-toolbar form-group mb-0">
                        <div class="">
                            <button class="btn btn-primary" type="submit"><i class="bx bx-send"></i> <span>Send</span> <i class="fa fa-rocket"></i> </button>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </section>
@endsection

@push('js')
    <!--Select 2-->
    <script src="{{ asset('backend/assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- CK Editor -->
    <script src="{{ asset('backend/assets/bower_components/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.select2').select2({
                tokenSeparators: [',', ' ']
            });
            $('#ct').change(function () { 
                var ct_id = $('#ct').val();
                $("#sct > option").remove(); 
                var ct_id = $('#ct').val(); 
                $.ajax({
                    type: "GET",
                    data: {id: ct_id},
                    url: "{{url('user/email/get-subcategory-sct')}}", 
                    success: function (emails) 
                    {
                        console.log('success');
                        console.log(emails);
                        $.each(emails, function (email, name)
                        {
                            var opt = $('<option />');
                            opt.val(email);
                            opt.text(name);
                            $('#sct').append(opt);
                        });
                    }
                });
            });

            $('#ct').change(function () { 
                var ct_id = $('#ct').val();
                $("#sct_id > option").remove(); 
                var ct_id = $('#ct').val(); 
                $.ajax({
                    type: "GET",
                    data: {id: ct_id},
                    url: "{{url('user/email/get-subcategory-sct-id')}}", 
                    success: function (IDs) 
                    {
                        console.log('success');
                        console.log(IDs);
                        $.each(IDs, function (id, name)
                        {
                            var opt = $('<option />');
                            opt.val(id);
                            opt.text(name);
                            $('#sct_id').append(opt);
                        });
                    }
                });
            });

        });
        CKEDITOR.replace('message')

    </script>
    
@endpush
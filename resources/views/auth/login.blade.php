@extends( 'layouts.frontend.app' )

@section( 'title','Login' )

@section( 'content' )
<div class="mb-4 text-center">
    {{-- <img src="{{asset('img/logo_nub.png')}}" width="180" alt="" /> --}}
    <img src="{{asset('assets/images/log-in-logo.png')}}" width="180" alt="" />
</div>
        <div class="card">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="text-center">
                        <h3 class="">Sign in</h3>
                        <p>Don't have an account yet? <a href="{{ route('register') }}">Sign up here</a>
                        </p>
                    </div>
                    <div class="form-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Enter Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control border-end-0" name="password" id="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">	
                            @if (Route::has('password.request'))
                                <a  href="{{ route('password.request') }}"><i class="mdi mdi-lock"></i> {{ __('Forgot Your Password?') }} </a>
                            @endif
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                </div>
                            </div>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
		@endsection

        @push('js')
        <script>
            $(document).ready(function () {
                $("#show_hide_password a").on('click', function (event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass("bx-hide");
                        $('#show_hide_password i').removeClass("bx-show");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass("bx-hide");
                        $('#show_hide_password i').addClass("bx-show");
                    }
                });
            });
        </script>
        @endpush
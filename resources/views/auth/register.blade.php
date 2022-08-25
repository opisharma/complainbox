<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/syndron/demo/vertical/authentication-signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 19 Feb 2022 14:54:14 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	{{-- <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" /> --}}
	<!--plugins-->
	<link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
	<title>NUBCBOX</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
					<div class="col mx-auto">
						<div class="my-4 text-center">
							{{-- <img src="{{ asset('img/logo_nub.png') }}" width="180" alt="" /> --}}
							<img src="{{asset('assets/images/log-in-logo.png')}}" width="180" alt="" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign Up</h3>
										<p>Already have an account? <a href="{{route('login')}}">Sign in here</a>
										</p>
									</div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        </div>
                                    @endif
									<div class="form-body">
										<form method="POST" action="{{ route('register') }}" class="row g-3">
                                            @csrf                            
											<div class="col-sm-6">
												<label for="name" class="form-label">Full Name</label>
												<input type="text" class="form-control" id="name" name="name" placeholder="ex: Mahbubar Rahman">
											</div>
											<div class="col-sm-6">
												<label for="email" class="form-label">Email Address</label>
												<input type="email" class="form-control" id="email" placeholder="ex: redhatmahbub@gmail.com" name="email">
											</div>
											<div class="col-12">
												<label for="student_id" class="form-label">Student Id</label>
												<input type="text" name="student_id" class="form-control" id="student_id" placeholder="ex: 21190101088">
											</div>
											<div class="col-12">
												<label for="password" class="form-label">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" id="password" value="123456" name="password" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-12">
												<label for="password-confirm" class="form-label">Confirm Password</label>
												<div class="input-group" id="show_hide_password1">
													<input type="password" class="form-control border-end-0" id="password-confirm" value="123456" name="password_confirmation" placeholder="Confirm Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>

											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Sign up</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<!--Password show & hide js -->
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

            $("#show_hide_password1 a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password1 input').attr("type") == "text") {
					$('#show_hide_password1 input').attr('type', 'password');
					$('#show_hide_password1 i').addClass("bx-hide");
					$('#show_hide_password1 i').removeClass("bx-show");
				} else if ($('#show_hide_password1 input').attr("type") == "password") {
					$('#show_hide_password1 input').attr('type', 'text');
					$('#show_hide_password1 i').removeClass("bx-hide");
					$('#show_hide_password1 i').addClass("bx-show");
				}
			});
		});
	</script>
	
	<!--app JS-->
	<script src="{{asset('assets/js/app.js')}}"></script>
</body>


<!-- Mirrored from codervent.com/syndron/demo/vertical/authentication-signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 19 Feb 2022 14:54:14 GMT -->
</html>
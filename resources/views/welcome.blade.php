<!doctype html>
<html lang="en">
  <head>
  	<title>Login 09</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('style.css')}}">

	</head>
	<body style="background-image: url('/assets/img/login-back.png');background-size: cover;background-repeat: no-repeat;background-attachment: fixed;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap py-5">

						<form action="#" method="POST" class="login-form">
                        <div class="col-sm-12 d-flex justify-content-center">
                        <img width="200" class="mb-3" src="{{asset('assets/img/login-logo.png')}}" alt="">
                        </div>
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
                                <input type="text" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
                            <input  type="password" class="form-control" placeholder="Password" required>
                            </div>
                            <!-- <div class="form-group d-md-flex">
                                            <div class="w-100 text-md-right">
                                                <a href="#">Forgot Password</a>
                                            </div>
                            </div> -->
                            <div class="form-group mt-5 pl-lg-5 pr-lg-5">
                                <button type="submit" class=" form-control   submit px-3">Login</button>
                            </div>
	                    </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>


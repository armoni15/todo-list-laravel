<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>To Do-List App | Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="asset/fonts/linearicons/style.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="asset/css/style.css">
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">

				@if (session()->has('success'))
					<p class="in_success">{{ session('success') }}</p>
				@endif

				@if (session()->has('LoginError'))
					<p class="in_valid">{{ session('LoginError') }}</p>
				@endif

				<form action="/login" method="POST">
					@csrf
					<h3>Please Login</h3>
          @error('email')
            <small class="in_valid">{{ $message }}</small>
          @enderror
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="email" name="email" class="form-control" placeholder="E-Mail" autofocus required>
					</div>
          @error('password')
            <small class="in_valid">{{ $message }}</small>
          @enderror
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
					<button>
						<span>Login</span>
					</button>
          <p><a href="/register">Register</a> or <a href="/">Back to Home</a></p>
				</form>
			</div>
			
		</div>
		
		<script src="asset/js/jquery-3.3.1.min.js"></script>
		<script src="asset/js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
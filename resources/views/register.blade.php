<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>To Do-List App | Register</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="login/fonts/linearicons/style.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="login/css/style.css">
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<form action="/register" method="post">
          @csrf
					<h3>Registration Form</h3>
          @error('name')
            <small class="in_valid">{{ $message }}</small>
          @enderror
					<div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text" name="name" class="form-control" placeholder="Name" required value="{{ old('name') }}">
					</div>
          @error('email')
            <small class="in_valid">{{ $message }}</small>
          @enderror
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="email" name="email" class="form-control" placeholder="E-Mail" required value="{{ old('email') }}">
					</div>
          @error('password')
            <small class="in_valid">{{ $message }}</small>
          @enderror
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
					</div>
					<button>
						<span>Register</span>
					</button>
          <p><a href="/login">Login</a> or <a href="/">Back to Home</a></p>
				</form>
			</div>
			
		</div>
		
		<script src="login/js/jquery-3.3.1.min.js"></script>
		<script src="login/js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
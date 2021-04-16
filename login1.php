
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="hero">
		<div class="form-box">
			<div class="button-box">
				<div id="btn"></div>
				<button type="button" class="toggle-btn" onclick="login()">Log In</button>
				<button type="button" class="toggle-btn" onclick="register()">Register</button>				
			</div>
		
			<form id="login" class="input-group">
				<input type="email" class="input-field" placeholder="Email" required>
				<input type="text" class="input-field" placeholder="Enter Password" required>
				<input type="checkbox" class="check-box"><span>Remember Password</span>
				<button type="submit" class="submit-btn" name="login_user"><a href="Home.html">Log in</a></button>
			</form>
			<form id="register" class="input-group">
				<input type="text" class="input-field" placeholder="Full Name" required>
				<input type="email" class="input-field" placeholder="Email" required>
                <input type="text" class="input-field" placeholder="City" required>
                <input type="text" class="input-field" placeholder="Address" required>
                <input type="text" class="input-field" placeholder="Postal Code" required>
                <input type="text" class="input-field" placeholder="phone number" required>
                <input type="password" class="input-field" placeholder="Password" required>
                <input type="password" class="input-field" placeholder="Confirm Password" required>

				<input type="checkbox" class="check-box"><span>I agree to the terms and conditions</span>
				<button type="submit" class="submit-btn" name="reg_user">Register</button>
			</form>
		</div>
	</div>
	
	<script>
	var x = document.getElementById("login");
	var y = document.getElementById("register");
	var z = document.getElementById("btn");
	
	function register(){
		x.style.left = "-400px";
		y.style.left = "50px";
		z.style.left = "110px";
	}
	
	function login(){
		x.style.left = "50px";
		y.style.left = "450px";
		z.style.left = "0";
	}
	
	</script>
	
		
</body>
</html>
<?php
$this->title='Login';
$this->useTemplate('auth');
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1>Login</h1>

			<form id="login-form" method="post" action="#">

				<div class="form-group">
					<label>Email</label>
					<input class="form-control" name="email" type="text" placeholder="Email"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" name="password" type="password" placeholder="Password"/>
					<div style="font-size:0.9em;"><a href="/forgot-password">Forgot Password?</a></div>
				</div>
				<div class="checkbox">
					<label>
						<input id="remember" name="remember" type="checkbox" value="1"/> Remember Me
					</label>
				</div>
				<div class="form-group">
					<button class="btn btn-default" type="submit">Login</button>
				</div>
				<div class="error-message"></div>

			</form>

		</div>
	</div>
</div><!-- / .container -->

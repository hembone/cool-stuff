<?php
$this->title='Create Profile';
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1>Create Profile</h1>

			<form id="create-form" method="post" action="#">

				<div class="form-group">
					<label>First Name</label>
					<input class="form-control" name="fname" type="text" placeholder="First Name"/>
				</div>
				<div class="form-group">
					<label>Last Name</label>
					<input class="form-control" name="lname" type="text" placeholder="Last Name"/>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" name="email" type="text" placeholder="Email"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input class="form-control" name="password" type="password" placeholder="Password"/>
				</div>
				<div class="form-group">
					<label>Re-type Password</label>
					<input class="form-control" name="password2" type="password" placeholder="Re-type Password"/>
				</div>
				<div class="form-group">
					<label>Type</label>
					<select class="form-control" name="type">
						<option value="">Select Type...</option>
						<option value="dev">Developer</option>
						<option value="pm">Development Manager</option>
						<option value="create">Creative</option>
						<option value="pm">Project Manager</option>
						<option value="admin">Administrator</option>
					</select>
				</div>

				<div class="form-group">
					<button class="btn btn-default" type="submit">Create Profile</button>
				</div>
				<div class="error-message"></div>

			</form>

		</div>
	</div>
</div><!-- / .container -->

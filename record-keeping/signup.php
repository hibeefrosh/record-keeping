<?php
session_start();
include "config/app.php";
include "layout/header_dashboard.php";
?>
<header>
	<div class="d-flex p-3 bg-danger">
		<h5 class="text-white font-weight-bold">MyData</h5>
	</div>
</header>
<main class="mt-3">
	<div class="card col-md-6 mx-auto">
		<div class="card-body">
			<h5 class="font-weight-bold">Register</h5>
			<hr />
			<form action="process.php" method="post">
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="fullname" placeholder="Fullname" />
					<span class="error"></span>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="email" placeholder="Email" />
					<span class="error"></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" placeholder="Password" />
					<span class="error"></span>
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" class="form-control" name="cpassword" placeholder="Password" />
					<span class="error"></span>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-danger">Submit</button>
				</div>
			</form>
			<div class="text-center">
				<a href="<?php echo APP_URL ?>/index.php">Already have an account?</a>
			</div>
		</div>
	</div>
</main>
<?php
include "layout/footer.php";
?>
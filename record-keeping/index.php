<?php
session_start();
include "config/app.php";
include "layout/header.php";
$error = "";
if (isset($_SESSION["failed"])) {
	$error = $_SESSION["failed"];
	unset($_SESSION["failed"]);
}
?>
<header>
	<div class="d-flex p-3 bg-danger">
		<h5 class="text-white font-weight-bold">MyData</h5>
	</div>
</header>
<main class="mt-3">
	<div class="card col-md-6 mx-auto">
		<div class="card-body">
			<h5 class="font-weight-bold">Login</h5>
			<hr />
			<span class="error"><?php echo $error ?></span>
			<form action="validation.php" method="post">
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="email" placeholder="Email" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" placeholder="Password" />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-danger">Login</button>
				</div>
			</form>
			<div class="text-center">
				<a href="<?php echo APP_URL ?>/signup.php">Dont't have an account? Sign up</a>
			</div>
		</div>
	</div>
</main>
<?php
include "layout/footer.php";
?>
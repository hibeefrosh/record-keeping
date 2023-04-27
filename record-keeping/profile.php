<?php
include "config/app.php";
include "layout/header_dashboard.php";
include "middle-ware/user_auth.php";


$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "user_signup_db";

$conn = new mysqli($servername, $username, $db_password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id= $user_id");
$row = mysqli_fetch_array($result);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$fullname = $_POST['fullname'];
	$email = $_POST['email'];

	if (!empty($_FILES['profile-picture']['tmp_name'])) {
		// Check that the uploaded file is a valid image file
		$allowed_types = array('jpg', 'jpeg', 'png', 'gif');
		$file_type = strtolower(pathinfo($_FILES['profile-picture']['name'], PATHINFO_EXTENSION));
		if (in_array($file_type, $allowed_types)) {
			// Generate a unique filename for the uploaded image
			$filename = uniqid('profile-', true) . '.' . $file_type;
			// Move the uploaded image to a permanent location on the server
			move_uploaded_file($_FILES['profile-picture']['tmp_name'], 'uploads/' . $filename);
		} else {
			$error_message = 'Invalid file type. Only JPG, PNG, and GIF files are allowed.';
		}
	}
	$profile_picture_url = 'uploads/' . $filename;
	mysqli_query($conn, "UPDATE users SET fullname='$fullname', email='$email',profile_picture_url='$profile_picture_url' WHERE id=$user_id ");
	header("location:" . APP_URL . "/profile.php");
}

?>
<header>
	<div class="d-flex p-2 bg-danger align-items-center">
		<h5 class="text-white font-weight-bold">MyData</h5>
		<div class="ml-auto d-flex align-items-center">
			<img src="<?php echo $row["profile_picture_url"]; ?>" class="rounded-circle" width="50" height="50" />
			<h6 class="ml-2 text-white"><?php echo $row["fullname"]; ?></h6>
		</div>
	</div>
</header>
<main class="mt-3 col-md-8 mx-auto">
	<nav>
		<ul class="">
			<a href=" <?php echo APP_URL ?>/dashboard.php" class="btn btn-danger ml-2 mt-2"><i class="fas fa-bars"></i> Dashboard</a>
			<a href="<?php echo APP_URL ?>/add-new.php" class="btn btn-danger ml-2 mt-2"><i class="fas fa-plus"></i> Add Record</a>
			<a href="<?php echo APP_URL ?>/view-all.php" class="btn btn-danger ml-2 mt-2"><i class="fas fa-folder-open"></i> View Record</a>
			<a href="<?php echo APP_URL ?>/profile.php" class="btn btn-danger ml-2 mt-2"><i class="fas fa-user-circle"></i> Profile</a>
			<a href="<?php echo APP_URL ?>/logout.php" class="btn btn-danger ml-2 mt-2"><i class="fas fa-power-off"></i> Logout</a>
		</ul>
		<hr />
	</nav>
	<section class="">
		<div class="card col-md-9 mx-auto">
			<div class="card-body">
				<h5 class="font-weight-bold">My profile</h5>
				<hr />
				<span class="error"></span>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="text-center">
						<img src="<?php echo $row["profile_picture_url"]; ?>" class="rounded-circle" width="100" height="100" />
						<div class="mt-2">
							<label class="btn btn-danger" for="photo">
								<i class="fas fa-image"></i> Change photo
								<input type="file" id="photo" name="profile-picture" value="<?php echo $row["profile_picture_url"]; ?>" hidden />
							</label>
						</div>
					</div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="fullname" value="<?php echo $row["fullname"]; ?>" placeholder="Name" />
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>" placeholder="Email" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-danger">Save</button>
					</div>
				</form>

				<h5 class="font-weight-bold">Change Password</h5>
				<hr />
				<form action="profile_password.php" method="post">
					<div class="form-group">
						<label>Current password</label>
						<input type="password" class="form-control" name="current_password" placeholder="*****" />
					</div>
					<div class="form-group">
						<label>New password</label>
						<input type="password" class="form-control" name="new_password" placeholder="*****" />
					</div>
					<div class="form-group">
						<label>Confirm password</label>
						<input type="password" class="form-control" name="confirm_password" placeholder="*****" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-danger">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</section>
</main>
<footer>
</footer>
<?php
include "layout/footer.php";
?>
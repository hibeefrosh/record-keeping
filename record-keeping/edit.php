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

$id = $_GET["id"];
$result = mysqli_query($conn, "SELECT * FROM records WHERE id=$id");
$row = mysqli_fetch_array($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone_number = $_POST['phone_number'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$employment_type = $_POST['employment_type'];
	$address = $_POST['address'];

	mysqli_query($conn, "UPDATE records SET name='$name', email='$email', phone_number='$phone_number',dob='$dob',gender='$gender',employment_type='$employment_type',address='$address' WHERE id=$id");
	header("location:" . APP_URL . "/view-all.php");
}

?>
<header>
	<div class="d-flex p-2 bg-danger align-items-center">
		<h5 class="text-white font-weight-bold">MyData</h5>
		<div class="ml-auto d-flex align-items-center">
			<img src="assets/images/avatar.png" class="rounded-circle" width="50" height="50" />
			<h6 class="ml-2 text-white">Okanlawon</h6>
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
				<h5 class="font-weight-bold">Edit User Record</h5>
				<hr />
				<span class="error"></span>
				<form action="" method="post">
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" placeholder="Name" />
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>" placeholder="Email" />
					</div>
					<div class="form-group">
						<label>Phone number</label>
						<input type="text" class="form-control" name="phone_number" value="<?php echo $row["phone_number"]; ?>" placeholder="Phone number" />
					</div>
					<div class="form-group">
						<label>Date of birth</label>
						<input type="date" class="form-control" name="dob" value="<?php echo $row["dob"]; ?>" placeholder="" />
					</div>
					<div class="form-group">
						<label>Gender</label>
						<select name="gender" class="form-control">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
					<div class="form-group">
						<label>Employment Type</label>
						<select name="employment_type" class="form-control">
							<option value="employed">Employed</option>
							<option value="self-employed">Self-Employed</option>
							<option value="unemployed">Unemployed</option>
						</select>
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" class="form-control" value="<?php echo $row["address"]; ?>" placeholder="Address" />
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-danger">Edit</button>
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
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
<main class="mt-3 col-md-9 mx-auto">
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
		<div class="card col-md-6 mx-auto">
			<div class="card-body">
				<h5 class="text-center font-weight-bold">User Record</h5>
				<hr />
				<ul class="list-unstyled m-0">
					<li class="d-block mt-2">
						<label class="font-weight-bold m-0">Name</label>
						<p class="m-0"><?php echo $row["name"]; ?></p>
					</li>
					<li class="d-block mt-2">
						<label class="font-weight-bold m-0">Email</label>
						<p class="m-0"><?php echo $row["email"]; ?></p>
					</li>
					<li class="d-block mt-2">
						<label class="font-weight-bold m-0">Phone number</label>
						<p class="m-0"><?php echo $row["phone_number"]; ?></p>
					</li>
					<li class="d-block mt-2">
						<label class="font-weight-bold m-0">Date of birth</label>
						<p class="m-0"><?php echo $row["dob"]; ?></p>
					</li>
					<li class="d-block mt-2">
						<label class="font-weight-bold m-0">Gender</label>
						<p class="m-0"><?php echo $row["gender"]; ?></p>
					</li>
					<li class="d-block mt-2">
						<label class="font-weight-bold m-0">Employment Type</label>
						<p class="m-0"><?php echo $row["employment_type"]; ?></p>
					</li>
					<li class="d-block mt-2">
						<label class="font-weight-bold m-0">Address</label>
						<p class="m-0"><?php echo $row["address"]; ?></p>
					</li>
				</ul>
			</div>
		</div>
	</section>
</main>
<footer>
</footer>
<?php
include "layout/footer.php";
?>
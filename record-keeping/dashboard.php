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

$result1 = mysqli_query($conn, "SELECT * FROM users WHERE id= $user_id");
$row1 = mysqli_fetch_array($result1);

$sql = "SELECT COUNT(*) as total FROM records  WHERE user_id= $user_id";
$result = mysqli_query($conn, $sql);


if ($result && mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
}

$result_male = mysqli_query($conn, "SELECT COUNT(*) AS count_male FROM records WHERE user_id=$user_id AND gender='male'");
$row_male = mysqli_fetch_assoc($result_male);
$count_male = $row_male['count_male'];

$result_female = mysqli_query($conn, "SELECT COUNT(*) AS count_female FROM records WHERE user_id=$user_id AND gender='female'");
$row_female = mysqli_fetch_assoc($result_female);
$count_female = $row_female['count_female'];


?>
<header>
	<div class="d-flex p-2 bg-danger align-items-center">
		<h5 class="text-white font-weight-bold">MyData</h5>
		<div class="ml-auto d-flex align-items-center">
			<img src="<?php echo $row1["profile_picture_url"]; ?>" class="rounded-circle" width="50" height="50" />
			<h6 class="ml-2 text-white"><?php echo $row1["fullname"]; ?></h6>
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
		<div class="row">
			<div class=" col-md-4 mt-2">
				<div class="card">
					<div class="card-body text-danger d-flex align-items-center">
						<i class="fas fa-folder fa-3x"></i>
						<div class="ml-auto">
							<p class="m-0">No. of Records</p>
							<h4 class="m-0 font-weight-bold text-center"><?php echo $row["total"]; ?></h4>
						</div>
					</div>
				</div>
			</div>
			<div class=" col-md-4 mt-2">
				<div class="card">
					<div class="card-body text-danger d-flex align-items-center">
						<i class="fas fa-male fa-3x"></i>
						<div class="ml-auto">
							<p class="m-0">No. of Male Records</p>
							<h4 class="m-0 font-weight-bold text-center"><?php echo $count_male; ?></h4>
						</div>
					</div>
				</div>
			</div>
			<div class=" col-md-4 mt-2">
				<div class="card">
					<div class="card-body text-danger d-flex align-items-center">
						<i class="fas fa-female fa-3x"></i>
						<div class="ml-auto">
							<p class="m-0">No. of Female Records</p>
							<h4 class="m-0 font-weight-bold text-center"><?php echo $count_female; ?></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<footer>
</footer>
<?php
include "layout/footer.php";
?>
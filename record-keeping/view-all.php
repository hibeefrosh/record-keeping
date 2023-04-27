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

$query = "SELECT * FROM records WHERE user_id=$user_id";
$result = mysqli_query($conn, $query);

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
		<div class="">
			<div class="">
				<form action="" method="">
					<div class="form-group col-md-5">
						<input type="search" class="form-control" placeholder="Search name, gender" />
					</div>
				</form>
			</div>
			<!-- <div class="ml-auto w-50">
					<form action="" method="" class="">
						<div class="form-group col-md-5">
							<input type="search" class="form-control" placeholder="Search name" />
						</div>
					</form>
				</div> -->
		</div>
		<div class="table-wrap">
			<table class="table table-bordered table-wrap">
				<thead>
					<th>Name</th>
					<th>Gender</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>" . $row["name"] . "</td>";
							echo "<td>" . $row["gender"] . "</td>";
							echo "<td>" . $row["email"] . "</td>";
							echo "<td>" . $row["phone_number"] . "</td>";
							echo '<td>
										<a href="' . APP_URL . '/view-single.php?id=' . $row["id"] . '" type="button" class="btn btn-primary">
											<i class="fas fa-folder-open"></i>
										</a>
										<a href="' . APP_URL . '/edit.php?id=' . $row["id"] . '" type="button" class="btn btn-warning">
											<i class="fas fa-edit"></i>
										</a>
										<a href="' . APP_URL . '/delete.php?id=' . $row["id"] . '" type="button" class="btn btn-danger">
											<i class="fas fa-trash"></i>
										</a>
									</td>';
						}
					} else {
						echo "<tr><td colspan='5'>No records found</td></tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</section>
</main>
<footer>
</footer>
<?php
include "layout/footer.php";
?>
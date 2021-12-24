<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for registration
if (isset($_POST['subBtn'])) {
	$regno = $_POST['srid'];
	$fname = $_POST['status'];
	if($fname==0){
		$statusupdate=1;
	}
	if($fname==1){
		$statusupdate=0;
	}
	$query = "update  tution_fee_collection set status=$statusupdate where id=$regno";
	echo $query;
	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	echo "<script>alert('Tution Fee updated Succssfully');</script>";
	
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Student Tution Fee Collection</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
	<script type="text/javascript" src="js/validation.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>


</head>

<body>
	<?php include('includes/header.php'); ?>
	<div class="ts-main-content">
		<?php include('includes/sidebar.php'); ?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
						<br>
						<h2 class="page-title">Tution Fee Collection </h2>
						<?php
						if (isset($_GET['success']) && $_GET['success'] == 1) {
							// treat the succes case ex:
							echo "<h2 class='page-title'>Tution Fee Added Success </h2>";
						}
						?>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">Tution Fee Collection list</div>
									<div class="panel-body">

										<table class="table">
											<thead>
												<tr>
													<td>Id</td>
													<td>Student Name</td>
													<td>Student Id</td>
													<td>payment_date</td>
													<td>fee_amount</td>
													<td>Payment Date</td>
													<td>Status</td>
												</tr>
											</thead>
											<tbody>

												<?php
												$aid = $_SESSION['id'];
												$ret = "select * from tution_fee_collection";
												$stmt = $mysqli->prepare($ret);
												//$stmt->bind_param('i',$aid);
												$stmt->execute();
												$res = $stmt->get_result();
												$cnt = 1;
												while ($row = $res->fetch_object()) {
													$user = "SELECT * FROM `userregistration` WHERE id=$row->student_id";
													$result = $mysqli->prepare($user);
													//$stmt->bind_param('i',$aid);
													$result->execute();
													$results = $result->get_result();
													$value = $results->fetch_object();
													if ($row->status == 0) {
														$resultbtn = "Panding";
													}
													if ($row->status == 1) {
														$resultbtn = "Paid";
													}
												?><tr>
														<td><?php echo $row->id; ?></td>
														<td><?php echo $value->firstName; ?></td>
														<td><?php echo $row->student_id; ?></td>
														<td><?php echo $row->payment_date; ?></td>
														<td><?php echo $row->fee_amount; ?></td>
														<td><?php echo $row->pay_date; ?></td>

														<td>
															<form action="" method="post">
																<input type="hidden" name="status" value="<?php echo $row->status ?>">
																<input type="hidden" name="srid" value="<?php echo $row->id; ?>">
																<input type="submit" name="subBtn" id="" value="<?php echo $resultbtn; ?>">
															</form>
														</td>
													</tr>
												<?php
													$cnt = $cnt + 1;
												} ?>

											</tbody>
										</table>



									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
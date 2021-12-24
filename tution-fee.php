<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for registration
if (isset($_POST['submit'])) {
	$student_id = $_POST['student_id'];
	$payment_date = $_POST['payment_date'];
	$pay_year = $_POST['pay_year'];
	$fee_amount = $_POST['fee_amount'];
	$receipt_number = $_POST['receipt_number'];

	$query = "INSERT INTO tution_fee_collection(id, student_id, payment_date, pay_year, fee_amount, receipt_number, status) VALUES(NULL,$student_id, '$payment_date', $pay_year, $fee_amount, $receipt_number, 0)";
	// echo $query; exit;
	$mysqli->query($query);
	if ($mysqli->affected_rows == 1) {
		header("Location: tution-fee-details.php?success=1");
		// echo "<script>alert('Data Saved Succssfully!');</script>";
		// $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
	}else{
		echo "<script>alert('Data Not Saved');</script>";
	}
	$mysqli->close();
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

						<h2 class="page-title">Tution Fee Collection </h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading">Tution Fee Collection Form</div>
									<div class="panel-body">

										<form method="POST" action="" class="form-horizontal">

											<div class="form-group">
												<label class="col-sm-2 control-label">Student: </label>
												<div class="col-sm-8">
													<select name="student_id" id="student_id" class="form-control" required>
														<?php
														$studentId = $_SESSION['id'];
														$query = "SELECT * FROM userregistration WHERE id=$studentId";
														$stmt2 = $mysqli->prepare($query);
														$stmt2->execute();
														$res = $stmt2->get_result();
														while ($row = $res->fetch_object()) {
														?>
															<option value="<?php echo $row->id; ?>"> <?php echo $row->firstName; ?></option>
														<?php
														} ?>
													</select>
													<span id="room-availability-status" style="font-size:12px;"></span>

												</div>
											</div>


											<div class="form-group">
												<label class="col-sm-2 control-label">Due Month</label>
												<div class="col-sm-8">
													<select class="form-control" name="payment_date" id="payment_date">
														<option value="january">january</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="August">August</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value="November">November</option>
														<option value="December">December</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Year</label>
												<div class="col-sm-8">
													<select class="form-control" name="pay_year" id="pay_year">
													<option value="2021">2021</option>
													<option value="2022">2022</option>
													<option value="2023">2023</option>
													<option value="2024">2024</option>
													<option value="2025">2025</option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Fee : </label>
												<div class="col-sm-8">
													<input type="text" name="fee_amount" id="fee_amount" class="form-control" required="required">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Bank Receipt No. : </label>
												<div class="col-sm-8">
													<input type="text" name="receipt_number" id="receipt_number" class="form-control" required="required">
												</div>
											</div>


											<div class="col-sm-6 col-sm-offset-4">
												<button class="btn btn-default" type="submit">Cancel</button>
												<input type="submit" name="submit" Value="Submit" class="btn btn-primary">
											</div>
										</form>


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
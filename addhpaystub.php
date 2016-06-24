<?php
	include_once('config.php');
	include_once('dbutils.php');

	if (session_start()) {
	  $email = $_SESSION['email'];
	}
?>

<?php
// check if email already in database
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
	// set up my query
	$query = "SELECT Job.jobID, Job.jobTitle, Job.companyID, Company.companyID, Company.parentCompany FROM Job INNER JOIN Company ON Company.companyID = Job.companyID WHERE Job.email = '$email';";
	//print($query);
	
	// run the query
	$result = queryDB($query, $db);
	
	 //check if the companies are there
	if (nTuples($result) <= 0) {
	   print("There are no jobs in the databse.");
	}
	
	// options for club teams
	$jobCompanyOptions= "";
	
	// go through all club teams and put together pull down menu
	while ($row = nextTuple($result)) {
		$jobCompanyOptions .= "\t\t\t";
		$jobCompanyOptions .= "<option value='";
		$jobCompanyOptions .= $row['jobID'] . "'>" . $row['jobTitle'] . " (" . $row['parentCompany'] . ")</option>\n";
	}
?>

<html>
<head>
	<!-- Following three lines are necessary for running Bootstrap -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<script>
		$(function() {
			$( "#startDatepicker" ).datepicker({ dateFormat: "yy-mm-dd" }).val();
		});
		$(function() {
			$( "#endDatepicker" ).datepicker({ dateFormat: "yy-mm-dd" }).val();
		});
		$(function() {
			$( "#recDatepicker" ).datepicker({ dateFormat: "yy-mm-dd" }).val();
		});
	</script>


	<title>
		<?php echo "Add Pay Stub " . $Title; ?>
	</title>

	<!-- Following three lines are necessary for running Bootstrap -->
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>	
</head>

<body>
<div class="container">

<!-- Page header -->
<div class="row">
<div class="col-xs-12">
<div class="page-header">
	<h1><?php echo "Add Pay Stub: " . $Title; ?></h1>
</div>
</div>
</div>

<?php
// Back to PHP to perform the search if one has been submitted. Note
// that $_POST['submit'] will be set only if you invoke this PHP code as
// the result of a POST action, presumably from having pressed Submit
// on the form we just displayed above.
if (isset($_POST['submit'])) {
//	echo '<p>we are processing form data</p>';
//	print_r($_POST);
	// get data from the input fields
	$paycheck = $_POST['paycheck'];
	$startdate = $_POST['startdate'];
	$enddate = $_POST['enddate'];
	$paydate = $_POST['paydate'];
	$jobID = $_POST['jobID'];
	
	// check to make sure we have an email
	if (!$paycheck) {
		punt("Please enter the amount on your paycheck");
	}
	if (!$startdate) {
		punt("Please enter a start date (YYYY-MM-DD)");
	}
	if (!$enddate) {
		punt("Please enter a end date (YYYY-MM-DD)");
	}
		
	if (!$paydate) {
		punt("Please enter the date paycheck recieved (YYYY-MM-DD)");
	}
	// check if email already in database
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
	
	// set up my query
	$query = "INSERT INTO Wage(payCheck, startDate, endDate, payDate, jobID) VALUES ('$paycheck', '$startdate', '$enddate', '$paydate', '$jobID');";
	
	// run the query
	$result = queryDB($query, $db);
	
	
	// tell users that we added the player to the database
	//echo "<div class='panel panel-default'>\n";
	//echo "\t<div class='panel-body'>\n";
	//echo "\t\tThe Paycheck for amount " . $paycheck . " was added to the database\n";
	//echo "</div></div>\n";

	// takes the user where they should go after successful submit!
	header('Location: paystubs.php');
}
?>

<!-- Form to enter new users -->
<div class="row">
<div class="col-xs-12">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="form-group">
	<label for="jobID">Choose Job</label>
	<select class="form-control" name="jobID">
		<option selected disabled></option>
<?php echo $jobCompanyOptions; ?>
	</select>
</div>

<div class="form-group">
	<label for="paycheck">Please enter the amount on the paycheck</label>
	<input type="paycheck" class="form-control" name="paycheck"/>
</div>

<div class="form-group">
	<label for="startdate">Start Date</label>
	<input name="startdate" type="text" id="startDatepicker"><br>
	
	<label for="enddate">End Date</label>
	<input name="enddate" type="text" id="endDatepicker">
</div>

<div class="form-group">
	<label for="paydate">Date Received</label>
	<input name="paydate" type="text" id="recDatepicker">
</div>

<button type="submit" class="btn btn-default" name="submit">Add</button>
<a class="btn btn-danger" style="" href="paystubs.php" role="button">Cancel</a>

</form>

</div>
</div>


<!-- Titles for table -->
<thead>
<tr>

</tr>
</thead>

<tbody>


</tbody>
</table>
</div>
</div>

</div> <!-- closing bootstrap container -->
</body>
</html>

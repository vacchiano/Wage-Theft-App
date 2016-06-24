<?php
	include_once('config.php');
	include_once('dbutils.php');
	include_once('hashutil.php');
?>
<html>
<head>
	<title>
		<?php echo "Add Hours" . $Title; ?>
	</title>

	<!-- Following three lines are necessary for running Bootstrap -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>	

	<script>
		$(function() {
			$( "#startDatepicker" ).datepicker();
		});
		$(function() {
			$( "#endDatepicker" ).datepicker();
		});
	</script>
</head>

<body>

<div class="container">

<!-- Page header -->
<div class="row">
<div class="col-xs-12">
<div class="page-header">
	<h1><?php echo "Add Hours " . $Title; ?></h1>
</div>
</div>
</div>


<!-- Form to enter new users -->
<div class="row">
<div class="col-xs-12">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<!-- Job form -->
<div class="form-group">
	<label for="job">Job</label>
	<input name="job" type="text" class="form-control" name="Job"/>

	<label for="startDate">Start Date</label>
	<input name="startDate" type="text" id="startDatepicker"><br>
	
	<label for="endDate">End Date</label>
	<input name="endDate" type="text" id="endDatepicker">
</div>

<!-- input hours -->
<div class="input-append spinner" data-trigger="spinner">
<label for="hours">Hours</label>
<input name="hours" type="text" value="1" data-rule="quantity">
<div class="add-on"> <a href="javascript:;" class="spin-up" data-spin="up"><i class="icon-sort-up"></i></a> <a href="javascript:;" class="spin-down" data-spin="down"><i class="icon-sort-down"></i></a> </div>

</div>



<!-- start to end date -->




</div>

<button type="submit" class="btn btn-default" name="submit">Add</button>



</div>
</div>


<!-- Titles for table -->
<thead>
<tr>

</tr>
</thead>

<tbody>
<?php
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
	
	// set up my query
	$query = "SELECT email FROM Employee ORDER BY email;";
	
	// run the query
	$result = queryDB($query, $db);
	
	while($row = nextTuple($result)) {
		echo "\n <tr>";
		echo "<td>" . $row['email'] . "</td>";
		echo "</tr>";
	}
?>

</tbody>
</table>
</div>
</div>

</div> <!-- closing bootstrap container -->
</body>
</html>

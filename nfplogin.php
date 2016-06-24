<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

<html>
<head>
	<title>
		<?php echo "Login to " . $Title; ?>
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

<?php
// Back to PHP to perform the search if one has been submitted. Note
// that $_POST['submit'] will be set only if you invoke this PHP code as
// the result of a POST action, presumably from having pressed Submit
// on the form we just displayed above.
if (isset($_POST['submit'])) {
	
	
//	echo '<p>we are processing form data</p>';
//	print_r($_POST);
	// get data from the input fields
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	// check to make sure we have an email
	if (!$email) {
		header("Location: nfplogin.php");
	}
	
	if (!$password) {
		header("Location: nfplogin.php");
	}

	
	// check if user is in the database
		// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
	
	// set up my query
	$query = "SELECT hashedPass FROM NonProfitAccount WHERE email='$email';";

	//print($query);
	
	// run the query
	$result = queryDB($query, $db);
	
	// check if the email is there
	if (nTuples($result) > 0) {
	   $row = nextTuple($result);
	   if (crypt($password, $row['hashedPass']) == $row['hashedPass']) {
	      // Password is correct
	      if (session_start()) {
	      	$_SESSION['email'] = $email;
			$_SESSION['password'] = $row['hashedPass'];
			
			
		// Where do you really want to go here?
		header('Location: dashboard.html');
	       } else {
	        	punt("Unable to create session");
	}
		} else {
			// Password is not correct
			print("password:".$password . "<br>crypt:" . crypt($password, $row['hashedPass']) . "<br>DBPass:" . $row['hashedPass'] . "<br>");
			punt('The password you entered is incorrect');
		}
	} else {
		punt("The email '$email' is not in our database");
	}	
}
?>


<div class="container">

<!-- Page header -->
<div class="row">
<div class="col-xs-12">
<div class="page-header">
	<h1><?php echo "Login to " . $Title; ?></h1>
</div>
</div>
</div>

<?php
// CHEAP FIX REMOVE THIS LATER!
//session_destroy();
?>


<!-- Form to enter login -->
<div class="row">
<div class="col-xs-12">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="form-group">
	<label for="email">Non For Profit Email</label>
	<input type="email" class="form-control" name="email"/>
</div>

<div class="form-group">
	<label for="password">Non For Profit Password</label>
	<input type="password" class="form-control" name="password"/>
</div>

<button type="submit" class="btn btn-default" name="submit">Login</button>

</form>

</div>
</div>


</div> <!-- closing bootstrap container -->
</body>
</html>

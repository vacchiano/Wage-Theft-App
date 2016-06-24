<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

<html>
<head>
	<title>
		<?php echo "Sign up " . $Title; ?>
	</title>

	<!-- Following three lines are necessary for running Bootstrap -->
	<link rel="stylesheet" href="stylesheet.css">
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>  	
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
		header("Location: login.php");
	}
	
	if (!$password) {
		header("Location: login.php");
	}

	// check if user is in the database
		// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
	
	// set up my query
	$query = "SELECT hashedPass, name, phoneNumber, address FROM Employee WHERE email='$email';";
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
			$_SESSION['name'] = $row['name'];
			$_SESSION['phoneNumber'] = $row['phoneNumber'];
			$_SESSION['address'] = $row['address'];
			
		if ($email == 'admin@wage.com') {
					header('Location: admin.php');
				}
			else
				{
					// Where do you really want to go here?
					header('Location: account.php');
				}
	       } else {
	        	punt("<font color='white'>Unable to create session</font>");
	}
		} else {
			// Password is not correct
			print($password . "<br>" . crypt($password, $row['hashedPass']) . "<br>" . $row['hashedPass'] . "<br>");
			punt("<font color='white'>The password you entered is incorrect</font>");
		}
	} else {
		punt("<font color='white'>The email '$email' is not in our database</font>");
	}	
}

?>


<div class="container">

<!-- Page header -->
<div class="row">
<div class="col-xs-12">
<div class="page-header">
	<h1><?php echo "<font color='white'>Login to </font>" . $Title; ?></h1>
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
	<label for="email"><font color='white'>Email</font></label>
	<input type="email" class="form-control" name="email"/>
</div>

<div class="form-group">
	<label for="password"><font color='white'>Password</font></label>
	<input type="password" class="form-control" name="password"/>
</div>

<button type="submit" class="btn btn-default" name="submit">Login</button>
    <div class="row">
        <div class="col-md-2 text-center pull-right" style="padding-bottom:2%;"><a class="btn btn-primary" href="index.html" role="button">Home</a></div> 
    </div>

</form>

</div>
</div>


</div> <!-- closing bootstrap container -->
</body>
</html>

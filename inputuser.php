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

<body >


<div class="container">

<!-- Page header -->
<div class="row">
<div class="col-xs-12">
<div class="page-header">
	<h1><?php echo "<font color='white'>Create Account: </font>"; ?></h1>
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
	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$name = $_POST['name'];
	$phoneNumber = $_POST['phoneNumber'];
	$address = $_POST['address'];
	
	
	// check to make sure we have an email
	if (!$email) {
		punt("Please enter a email");
	}

	if (!$password1) {
		punt("Please enter a password");
	}

	if (!$password2) {
		punt("Please enter your password twice");
	}
	
	if ($password1 != $password2) {
		punt("Your two passwords are not the same");
	}
	
	if (!$name) {
		punt("Please enter a name");
	}
	
	if (!$address) {
		punt ("Please enter a name");
	}

	// check if email already in database
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
	
	// set up my query
	$query = "SELECT email FROM Employee WHERE email='$email';";
	
	// run the query
	$result = queryDB($query, $db);

	// check if the email is there
	if (nTuples($result) > 0) {
	   punt("The email address $email is already in the database");
	}
	
	// generate hashed password using the system-provided salt.
	$hashedPass = crypt($password1);
	
	// set up my query
	$query = "INSERT INTO Employee(email, hashedPass, name, phoneNumber, address) VALUES ('$email', '$hashedPass', '$name', '$phoneNumber', '$address');";
	print($query);
	
	// run the query
	$result = queryDB($query, $db);
	
	// tell users that we added the player to the database
	echo "<div class='panel panel-default'>\n";
	echo "\t<div class='panel-body'>\n";
	echo "\t\tThe user " . $email . " was added to the database\n";
	echo "</div></div>\n";
}
?>

<!-- Form to enter new users -->
<div class="row">
<div class="col-xs-12">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div class="form-group">
	<label for="email"><font color='white'>Email</font></label>
	<input type="email" class="form-control" name="email"/>
</div>

<div class="form-group">
	<label for="password1"><font color='white'>Password</font></label>
	<input type="password" class="form-control" name="password1"/>
</div>

<div class="form-group">
	<label for="password2"><font color='white'>Please enter password again</font></label>
	<input type="password" class="form-control" name="password2"/>
</div>

<div class="form-group">
	<label for="name"><font color='white'>Please enter full name</font></label>
	<input type="name" class="form-control" name="name"/>
</div>

<div class="form-group">
	<label for="phoneNumber"><font color='white'>Please enter your phone number</font></label>
	<input type="phoneNumber" class="form-control" name="phoneNumber"/>
</div>

<div class="form-group">
	<label for="address"><font color='white'>Please enter your home address</font></label>
	<input type="address" class="form-control" name="address"/>
</div>

<button type="submit" class="btn btn-default" name="submit">Add</button>
    <div class="row">
        <div class="col-md-2 text-center pull-right" style="padding-bottom:2%;"><a class="btn btn-primary" href="index.html" role="button">Home</a></div> 
    </div>

</form>

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

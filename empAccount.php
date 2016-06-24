<?php
$colour = $_GET["colour"];
?>
body {
    background-color: red<?php echo $colour ?>;
}
include_once("dbutils.php");
    include_once("config.php");

//Connect to database
    $db = connect($DBHost, $DBUser, $DBPassword, $DBName);

//Query database
    $query = "SELECT name, email, phoneNumber, address FROM Employee";

//Count returned rows
if($query->num_rows != 0) { 
//Put results in array
	while($rows = $query->fetch_assoc())
	{
		$name = $rows['name'];
		$email = $rows['email'];
		$phoneNumber = $rows['phoneNumber'];
		$address = $rows['address'];

		echo "<p>Name: $name <br> email: $email</p>"
	}
//Display the results
} else {
	echo "N/A"
}
53       <div class="row"> 
54         <div class="col-md-2 text-center pull-right"><a class="btn btn-danger" href="hoursInput.php" role="button">Home</a></div> 
55     </div> 

?>

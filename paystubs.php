<?php
  include_once('config.php');
  include_once('dbutils.php');
  
  if (session_start()) {
    $email = $_SESSION['email'];
  }
?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Hours Page</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  </head>
  <body>
      
  <header class="container">
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div>
      <ul class="nav navbar-nav col-sm-12">
        <li class="col-sm-3 text-center col-xs-3"><a href="hours.php">Hours</a></li>
        <li class="col-sm-3 text-center col-xs-3"><a href="jobs.php">Jobs</a></li>
        <li class="col-sm-3 text-center col-xs-3"><a href="paystubs.php">Pay Stubs</a></li>
        <li class="col-sm-3 text-center col-xs-3"><a href="account.php"><span class="glyphicon glyphicon-user" style="color:grey;"></span></a></li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>

<?php
    //echo "start";

  if (isset($_POST['submit'])) {
    //echo "submitted";
    $userList = $_POST['user'];

    $db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);

    if(empty($userList)) 
      {
        echo("You didn't select any users.");
      } 
    else
      {
        $N = count($userList);
 
        //echo("You selected $N User(s): ");

      for($i=0; $i < $N; $i++)
        {
          //echo($userList[$i] . " ");

          $query = "DELETE FROM Wage
                    WHERE Wage.wageID = '$userList[$i]';";
          $result = queryDB($query, $db);

          echo "<div class='panel panel-default'>\n";
          echo "\t<div class='panel-body'>\n";
          echo "\t\tThe Paychecks(s) were deleted from the database\n";
          echo "</div></div>\n";

          //echo("You Deleted $N User(s): ");
          //echo($userList[$i] . ", ");
        }
      }
    }
    ?>

      
  <div class="container">
    <div class="panel panel-default text-center">
        <div class="panel-heading">
            <h3 class="panel-title">User Pay Stubs</h3>
        </div>
      <div class="panel-body">
        <a class="btn btn-success" style="margin-bottom: 10px;" href="addhpaystub.php" role="button">Add Paystub</a>
        
          <div class="panel panel-default text-center">
        <div class="panel-heading">
            <h3 class="panel-title">Recent Pay Stubs Submitted</h3>
        </div>
      <div class="panel-body">
        <div class="row text-center">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
          //connect to database
          $db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
  
          //set up my query
          $query = "SELECT Wage.payCheck, Wage.startDate, Wage.endDate, Wage.payDate, Wage.wageID, Wage.jobID, Job.jobTitle, Job.jobID, Job.email FROM Wage INNER JOIN Job ON Wage.jobID = Job.jobID WHERE Job.email = '$email';";
  
          //run the query
          $result = queryDB($query, $db);
  
          while($row = nextTuple($result)) {
          echo "<td><input type='checkbox' name='user[]' value=" . $row['wageID'] . "></td>";
          echo "Paycheck Amount: <b>$";
          echo $row['payCheck'];
          echo "</b> for dates: <b>" . $row['startDate'] . "</b> to <b>" . $row['endDate'] . "</b> recieved on <b>" . $row[payDate] . "</b> for job: <b>" . $row['jobTitle'] . "</b></br>";
          }
  ?>
        </div>
      </div>
    </div>
          <button type="submit" class="btn btn-danger delete" name="submit">Delete Paycheck(s)</button>
          </form>
      </div>
      
    </div>
  </div>
      
   
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>
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

          $query = "DELETE FROM Job
                    WHERE Job.jobID = '$userList[$i]';";
          $result = queryDB($query, $db);

          echo "<div class='panel panel-default'>\n";
          echo "\t<div class='panel-body'>\n";
          echo "\t\tThe Job(s) were deleted from the database\n";
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
            <h3 class="panel-title">User Jobs</h3>
        </div>
      <div class="panel-body">
        <a class="btn btn-success" style="margin-bottom: 10px;" href="addJob.php" role="button">Add Job</a>
        
          <div class="panel panel-default text-center">
        <div class="panel-heading">
            <h3 class="panel-title">Saved Jobs</h3>
        </div>
      <div class="panel-body">
        <div class="row">
        <div class="col-sm-8 col-xs-6 text-center">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<?php
          //connect to database
          $db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
  
          //set up my query
          $query = "SELECT Company.parentCompany, Company.companyID, Job.companyID, Job.jobID FROM Company INNER JOIN Job ON Company.companyID = Job.companyID WHERE Job.email = '$email';";
  
          //run the query
          $result = queryDB($query, $db);
  
          while($row = nextTuple($result)) {
          echo "<td><input type='checkbox' name='user[]' value=" . $row['jobID'] . "></td>";
          echo "Company: ";
          echo "<td class='text-center'> <b>" . $row['parentCompany'] . "</b></td></br>";
          }
  ?>
        </div>
        <div class="col-sm-4 text-left col-xs-6">
<?php
          //connect to database
          $db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
  
          //set up my query
          $query = "SELECT hourlyPay, email FROM Job WHERE email = '$email';";
  
          //run the query
          $result = queryDB($query, $db);
  
          while($row = nextTuple($result)) {
          echo "Wage: ";
          echo "<b>$" . $row['hourlyPay'] . "</b></br>";
          }
  ?>


        </div>
        </div>

        <!--
        <div class="row">
        <div class="col-sm-8 col-xs-6">Company: Walmart</div><div class="col-sm-4 text-left col-xs-6">Wage: $10</div>
        </div>
        <div class="row">
        <div class="col-sm-8 col-xs-6">Company: Costco</div><div class="col-sm-4 text-left col-xs-6">Wage: $12</div>
        </div>
        <div class="row">
        <div class="col-sm-8 col-xs-6">Company: Walgreens</div><div class="col-sm-4 text-left col-xs-6">Wage: $20</div>
        </div> -->
        
      </div>
          </div>
          <button type="submit" class="btn btn-danger delete" name="submit">Delete Jobs</button>
          </form>

      </div>
    </div>
  </div>

  <?php
          //connect to database
          //$db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
  
          //set up my query
          //$query = "SELECT companyID, parentCompany FROM Company ORDER BY parentCompany";
  
          //run the query
          //$result = queryDB($query, $db);
  
          //while($row = nextTuple($result)) {
          //echo "<td>" . $row['parentCompany'] . "</br>";
          //}
  ?>
      
   
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>

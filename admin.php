<?php
  include_once('config.php');
  include_once('dbutils.php');
  
  if (session_start()) {
    $email = $_SESSION['email'];
  }

  if ($email != 'admin@wage.com') {
    header('location: index.html');
    die();
  }
?>


<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <style>
    td {
      padding: 0 0 2% 5%;
    }

    .delete {
      margin: 0 0 2% 0;
    }

  </style>    

  </head>
  <body>
      
  <header class="container">
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div>
      <ul class="nav navbar-nav col-sm-12">
        <li class="col-sm-3 text-center col-xs-3"></li>
        <li class="col-sm-3 text-center col-xs-3"><a href="admin.php">Users</a></li>
        <li class="col-sm-3 text-center col-xs-3"><a href="adminAccount.php"><span class="glyphicon glyphicon-user" style="color:grey;"></span></a></li>
        <li class="col-sm-3 text-center col-xs-3"></li>
        
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

          $query = "DELETE FROM Employee
                    WHERE Employee.email = '$userList[$i]';";
          $result = queryDB($query, $db);

          $query = "DELETE FROM Job
                    WHERE Job.email = '$userList[$i]';";
          $result = queryDB($query, $db);

          echo "<div class='panel panel-default'>\n";
          echo "\t<div class='panel-body'>\n";
          echo "\t\tThe user " . $userList[$i] . " was deleted from the database\n";
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
            <h3 class="panel-title">Users</h3>
        </div>
      <div class="panel-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button type="submit" class="btn btn-danger delete" name="submit">Delete User(s)</button>

        
          <div class="panel panel-default text-center">
        <div class="panel-heading">
            <h3 class="panel-title">User Info</h3>
        </div>
      <div class="panel-body">
        <div class="row text-center">
        <?php
          //connect to database
          $db = connectDB($DBHost,$DBUser,$DBPassword,$DBName);
  
          //set up my query
          $query = "SELECT email, name, phoneNumber, address FROM Employee;";
  
          //run the query
          $result = queryDB($query, $db);
          
          echo "<table style: width='100%'>";
          echo "<tr>";
          echo "<td class='text-left'><b>Name</b></td>";
          echo "<td class='text-left'><b>Email</b></td>";
          echo "<td class='text-left'><b>Phone</b></td>";
          echo "<td class='text-left'><b>Address</b></td>";
          while($row = nextTuple($result)) {
          echo "<tr>";
          //echo "<td>Name</td>";
          echo "<td class='text-left'>" . $row['name'] . "</td>";
          echo "<td class='text-left'>" . $row['email'] . "</td>";
          echo "<td class='text-left'>" . $row['phoneNumber'] . "</td>";
          echo "<td class='text-left'>" . $row['address'] . "</td>";
          echo "<td><input type='checkbox' name='user[]' value=" . $row['email'] . "></td>";
          echo "</tr>";
          }

          echo "</table>";
        ?>
      </form>
        </div>
      </div>
    </div>
          
      </div>
    </div>
  </div>
      
   
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>
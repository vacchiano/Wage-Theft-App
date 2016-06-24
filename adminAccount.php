<!DOCTYPE html>
<?php
  if (session_start()) {
    $email = $_SESSION['email'];
      $pass = $_SESSION['password'];
      $name = $_SESSION['name'];
    $address = $_SESSION['address'];
    $phoneNumber = $_SESSION['phoneNumber'];
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin Account Page</title>
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
        <li class="col-sm-3 text-center col-xs-3"></li>
        <li class="col-sm-3 text-center col-xs-3"><a href="admin.php">Users</a></li>
        <li class="col-sm-3 text-center col-xs-3"><a href="adminAccount.php"><span class="glyphicon glyphicon-user" style="color:grey;"></span></a></li>
        <li class="col-sm-3 text-center col-xs-3"></li>
        
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>

      
  <div class="container">
    <div class="panel panel-default text-center">
        <div class="panel-heading">
            <h3 class="panel-title">User Account Page</h3>
        </div>
      <div class="panel-body">
        <!-- <a class="btn btn-danger" style="margin-bottom: 10px;" href="empAccount.php" role="button">Edit Info</a> -->
        
          <div class="panel panel-default text-center">
        <div class="panel-heading">
            <h3 class="panel-title">User Info</h3>
        </div>
      <div class="panel-body">
        <div class="row text-center">Name: <?php echo $name; ?></div>
        <div class="row text-center">Email: <?php echo $email; ?></div>
        <div class="row text-center">Address: <?php echo $address; ?></div>
        <div class="row text-center">Phone Number: <?php echo $phoneNumber; ?></div>
        
      </div>
    </div>
          
      </div>
        
        <a class="btn btn-danger" style="margin-bottom: 20px;" href="logout.php" role="button">Log Out</a>
        
    </div>
  </div>
      
   
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>
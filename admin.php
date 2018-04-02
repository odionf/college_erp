<?php
  session_start();
  $_SESSION['$last_page']="index.php";
  if(!isset($_SESSION['$pid'])){
    echo '<script type="text/javascript">alert("Login First!")</script>';
    header("Location: {$_SESSION['$last_page']}");
    exit();
  } else {
    if($_SESSION['$type']!='Administrator'){
      echo '<script type="text/javascript">alert("Page doesn\'t exist!");</script>';
      header("Location: {$_SESSION['$last_page']}");
      exit();
    }
  }
  if (isset($_POST['submit'])) {
    include 'db.php';
    $sql = "INSERT INTO `notices`(`timestamp`, `priority`, `header`, `description`) VALUES ('".date('Y-m-d', time())."','".$_POST['priority']."','".$_POST['header']."','".$_POST['body']."')";
    $sql = $mysqli->query($sql);
    if ($sql) {
     	echo "<script>alert('Event Successfully Added!');</script>";
    } else {
     	echo "<script>alert('Error in Adding Event!');</script>";
    }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | UnScript" ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 999;">
  		<a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" alt="ConCat" style="margin-bottom: 5px;"> ConCat</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Notices <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admincrud.php">Users</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
    <form action="logout.php" method="post" style="float: right; margin: 0;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
    </form>
  </div>
</nav>
<div class="lead container" style="">
	<h3><br>Add a Notice:</h3>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
	  <div class="row">
	    <div class="col-md-6 mb-3">
	      <label for="header">Header</label>
	      <input type="text" class="form-control" id="header" name="header" placeholder="Header" required>
	    </div>
	    <div class="col-md-6 mb-3">
	      <label for="body">Body</label>
	      <textarea class="form-control" id="body" name="body" placeholder="body" required></textarea>
	    </div>
	  </div>
	  <div class="row"> 
	    <div class="col-md-3 mb-3">
	      <label for="speaker_contact">Priority</label>
	      <select style="float: left;" class="form-control" id="priority" name="priority">
            <option value="Low">Low</option>
            <option value="High">High</option>
            <option value="Moderate">Moderate</option>
        	</select>
	    </div>
	  </div>
	  <br>
	  <div class="row" style="align-items: center; width: 100%; padding-left: 2%;">
	  	<button class="btn btn-primary" type="submit" name="submit" value="Upload">Submit form</button>
	  </div>
	</form>
	<!--h3>Functions Covered by Administrator:</h3>
	<h4>User Management:</h4>
  <ul>
    <li>Adding New Users</li>
    <li>Deleting Individual Users</li>
    <li>Resetting Individual Passwords</li>
    <li>Deleting Users from select Range IDs</li>
    <li>Mass Adding Users in required numbers</li>
	</ul-->

  <!--h4>Event Management:</h4>
  <ul>
    <li>Turning public visibility off</li>
    <li>Editing Event Details</li>
    <li>Deleting Events</li>
  </ul>
  <h4>Speaker's Database:</h4>
  <ul>
    <li>Updating Details</li>
    <li>Deleting Speakers</li>
  </ul>
  <b style="color: red;">*Each identified by above tabs</b-->
</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "admin.php"; ?>
<?php
	$_SESSION['$last_page']="index.php";
?>
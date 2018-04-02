
<?php
	session_start();
  	$_SESSION['$last_page']="index.php";
  	if(!isset($_SESSION['$pid'])){
    	echo '<script type="text/javascript">alert("Login First!")</script>';
    	header("Location: {$_SESSION['$last_page']}");
    	exit();
  	} else {
    	if($_SESSION['$type']!='Faculty'){
      		echo '<script type="text/javascript">alert("Only accessible to a Faculty!");</script>';
      		header("Location: {$_SESSION['$last_page']}");
      		exit();
    	}
  	}
?> 
<!DOCTYPE html>
<html>
<head>
  <title>
  </title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body style="background-color: #e8f0ff;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 9999; width: 100%">
      <a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="ConCat"> Unscript</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="faculty.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Update Marks<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="messages.php">View Messages</a>
      </li>
      
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
  <form action="logout.php" method="post" style="float: right;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
  </form>
  </div>
</nav>

<div class="container-fluid">
<div class="container">
  <form method="Get" action="updatemarks.php">
    <div class="form-group">
      <label for="usr">Department</label>
      <input type="text" class="form-control" name="dept">
    </div>
    <div class="form-group">
      <label for="usr">Year</label>
      <input type="text" class="form-control" name="year">
    </div>
    <div class="form-group">
      <label for="usr">Class</label>
      <input type="text" class="form-control" name="cls">
  </div>
  <div class="form-group">
      <label for="usr">Subject</label>
      <input type="text" class="form-control" name="sub">
  </div>

  <div class="radio">
      <label><input type="radio" name="iat" value="1">IAT 1</label>
    </div>
    <div class="radio">
      <label><input type="radio" name="iat" value="2">IAT 2</label>
    </div>
  <button type="submit" name="subm" class="btn-info">Update marks for this class</button>
  </form>  
</div>

</div>
</body>
</html>
<?php $_SESSION['$last_page'] = "faculty.php"; ?>
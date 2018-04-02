<?php
	session_start();
  	$_SESSION['$last_page']="index.php";
  	if(!isset($_SESSION['$pid'])){
    	echo '<script type="text/javascript">alert("Login First!")</script>';
    	header("Location: {$_SESSION['$last_page']}");
    	exit();
  	} else {
    	if($_SESSION['$type']!='Parent'){
      		echo '<script type="text/javascript">alert("Only accessible to a Parents!");</script>';
      		header("Location: {$_SESSION['$last_page']}");
      		exit();
    	}
  	}
?>

<html>
<head>
<title><?php echo "".$_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | SAS"; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body style="background-color: #e8f0ff;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 9999; width: 100%">
      <a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="UnScript"> UnScript</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Notices<span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="studentattend.php">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="studentacademics.php">Academics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="messagetr.php">Message Teacher</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="messagetr.php">Change password(current)</a>
        </li>
    </ul>
    <div class = "navbar-text"> Signed in Parent of <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
  <form action="logout.php" method="post" style="float: right;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
  </form>
  </div>
</nav>
  <div id="mainbox" class="container-fluid" style="float:left;width:100%;">
    
  <?php
    include 'db.php';
    if (isset($_POST['submitp'])) {
        $pid = $_SESSION['$pid'];
        $query = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' LIMIT 1");
        $result = $query->fetch_assoc();
        $check =$_POST['olpswd']
        $result = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' AND password='$check' LIMIT 1");
        if(!$result)
        {
          echo"<script>alert('Invalid Password!')</script>";
        }
        elseif ($_POST['npswd']!=$_POST['cnpswd']) {
            echo "<script>alert('Passwords do not match')</script>";
        }
        else
        {
            if(strlen($_POST['cnpswd'])>=8 && strlen($_POST['cnpswd'])<=20){
              
              $qry = "UPDATE `users` SET password = '$_POST["cnpswd"]' WHERE pid='$pid'";
              
            }
            elseif(strlen($_POST['cnpswd'])<8){
              echo "<script>alert('Password too short!')</script>";
            } elseif (strlen($_POST['cnpswd'])>20) {
              echo "<script>alert('Password too long!')</script>";
            }
         }
        
      }
  ?>

</div>
</body>
</html>

<?php $_SESSION['$last_page'] = "index.php"; ?>
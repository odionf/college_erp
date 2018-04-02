
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

<?php 
include 'db.php';

$pd=$_SESSION['$pid'];
if(isset($_GET['subm']))
{
  $dept=$_GET['dept'];
  $year=$_GET['year'];
  $cls=$_GET['cls'];
  $ino=$_GET['iat'];
  $subject=$_GET['sub'];
  
}
?>
<form method="post" action="inmarks.php?iat=<?php echo $ino;?>">
 <div class="form-group">
      <label for="usr">Department</label>
      <input type="text" class="form-control" name="dept" value="<?php echo $dept ?>">
    </div>
    <div class="form-group">
      <label for="usr">Year</label>
      <input type="text" class="form-control" name="year" value="<?php echo $year ?>">
    </div>
    <div class="form-group">
      <label for="usr">Class</label>
      <input type="text" class="form-control" name="cls" value="<?php echo $cls ?>">
  </div>
<?php
$q= "SELECT * FROM `student` WHERE department='$dept' and year='$year' and class='$cls'";
    $re= mysqli_query($mysqli,$q);
   
    echo"<div class='row'>
    <div class='col-md-3 mb-3'>
      <label for='usr'>Subject name</label>
    </div>
    <div class='col-md-3 mb-3'>
      <input type='text'  name='subject' placeholder='subject'>
    </div>
    </div>";
 echo"<br>";
 echo "<div class='row'>
    <div class='col-md-3 mb-3'>
      <label for='usr'>PID</label>
    </div>
    <div class='col-md-3 mb-3'>
      <label for='usr'>Roll no</label>
    </div>
    <div class='col-md-3 mb-3'>
      <label for='usr'>Marks</label>
      
    </div>
    </div>";

    while($r=mysqli_fetch_assoc($re))

    
    {
      $pid=$r['pid'];
      echo "<div class='row'>
    <div class='col-md-3 mb-3'>
      <label for='usr'>".$r['pid']."</label>
    </div>
    <div class='col-md-3 mb-3'>
      <label for='usr'>".$r['roll']."</label>
    </div>
    <div class='col-md-3 mb-3'>";
    $query="SELECT * from marks where pid=$pid and subject='".$subject."'and iatno=$ino";
     $result= mysqli_query($mysqli,$query);
     if(($result->num_rows)>0)
    {
      
      $res=mysqli_fetch_assoc($result);
      echo"  <input type='text'  name='".$r['pid']."'placeholder='marks' value='".$res['marks']."'>";
    }
    else
    { 
      echo   "<input type='text'  name='".$r['pid']."'placeholder='marks'>";
    }
      
    echo"
    </div>
    </div>";
    }
echo"<button type='submit' name='sub' class='btn-secondary' style='width:30%;'>Update marks</button>";
?>



</body>
</html>
<?php $_SESSION['$last_page'] = "faculty.php"; ?>
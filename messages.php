

<!--<?php
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
?>-->

<!DOCTYPE html>
<html>
<head>

<style type="text/css">
.button {
  display: inline-block;

  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color:#3f6396;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}
.button:hover {background-color: #027987}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

textarea {
    width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
}


.main { 
                width: 900px; 
                margin: 0 auto; 
                height: 700px;
                border: 1px solid #ccc;
                padding: 20px;
            }

            .header{
                height: 100px;    
            }
            .content{    
                height: 700px;
                border-top: 1px solid #ccc;
                padding-top: 15px;
            }
            .footer{
                height: 100px;  
                bottom: 0px;
            }
            .heading{
                color: #FF5B5B;
                margin: 10px 0;
                padding: 10px 0;
                font-family: trebuchet ms;
            }

            #dv1, #dv0{
                width: 408px;
                border: 1px #ccc solid;
                padding: 15px;
                margin: auto;

            }
           

        </style>


	<title> 
	<?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | SAS"; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>


</head>
<body style="background-color: #e8f0ff;">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 9999; width: 100%">
  		<a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="ConCat"> UnScript</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="studentattend.php">Attendance<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="studentinfo.php">Edit Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="marksdata.php">View Marks</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="review.php">Review</a>
      </li>
    </ul>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
	<form action="logout.php" method="post" style="float: right;">
	    <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
	</form>
  </div>
</nav>


<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'erp';
$conn = new mysqli($host, $user, $pass, $db);
if(isset($_GET['subr']))
{
	$review=$_POST['review'];
}


$qery= "INSERT INTO `feedback` (`feedback`) VALUES ('.$review.')";
$re= mysqli_query($conn,$qery);
?>

<form method="post" action="parent.<?php ?>">
	<div>Comment or review?<textarea cols='50' rows='3' name='review'></textarea></div>
	<button type='submit' name='subr' class='btn-primary'>Click to save</button></form></div>
	</div>


</script>
</body>
</html>
<!--<?php $_SESSION['$last_page'] = "parent.php"; ?>-->
<?php
  session_start();
  $_SESSION['$last_page']="index.php";
  if(!isset($_SESSION['$pid'])){
    echo '<script type="text/javascript">alert("Login First!")</script>';
    header("Location: {$_SESSION['$last_page']}");
    exit();
  } else {
    if($_SESSION['$type']!='Student'){
      echo '<script type="text/javascript">alert("Only accessible to a student!");</script>';
      header("Location: {$_SESSION['$last_page']}");
      exit();
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name'] . " | SAS"; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<style type="text/css">
.card1 {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  width: auto;
  margin: auto;
  text-align: center;
  font-family: arial;
} 
  input[type=text] {
    border: 2px solid grey;
    border-radius: 4px;
}
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


/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 40%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #91a1bc;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    background-color: #91a1bc;
    color: white;
}</style>
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
          <a class="nav-link" href="#">Notices<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="studentattend.php">Attendance</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="studentacademics.php">View Marks</a>
        </li>

    </ul><button id="myBtn" class="button" type="button"  float: right;"><small>Change Password</small></button>
    <div class = "navbar-text"> Signed in as <i><?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?></i></div>
  <form action="logout.php" method="post" style="float: right;">
      <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
  </form>
  </div>
</nav>

  <div id="mainbox" class="container-fluid" style="float:left;width:100%;">
    <div style="width: 90%; margin-top: 1%">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group" style="float: right; width: 100% display: inline-block;">
        <div style="float: left;">
          <label for="sel1" style="text-align: center; margin: 5px;">Select Priority:</label>
          </div>
          <div style="float: left;"><select class="form-control" id="sel1" name="valueToSearch">
            <option value="">All</option>
            <?php 
            include 'db.php';
            if(isset($_POST['search'])){
              $search = $_POST['valueToSearch'];
            } else {
              $search ='';
            }
            $qry="SELECT distinct priority from `notices`";
            $res=mysqli_query($mysqli,$qry);
                while ($r=mysqli_fetch_assoc($res)) {
                if ($r['priority']==$search) {
                  echo "<option value='".$r['priority']."' selected>".$r['priority']."</option>";
                  }
                  else {
                echo "<option value='".$r['priority']."'>".$r['priority']."</option>";
                  }
               }
            ?>       
          </select></div>
          <div style="float: left;">&nbsp;<button type="submit" class="btn btn-primary" style="float: right;" name="search" >Find</button></div>       
        </div>
      </form>
    </div>
    <div style="width:100%;">


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h5>Password Security</h5>
    </div>
    <div class="modal-body">
    
    
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

      <table>
        <tr><td><label>Enter current password</label>
        </td><td><input type="password" name="olpswd">
        </td></tr><br>
        <tr><td><label>Enter new password</label>
        </td><td><input type="password" name="npswd">
        </td></tr><br>
        <tr><td><label>Confirm new Password</label>
        </td><td><input type="password" name="cnpswd">
        </td><br>
      </table>
      
      
    </div>
    <div class="modal-footer" style="align-items: center; align-self: center; align-content: center; border-radius: 15px; ">
      <h3><button class="button" type="submit" name="submitp" >CHANGE PASSWORD</button></h3>
      </form>
    </div>
  </div>

</div>

</div>
<?php
    include 'db.php';
    if (isset($_POST['submitp'])) {
        $pid = $_SESSION['$pid'];
        $query = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' LIMIT 1");
        $result = $query->fetch_assoc();
        $check =$_POST['olpswd'];
        $result = $mysqli->query("SELECT * FROM users WHERE pid = '$pid' AND user_pass='$check'");
        $r=$result->fetch_assoc();
        if(!$result)
        {
          echo"<script>alert('Invalid Password!')</script>";
        }
        elseif ($r['parent_pass']==$_POST['cnpswd']) {
          echo "<script>alert('Change your password')</script>";
        }
        elseif ($_POST['npswd']!=$_POST['cnpswd']) {
            echo "<script>alert('Passwords do not match')</script>";
        }
        else
        {
            if(strlen($_POST['cnpswd'])>=8 && strlen($_POST['cnpswd'])<=20){
              
              $qry = "UPDATE `users` SET user_pass = '$check' WHERE pid='$pid'";
              
            }
            elseif(strlen($_POST['cnpswd'])<8){
              echo "<script>alert('Password too short!')</script>";
            } elseif (strlen($_POST['cnpswd'])>20) {
              echo "<script>alert('Password too long!')</script>";
            }
         }        
      }
  ?>
  <?php
    $qry = "SELECT * FROM `notices` where priority LIKE'%$search%' ORDER BY timestamp";
    $count = 0;
    
    $result = mysqli_query($mysqli,$qry);
    if (!$result) {
    } 
    else  {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='container-fluid alert' style='float:left;width:device-width;'>";
          $count++;
          if($row['priority']=="Moderate")
            echo "<div class='alert alert-warning' style='float:left;width:100%;'><strong><a href='#' class='alert-link'>".$row['header']."</a></strong><br><p>".$row['description']."</p></div>";
          if($row['priority']=="High")
            echo "<div class='alert alert-danger' style='float:left;width:100%;'><strong><a href='#' class='alert-link'>".$row['header']."</a></strong><br><p>".$row['description']."</p></div>";
          if($row['priority']=="Low")
            echo "<div class='alert alert-success' style='float:left;width:100%;'><strong><a href='#' class='alert-link'>".$row['header']."</a></strong><br><p>".$row['description']."</p></div>";
          echo "</div>";
        }
      }
      if ($count == 0) {
        echo "<div class = 'container-fluid' style = 'text-align: center; margin: 20px;'><h1>No Notices found!</h1></div>";
      }
  ?>
  </div>
  </div>
</div>
</body>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</html>
<?php $_SESSION['$last_page'] = "index.php"; ?>
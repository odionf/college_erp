<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student page</title>               <!-- can possibly display name here, code is below-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index: 9999; width: 100%">
  		<a class="navbar-brand" href="#"><img src="img/concat_logo.png" width="20px" height="20px" style="margin-bottom: 5px" alt="Logo ">UnScript</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="student.php">Notices</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="studentattend.php">Attendance</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Academics<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <div class = "navbar-text"> Signed in as <i><!--< ?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?>--></i></div>
        	<form action="logout.php" method="post" style="float: right;">
        	    <button class="btn btn-secondary
              " style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
        	</form>
        </div>
    </nav>





<div class="container">
  <h2></h2>
  <p></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th><h2>Subject</h2></th>
        
        <th><h2>IAT1</h2></th>
        <th><h2>IAT2</h2></th>
        

        
      </tr>
    </thead>
    <tbody>
    <?php
    session_start();
include 'db.php';
 
$pid= $_SESSION['$pid'];
$sql = "SELECT * FROM marks where pid=$pid and iatno=1";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["subject"]."</td><td>".$row["marks"]."</td>";
        $qr=$sql = "SELECT * FROM marks where pid=$pid and iatno=2";
        $resu = $mysqli->query($sql);
        if($resu->num_rows > 0)
        {
        $r = $resu->fetch_assoc();
        echo"<td>".$r['marks']."</td>";

}
else{
  echo"<td></td>";
}
        echo"</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

?>    
      
</div>

</body>
</html>

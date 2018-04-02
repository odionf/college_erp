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

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Marks</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
HELLO
<div class="container">
  <h2></h2>
  <p></p>            
  <table class="table table-hover">
    <thead>
      <tr>
        <th><h2>Subject</h2></th>
        
        <th><h2>Marks</h2></th>
        
      </tr>
    </thead>
    <tbody>
    <?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'erp';
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$pid= 152025;
$sql = "SELECT * FROM marks where pid=$pid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["subject"]."</td><td>".$row["marks"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>    
      
</div>

</body>
</html>
<?php $_SESSION['$last_page'] = "index.php"; ?>
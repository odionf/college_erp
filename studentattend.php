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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Attendance<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="studentacademics.php">Academics</a>
                </li>
            </ul>
            <div class = "navbar-text"> Signed in as <i><!--< ?php echo $_SESSION['$first_name'] . " " . $_SESSION['$last_name']; ?>--></i></div>
          <form action="logout.php" method="post" style="float: right;">
              <button class="btn btn-secondary" style="margin-left: 10px;" type="submit" name="logout">Log Out</button>
          </form>
        </div>
    </nav>


 <div id="mainbox" class="container-fluid">
    <div style="width: 90%; margin-top: 1%">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group" style="float: right; width: 100% display: inline-block;">
        <div style="float: left;">
          <label for="sel1" style="text-align: center; margin: 5px;">Select Date:</label>
          
           <?php
            include 'db.php';
            session_start();
            $pid=$_SESSION['$pid'];
            
            $search='0';
            if(isset($_POST['search'])){
              $search = '1';
            } else {
              $search = '0';
            }
                     
            
            ?>
            <input type="date" name="dateFrom" value=""/>  
          </select></div>
          <div style="float: left;">&nbsp;<button type="submit" class="btn btn-primary" style="float: right;" name="search" >Find</button></div>       
        </div>
      </form>
    </div>

    <?php
    if($search==1){
    $new_date = date('Y-m-d', strtotime($_POST['dateFrom']));
    #echo $new_date;
    #put pid two lines down here session one
    $qry="SELECT SUBSTRING(got.attendance,got.hour,1) as attended,got.subject,got.hour from
    (SELECT a.attendance,t.hour,t.subject from attend a,timetable t,student s 
    where a.pid=$pid
    AND a.ddate= '$new_date' 
    and t.ddate = a.ddate 
    AND t.year = s.year 
    AND t.department = s.department 
    AND s.class = t.class 
    AND a.pid=s.pid 
    AND ((t.type=1 AND t.batch = s.batch) OR (t.type = 0 and t.batch = 0))
    ) got";
    
    #echo $qry;
    $res=mysqli_query($mysqli,$qry);
    if (mysqli_num_rows($res) > 0){
        $att_num=0;
        $att_num_tot=0;
        // output data of each row
        echo "<table class='table table-hover'>";
        echo "<tr><th>Attendance on ".date('d-M-Y /D',strtotime($new_date))."</th><th>Subject</th></tr>";
        while($row = mysqli_fetch_assoc($res)){
            if($row["attended"] == 1){
                $att='yes';
                $att_num +=1;
                $att_num_tot +=1;
            }
            elseif($row["attended"] == 0){
                $att='no';
                $att_num_tot +=1;
            }
            else
                $att='cancalled';
            //print accordingly here
            echo "<tr>";
            echo "<td>" . $att. " </td><td> " . $row["subject"]."</td>";
            echo "</tr>";
            
        }
        echo "<tr><th>Total</th><th>".(($att_num/$att_num_tot)*100)."%</th></tr>";
        echo "</table>";
    } else {
        echo "0 results";
    }
  }
    ?>
</body>
</html>
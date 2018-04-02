<?php
include 'db.php';
  $dept=$_POST['dept'];
  $year=$_POST['year'];
  $cls=$_POST['cls'];
  $ino=$_GET['iat'];
  $subject=$_POST['subject'];
$qry= "SELECT * FROM `student` WHERE department='$dept' and year='$year' and class='$cls'";
$re= mysqli_query($mysqli,$qry);
while($r=mysqli_fetch_assoc($re))
{
	$pid=$r['pid'];
	$marks=$_POST[$pid];
	$query="SELECT * from marks where pid=$pid and subject='".$subject."'and iatno=$ino";
	$result= mysqli_query($mysqli,$query);
	if(($result->num_rows)>0)
	{
		$q= "UPDATE marks set marks =$marks where pid=$pid and subject='".$subject."' and iatno=$ino";
	$res= mysqli_query($mysqli,$q);

	
	}
	else
	{
		$q="INSERT INTO marks values($ino,'$subject',$pid,$marks);";
		$resu=mysqli_query($mysqli,$q);


	
	}
	

}
echo "<script>alert('Successfully Updated!')</script>";
echo "<script> window.location.href = 'faculty.php'</script> ";
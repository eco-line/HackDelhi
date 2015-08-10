<?php
session_start();	
$uname=$_POST['uname'];
$pwd=$_POST['pwd'];

$conn=mysqli_connect("localhost","sponsorh_golu","lumia625","sponsorh_hack");

$sql="select * from user where room_no='$uname' and password='$pwd'";

$result=$conn->query($sql);
$record=$result->fetch_assoc();

if($result->num_rows==1)
{
	$data=array( $record['name'] , $record['room_no']);
	$_SESSION['name']=$record['name'];
	$_SESSION['room']=$record['room_no'];
	echo json_encode($data);
}
else
{
	$data=array('false','golu');
	echo json_encode($data);
}

?>

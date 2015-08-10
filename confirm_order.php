<?php

$room=$_POST['room'];
$type=$_POST['type'];
$total=$_POST['total'];

$conn=mysqli_connect("localhost","sponsorh_golu","lumia625","sponsorh_hack");

$sql="insert into orders(room_no,type,total) values('$room','$type','$total')";

if($conn->query($sql))
{
echo 'true';
}
else
	
	{
	echo 'false';
	}
?>

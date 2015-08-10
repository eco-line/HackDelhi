<?php
$total=$_POST['total'];
$room=$_POST['room'];

$conn=mysqli_connect("localhost","sponsorh_golu","lumia625","sponsorh_hack");

$sql="insert into orders(room_no,type,total) values('$room','cab','$total')";

if($conn->query($sql))
{
echo 'true';
}
else
	{
	echo 'false';
	}
?>

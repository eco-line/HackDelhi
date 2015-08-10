<?php

	
$servername = "localhost";   // username and password of phpmyadmin
$username = "sponsorh_golu";			 // username and password of phpmyadmin
$password = "lumia625";				 // username and password of phpmyadmin
$dbname = "sponsorh_hack";		 // username and password of phpmyadmin

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['update']))
{
	echo $_POST['newnote'];
	$sql1="INSERT INTO notice ( note ) VALUES ('".$_POST['newnote']."')";
if ($conn->query($sql1) === TRUE) {
	
    echo "New record created successfully";
	echo "<script>window.open('http://sponsorhunt.in/HackDelhi1/','_self');</script>";
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}


}

?>

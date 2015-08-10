<?php
	
	
	if($_POST['pwd']=='rohit')
	{
	?>
	
<html>
	<head>
	</head>
	<body>
	<h1>Welcome Admin</h1>
		
		<div class="form">
			<form action="admin_send1.php" method="POST">
				Type Your Notice here :<input type="text" name="newnote">
				<input type="submit" name="update" value="Update">
			</form>		
		</div>
	</body> 	
</html>

<?php
	}
	else
		
		{
		
		echo 'invalid password  , try again';
		}
?>

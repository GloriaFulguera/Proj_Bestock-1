<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	<?php require_once "menu.php"; ?>
</head>
<body>

<center>
	 <img src="../img/fondo.jpg" alt="" width="1000px" height="400px">
</center>

	

</body>
</html>
<?php 
	}else{
		header("location:../index.php");
	}
 ?>
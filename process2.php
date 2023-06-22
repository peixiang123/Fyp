<?php 
session_start();
include "runSQL.php";

	$workName = $_POST['workName'];
	$phone = $_POST['phone'];
	$emaail = $_POST['emaail'];
	$profesison = $_POST['profesison'];
	$paass = $_POST['paass'];
	
	$sql = "SELECT workName from worker where workName = '$workName';";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);

		if($row['workName'] == $workName)
		{	
			echo "<script>alert('worker is already registered.');</script>";
			echo"<meta http-equiv='refresh' content='0; url=accreg.php'/>";
		}				
		else
		{
			$sql1 = "INSERT INTO worker (workName, phone, emaail, profesison, paass) VALUES ('$workName', '$phone', '$emaail', '$profesison','$paass');";
			$res = mysqli_query($conn,$sql1);  
			echo "<script>alert('Register succesful! Please try to login.');</script>";
			echo"<meta http-equiv='refresh' content='0; url=login.php'/>";
		}
	
?>
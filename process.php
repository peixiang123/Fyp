<?php 
session_start();
include "runSQL.php";

	$custName = $_POST['custName'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$phoneNum = $_POST['phoneNum'];
	$pass = $_POST['pass'];


	$sql = "SELECT custName from customer where custName = '$custName';";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);

		if($row['custName'] == $custName)
		{	
			echo "<script>alert('user is already registered.');</script>";
			echo"<meta http-equiv='refresh' content='0; url=accreg.php'/>";
		}				
		else
		{
			$sql1 = "INSERT INTO customer (custName, address, email, phoneNum, pass) VALUES ('$custName', '$address', '$email', '$phoneNum','$pass');";
			$res = mysqli_query($conn,$sql1);  
			echo "<script>alert('Register succesful! Please try to login.');</script>";
			echo"<meta http-equiv='refresh' content='0; url=login.php'/>";
		}
	
?>
<?php 
session_start();
include "runSQL.php";

	$categoryName = $_POST['categoryName'];
	$desctiption = $_POST['desctiption'];
	
	$sql = "SELECT categoryName from category where categoryName = '$categoryName';";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);



		if($row['categoryName'] == $categoryName)
		{	
			echo "<script>alert('category is already exist.');</script>";
			echo"<meta http-equiv='refresh' content='0; url=insertcategory.php'/>";
		}				
		else
		{
			$sql1 = "CALL insert_category('$categoryName', '$desctiption');";
			$res = mysqli_query($conn,$sql1);  
			echo "<script>alert('category successful insert.');</script>";
			echo"<meta http-equiv='refresh' content='0; url=insertcategory.php'/>";
		}
	
?>
<!-- deliver2.php -->
<?php
session_start();
include('runSQL.php');

$order_id = $_POST['order_id'];


	$sql = "UPDATE orders SET delStatus = 'Done' WHERE order_id = '$order_id'";
	$result = mysqli_query($conn, $sql);

echo "<script type='text/javascript'>alert('Thank you')</script>";
echo "<meta http-equiv=\"refresh\"content=\"0.2;URL=delivery.php\">";
?>
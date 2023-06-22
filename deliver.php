<!-- deliver.php -->
<?php
session_start();
include('runSQL.php');

$order_id = $_POST['order_id'];
$worker_id= $_SESSION['worker_id'];
$delPhone= $_SESSION['phone'];
$workName= $_SESSION['workName'];

$sql = "INSERT INTO delivery (delName, delPhone, deliveryDate, deliveryRate, order_id, worker_id) VALUES ('$workName', '$delPhone', now(), null, '$order_id', '$worker_id')";
$result = mysqli_query($conn, $sql);

if($result){
	$sql1 = "UPDATE orders SET delStatus = 'delivering' WHERE order_id = '$order_id'";
	$result1 = mysqli_query($conn, $sql1);
}

echo "<script type='text/javascript'>alert('you will deliver the order : " . $order_id . "');</script>";
echo "<meta http-equiv=\"refresh\" content=\"0.2;URL=delivery.php\">";

?>
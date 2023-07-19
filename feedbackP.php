<!-- feedbackP.php -->
<?php

session_start();
include('runSQL.php');
$customer_id = $_SESSION['customer_id'];
$order_id = $_POST['order_id'];
$scores = $_POST['score'];
$descriptions = $_POST['description'];
$food_ids = $_POST['food_id'];
$delivery_id = isset($_POST['delivery_id']) ? $_POST['delivery_id'] : null; // Check if delivery_id is present
$deliveryRate = isset($_POST['deliveryRate']) ? $_POST['deliveryRate'] : null; // Check if deliveryRate is present

foreach ($food_ids as $key => $food_id) {
  $score = $scores[$key];
  $description = $descriptions[$key];

  $sql = "INSERT INTO rating (customer_id, food_id, ratingDate, description, score) VALUES ('$customer_id', '$food_id', NOW(), '$description', '$score')";
  $result = mysqli_query($conn, $sql);
}


$sql1 = "UPDATE orders SET feedback = 'Done' WHERE order_id = '$order_id'";
$result1 = mysqli_query($conn, $sql1);

echo "<script>alert('Thank you for your feedback.');</script>";
echo "<meta http-equiv=\"refresh\"content=\"0.2;URL=orderhistory.php\">";

if ($delivery_id !== null && $deliveryRate !== null) {
  $sql2 = "UPDATE delivery SET deliveryRate = '$deliveryRate' WHERE delivery_id = '$delivery_id'";
  $result2 = mysqli_query($conn, $sql2);
}

?>
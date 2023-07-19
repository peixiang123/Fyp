<!-- feedback.php -->
<!DOCTYPE html>
<html>
<head>
	<?php 
	include('customerheader.php');
	  ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/759e025e11.js" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="feedback.css">
	<title>feedback</title>
</head>
<body>
	<h1 style="margin-left: 200px;">Feedback Page</h1>
	<br>
	<h2 style="margin-left: 200px;">Your feedback is the greatest help to us &nbsp;&nbsp;&nbsp;<span style="font-size:50px;">ฅ^•ﻌ• ^ฅ</span></h2>
	<table class="order">
        <tr style="border: 2px solid black; padding:10px; background-color:#FFD700;">
            <th>Food</th>
            <th>Rate</th>
        </tr>

<?php

$order_id = $_GET['order_id'];

	$sql="SELECT f.food_id, f.name, f.food_image, od.order_id FROM order_detail od JOIN food f ON f.food_id = od.food_id 
  WHERE od.order_id = $order_id";
	$result = mysqli_query($conn, $sql);


 while ($row = mysqli_fetch_assoc($result)) {
 	$name= $row['name'];
 	$food_id = $row['food_id'];
            echo "<tr style='border: 2px solid black;'>";
            echo "<td>" . $row['name'] . "
            		<br>
            		<img src='" . $row['food_image'] . "'style='width:100px; height:90px;'>
            		</td>";
            echo "
            <td>
    <form action= 'feedbackP.php' method='post' onsubmit='return checkRating()'>       
    <input type='hidden' name='score[]' id='score" . $row['food_id'] . "'>
<span class='fa fa-star' onclick='setRating(1," . $row['food_id'] . ")' data-food-id='" . $row['food_id'] . "'></span>
<span class='fa fa-star' onclick='setRating(2, " . $row['food_id'] . ")' data-food-id='" . $row['food_id'] . "'></span>
<span class='fa fa-star' onclick='setRating(3," . $row['food_id'] . ")' data-food-id='" . $row['food_id'] . "'></span>
<span class='fa fa-star' onclick='setRating(4," . $row['food_id'] . ")' data-food-id='" . $row['food_id'] . "'></span>
<span class='fa fa-star' onclick='setRating(5," . $row['food_id'] . ")' data-food-id='" . $row['food_id'] . "'></span>

</input>


<br>
<br>
<label>Write your comment here.</label>
<br>
<textarea type='text' id='description" . $row['food_id'] . "' name='description[]'></textarea>
<br>
<input type='hidden' name='food_id[]' value='" . $row['food_id'] . "'>
<input type='hidden' name='order_id' value='" . $order_id . "'>
</td>
</tr>
    ";
  }
    ?>
    </table>


<script>
  let ratingSelected = false;

  function setRating(score, foodId) {
    ratingSelected = true;

    // Reset all stars to default state
    var stars = document.querySelectorAll('.fa-star[data-food-id="' + foodId + '"]');
    for (var i = 0; i < stars.length; i++) {
      stars[i].classList.remove("checked");
    }

    // Set the selected stars to checked state
    for (var i = 0; i < score; i++) {
      stars[i].classList.add("checked");
    }

    // Set the rating value in the hidden input field
    document.getElementById("score" + foodId).value = score;
  }

  function checkRating() {
    if (!ratingSelected) {
      alert("Please select a rating");
      return false; // prevent form submission
    }

    return true; // allow form submission
  }

</script>
<!-----------delivery men rating------------------>
<?php
$sql1="SELECT delivery_id, delName FROM delivery WHERE order_id = $order_id";
  $result1 = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_assoc($result1)) {
  if (!empty($row['delivery_id'])) {
    $delivery_id = $row['delivery_id'];
    echo"<h1 style='margin-left: 200px;'>Rating for delivery men~</h1>
<table class='order'>
        <tr style='border: 2px solid black; padding:10px; background-color:#FFD700;'>
            <th>Delivery Men</th>
            <th>Rate</th>
        </tr>";
    echo "<tr style='border: 2px solid black;'>";
    echo "<td>" . $row['delName'] . "</td>";
    echo "
    <td>
    <form method='post' onsubmit='return checkRate()'> 
    <input type='hidden' name='delivery_id' value='" . $row['delivery_id'] . "'>      
    <input type='hidden' name='deliveryRate' id='deliveryRate' value=''>
    <span class='fa-solid fa-face-angry' onclick='setRate(1," . $row['delivery_id'] . ")' data-delivery-id='" . $row['delivery_id'] . "'></span>
    <span class='fa-solid fa-face-frown' onclick='setRate(2," . $row['delivery_id'] . ")' data-delivery-id='" . $row['delivery_id'] . "'></span>
    <span class='fa-solid fa-face-meh' onclick='setRate(3," . $row['delivery_id'] . ")' data-delivery-id='" . $row['delivery_id'] . "'></span>
    <span class='fa-solid fa-face-smile' onclick='setRate(4," . $row['delivery_id'] . ")' data-delivery-id='" . $row['delivery_id'] . "'></span>
    <span class='fa-solid fa-face-laugh-beam' onclick='setRate(5," . $row['delivery_id'] . ")' data-delivery-id='" . $row['delivery_id'] . "'></span>
    </td>
    </tr>
    </table>";
  }
}
?>

<script>
  let rateSelected = false;

  function setRate(deliveryRate, deliveryId) {
    rateSelected = true;

    // Reset all stars to default state
    var stars = document.querySelectorAll('.fa-solid[data-delivery-id="' + deliveryId + '"]');
    for (var i = 0; i < stars.length; i++) {
      stars[i].classList.remove("check");
    }

    // Set the selected stars to checked state
    for (var i = 0; i < deliveryRate; i++) {
      stars[i].classList.add("check");
    }

    // Set the rating value in the hidden input field
    document.getElementById("deliveryRate").value = deliveryRate;
  }

function checkRate() {
    if (!rateSelected) {
      alert("Please select a rating to delivery men");
      return false; // prevent form submission
    }

    return true; // allow form submission
  }

  //checkrating 
  
</script>

<button type="submit" style="margin-left: 800px;">submit</button>
</form>
</body>
</html>
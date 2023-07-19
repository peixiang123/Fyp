<!-- mycart.php -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="cart.css">
	<title>my cart</title>
	<?php
	include('customerheader.php');

if (isset($_POST['add_to_cart'])) {
    $foodId = $_POST['food_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'])) {
        // Check if the food item already exists in the cart
        $itemIndex = false;
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['food_id'] == $foodId) {
                $itemIndex = $index;
                break;
            }
        }

        if ($itemIndex !== false) {
            // Update the quantity of the existing item
            $_SESSION['cart'][$itemIndex]['quantity'] += $quantity;
        } else {
            // Add a new item to the cart
            $newItem = array(
                "food_id" => $foodId,
                "name" => $_POST['name'],
                "price" => $_POST['price'],
                "quantity" => $quantity,
            );
            $_SESSION['cart'][] = $newItem;
        }
    } else {
        // Add the first item to the cart
        $newItem = array(
            "food_id" => $foodId,
            "name" => $_POST['name'],
            "price" => $_POST['price'],
            "quantity" => $quantity,
        );
        $_SESSION['cart'][] = $newItem;
    }
}
?>
</head>
<body>
<div class="col-md-6">
  <h2 style= "margin-left:200px; font-size: 40px;"> item selected</h2>
  <?php

  $output = "";

  $output .= "
<table class = 'cart'>
<tr style='background-color:#87CEFA;'>
<th scope='col'>food ID</th>
<th scope='col'>name</th>
<th scope='col'>price</th>
<th scope='col'>quantity</th>
<th scope='col'>total price</th>
<th>action</th>
</tr>
  ";

if(!empty($_SESSION['cart'])){

  foreach($_SESSION['cart'] as $key => $value){

    $output .="
    <tr>
    <td>".$value['food_id']."</td>
    <td>".$value['name']."</td>
    <td>".$value['price']."</td>
    <td>".$value['quantity']."</td>
    <td>".number_format($value['price'] * $value['quantity'])."</td>
    <td>
<a href='mycart.php?action=remove&id=".$value['food_id']."'>
<button>remove</button>
</a>
</td>
";
$total_amount = 0;
foreach ($_SESSION['cart'] as $value) {
    $total_amount += $value['quantity'] * $value['price'];
}
}

$output .= "
<tr>
<td colspan='3'></td>
<td><b>Total amount</b></td>
<td>".number_format($total_amount,2)."</td>
<td>
<form action='order&orderdetail.php' method='post'>
<label>select your order type</label>
<select id='orderType' name='orderType' autofocus required>
        <option value= '' > - </option>
        <option value='dine in'>dine in</option>
        <option value='pick up'>pick up </option>
        <option value='delivery'>delivery </option>
      </select>
      <br>";

if (isset($_POST['orderType'])) {
    $output .= "<input type='hidden' name='orderType' value='" . $_POST['orderType'] . "'>";
}

$output .= "<input type='submit' id='btn' name='btn' value='make Order'>
</form>
</td>
</tr>
";
  }


if(isset($_GET['action']) && $_GET['action']=="remove" && isset($_GET['id'])){
  foreach($_SESSION['cart'] as $key => $value){
    if($value['food_id']==$_GET['id']){
      unset($_SESSION['cart'][$key]);
    }
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit();
}

if (isset($_POST['update_quantity'])) {
  foreach ($_SESSION['cart'] as &$item) {
    if ($item['food_id'] == $_POST['food_id']) {
      $item['quantity'] = $_POST['quantity'];
      break;
    }
  }
  header('Location: ' . $_SERVER['PHP_SELF']);
}

// Output the cart items
echo $output;
?>

<script>
  // Get the order type select element
  var orderTypeSelect = document.getElementById("orderType");
  
  // Get the delivery men selection div
  var deliveryMenSelection = document.getElementById("deliveryMenSelection");
  
  // Hide the delivery men selection by default
  deliveryMenSelection.style.display = "none";
  
  // Add an event listener to the order type select element
  orderTypeSelect.addEventListener("change", function() {
    // Show the delivery men selection if the selected value is "delivery"
    if (orderTypeSelect.value === "delivery") {
      deliveryMenSelection.style.display = "block";
    } else {
      deliveryMenSelection.style.display = "none";
    }
  });
</script>
</body>
</html>
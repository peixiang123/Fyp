<!-- order&orderdetail.php -->
<?php
session_start();
 include('runSQL.php');
if (isset($_SESSION['customer_id'])){
       $customer_id= $_SESSION['customer_id'];
}

if (isset($_POST['btn'])) {
    $total_price = 0;
    $total_amount = 0;
    $cart_data = $_SESSION['cart'];

     // Calculate the total price of the order
    foreach ($cart_data as $cart_item) {
        $total_amount += $cart_item['price']*$cart_item['quantity'] ;
    }
  
insert_orders($customer_id, $total_price, $total_amount, $cart_data);
}

   function insert_orders($customer_id, $total_price, $total_amount, $cart_data){
    global $conn;

    $orderType = $_POST['orderType'];
    $result2 = null;
    if($orderType == 'delivery'){
        $sql = "INSERT INTO orders (customer_id, orderDate, orderTime, day, orderType, total_amount, orderStatus, delStatus, feedback)
VALUES ('$customer_id', NOW(), NOW(), DAYNAME(NOW()), '$orderType', '$total_amount', 'waiting for payment', 'order will be deliver after make payment', null)";

        $result = mysqli_query($conn, $sql);
        $result2 = $result;

    } else{
        $sql2 = "INSERT INTO orders (customer_id, orderDate, orderTime, day, orderType, total_amount, orderStatus, delStatus, feedback)
VALUES ('$customer_id', NOW(), NOW(), DAYNAME(NOW()), '$orderType', '$total_amount', 'waiting for payment', null, null)";
        $result2 = mysqli_query($conn, $sql2);
    }
        if ($result2 OR $result) {
            // Get the ID of the new order
            $order_id = mysqli_insert_id($conn);
            // Insert the order details into the database
            //insert_order_details($order_id, $cart_data);

        



    // Insert each item in the cart into the order_items table
    foreach($cart_data as $cart_item){
        $food_id = $cart_item['food_id'];
        $name = $cart_item['name'];
        $total_price = $cart_item['price']*$cart_item['quantity'] ;
        $quantity = $cart_item['quantity'];
      

        $sql1 = "INSERT INTO order_detail (order_id, food_id, quantity, total_price) VALUES ('$order_id', '$food_id', '$quantity', '$total_price')";
        $result1 = mysqli_query($conn, $sql1);

        if (!$result1) {
                echo "<script>alert('Failed to insert order details.');</script>";
                return;
            }
        }
        echo "<script>alert('Order made. Please make the payment.');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0.2;URL=mycart.php\">";
        // Clear the cart
        unset($_SESSION['cart']);
    } else {
        echo "<script>alert('Failed to insert order.');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0.2;URL=mycart.php\">";
    }
  }

  ?>
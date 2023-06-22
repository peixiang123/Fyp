<!-- order.php -->
<?php 
session_start();
include "runSQL.php";
 
//make payment//
if (isset($_POST['order_id']) && isset($_POST['total_amount'])) {
   $order_id = $_POST['order_id'];
    $total_amount = $_POST['total_amount'];
    // Insert payment record
    $sql = "INSERT INTO payment (total, paymentType, paymentDate, order_id) VALUES ('$total_amount', 'online payment', NOW(), '$order_id' )";
    $result = mysqli_query($conn, $sql);
    
    // Update order status to "paid"
    $sql1 = "UPDATE orders SET orderStatus = 'paid' WHERE order_id = '$order_id'";
    $result1 = mysqli_query($conn, $sql1);

    $sql3 = "UPDATE orders SET delStatus = 'pending' WHERE order_id = '$order_id' AND orderType = 'delivery'";
    $result3 = mysqli_query($conn, $sql3);

     $sql2 = "UPDATE orders SET orderDate = NOW(), orderTime = NOW() WHERE order_id = '$order_id'";
    $result2 = mysqli_query($conn, $sql2);



    if($result && $result1 && $result3 && $result2)
    {
        echo "<script>alert('Payment successful.');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0.2;URL=myorder.php\">";
    }
    else
    {
        echo "<script>alert('Payment failed.');</script>";
        echo "<meta http-equiv=\"refresh\"content=\"0.2;URL=myorder.php\">";
    }
}

?>
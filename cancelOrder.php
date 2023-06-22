<?php 
session_start();
include "runSQL.php";

if (isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];
    $sql4="DELETE FROM order_detail WHERE order_id='$order_id'";
    $result4 = mysqli_query($conn, $sql4);

    echo "<script>alert('successful cancel order.');</script>";
    echo "<meta http-equiv=\"refresh\"content=\"0.2;URL=myorder.php\">";
}
?>
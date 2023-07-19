<!-- myorder.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>order history</title>
    <?php include('customerheader.php'); 
?>
</head>
<body>
    <h1 style="margin-left:200px;">Order History</h1>
    <table class="order">
        <tr style="border: 2px solid black; padding:10px; background-color:#FFD700;">
            <th style="padding:10px;">Order ID</th>
            <th>Order Date</th>
            <th style="padding:10px;">Order Type</th>
            <th>Food and quantity</th>
            <th style="padding:10px;">Total Amount</th>
            <th>Order Status</th>
            <th>Delivery Status</th>
            <th>PAY HERE~~</th>
        </tr>
        <?php
        $sql = "SELECT o.feedback, o.order_id, o.orderDate, o.orderType, SUM(od.quantity) AS total_quantity, 
                        GROUP_CONCAT(CONCAT(f.name, '&nbsp;x ', od.quantity, ' &nbsp;&nbsp; RM ', f.price) SEPARATOR '<br>--------------------------<br>') AS foods, 
                        o.total_amount, o.orderStatus, o.delStatus
                    FROM orders o 
                    JOIN order_detail od ON o.order_id = od.order_id 
                    JOIN food f ON f.food_id = od.food_id 
                    WHERE o.customer_id = $customer_id 
                    AND (o.orderStatus = 'paid' AND o.delStatus = 'Done') 
                    OR (o.orderStatus = 'paid' AND o.delStatus IS null)  
                    GROUP BY o.order_id
                    ORDER BY o.feedback ASC";


        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr style='border: 2px solid black;'>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td>" . $row['orderDate'] . "</td>";
            echo "<td style='background-color:#FAFAD2;'>" . $row['orderType'] . "</td>";
            echo "<td>" . $row['foods'] . "</td>";
            echo "<td>" . $row['total_amount'] . "</td>";
            echo "<td style='background-color:#FAFAD2;'>" . $row['orderStatus'] . "</td>";
            echo "<td style='background-color:#FAFAD2;'>" . $row['delStatus'] . "</td>";
             // Display payment button for "waiting for payment" status

    if ($row['feedback'] == 'Done') {
            echo "<td>Thank you for chosing us. <br><span style='font-size:30px;'>^•ﻌ•^っ💕</span></td>";
        } 
    else{
        echo "<td>Hi, May you give us a feedback? &nbsp;&nbsp;&nbsp;<a class='feedback' href='feedback.php?order_id=".$row['order_id']."'>give feedback</a></td>";
    }      
            echo "</tr>";
        }
        ?>
    </table>


</body>
</html>
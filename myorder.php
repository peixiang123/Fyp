<!-- myorder.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>my order</title>
    <?php include('customerheader.php'); 
?>
</head>
<body>
    <h1 style="margin-left:200px;">order list</h1>
    <table class="order">
        <tr style="border: 2px solid black; padding:10px; background-color:#FFD700;">
            <th style="padding:10px;">Order ID</th>
            <th>Order Date</th>
            <th style="padding:10px;">Order Type</th>
            <th>Food and quantity</th>
            <th style="padding:10px;">Total Amount</th>
            <th>Order Status</th>
            <th>Delivery Status</th>
            <th style="width: 15%;">PAY HERE~~</th>
        </tr>
        <?php
        $sql = "SELECT o.order_id, o.orderDate, o.orderType, SUM(od.quantity) AS total_quantity, 
                        GROUP_CONCAT(CONCAT(f.name, '&nbsp;x ', od.quantity, ' &nbsp;&nbsp; RM ', f.price) SEPARATOR '<br>--------------------------<br>') AS foods, 
                        o.total_amount, o.orderStatus, o.delStatus
                    FROM orders o 
                    JOIN order_detail od ON o.order_id = od.order_id 
                    JOIN food f ON f.food_id = od.food_id 
                    WHERE o.customer_id = $customer_id 
                    AND o.orderStatus = 'waiting for payment'
                    OR o.delStatus != 'Done'
                    GROUP BY o.order_id, o.delStatus
                    ORDER BY o.orderDate desc";


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

    if ($row['orderStatus'] == 'waiting for payment') {
            echo "<td style='border: 2px solid black; padding: 10px;'><button onclick='myFunction(" . $row['order_id'] . "," .$row['total_amount'].")'>Make Payment</button>
            <button onclick='cancelOrder(" . $row['order_id'] . ")'>cancel order</button></td>";
    }
    else if($row['delStatus'] == 'pending'){
            echo "<td>your order has been send to the delivery men</td>";
            
    }
    else if($row['delStatus'] == 'delivering'){
            echo "<td>delivery men is delivering your order~</td>";
    }  
    else{
        echo "<td>you have already paid the order, thank you. ^^ &nbsp;&nbsp;&nbsp;<a class='feedback' href='feedback.php?order_id=".$row['order_id']."'>give feedback</a></td>";
    }      
            echo "</tr>";
        }
        ?>
    </table>
    <script>
function myFunction(order_id, total_amount) {
  var confirmed = confirm("do you want to make payment on for order ID : " + order_id + " with total amount of " + total_amount + "?");
  if (confirmed) {
    // Submit the form with the corresponding order ID and total amount
    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'order.php');
    document.body.appendChild(form);

    var input_order_id = document.createElement('input');
    input_order_id.setAttribute('type', 'hidden');
    input_order_id.setAttribute('name', 'order_id');
    input_order_id.setAttribute('value', order_id);
    form.appendChild(input_order_id);

    var input_total_amount = document.createElement('input');
    input_total_amount.setAttribute('type', 'hidden');
    input_total_amount.setAttribute('name', 'total_amount');
    input_total_amount.setAttribute('value', total_amount);
    form.appendChild(input_total_amount);

    form.submit();
  }
}

function cancelOrder(order_id) {
  var confirmed = confirm("do you want to cancel order ID : " + order_id + "?");
  if (confirmed) {
    // Submit the form with the corresponding order ID and total amount
    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'cancelOrder.php');
    document.body.appendChild(form);

    var input_order_id = document.createElement('input');
    input_order_id.setAttribute('type', 'hidden');
    input_order_id.setAttribute('name', 'order_id');
    input_order_id.setAttribute('value', order_id);
    form.appendChild(input_order_id);

    form.submit();
  }
}
</script>


</body>
</html>
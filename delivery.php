<!-- delivery.php -->
<?php
include('runSQL.php');
include('workerpage.php');

// Check if the worker's profession is "delivery men"
$worker_id = $_SESSION['worker_id'];
$query = "SELECT * FROM worker WHERE worker_id = '$worker_id' AND (profesison = 'delivery men' OR profesison = 'manager')";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    echo "<p style='font-size: 50px; color: #A52A2A; margin-top:200px; margin-left:350px; font-family:Fantasy;'>You are not authorized to access this page.</p>";
    //header("Location: workerpage.php");
    exit();
} 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delivery Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div class="container">
        <aside class="left-sidebar">
    <h1 style="margin-left:2px; background-color: white; margin-right: 600px;">order list</h1><br>
    <table>
        <tr>
            <th style='padding:10px;'>Order ID</th>
            <th>Order Date</th>
            <th>Order Time</th>
            <th>Customer Name</th>
            <th style ="width:400px;">Food and quantity</th>
            <th>Total Amount</th>
            <th>action</th>
        </tr>

         <?php
        $sql = "SELECT o.order_id, o.orderDate, o.orderTime, c.custName, SUM(od.quantity) AS total_quantity, 
                         GROUP_CONCAT(CONCAT(f.name, '&nbsp;&nbsp;x', od.quantity, '<br>RM', f.price) SEPARATOR '<br>---------<br>') AS foods,
                         o.total_amount
                     FROM orders o 
                     JOIN order_detail od ON o.order_id = od.order_id 
                     JOIN food f ON f.food_id = od.food_id 
                     JOIN customer c ON o.customer_id = c.customer_id
                     WHERE o.delStatus = 'pending'
                     GROUP BY o.order_id, o.orderDate, o.orderTime, c.custName, o.total_amount
                    ORDER BY o.orderDate ASC";

                     $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<form id='deliver-form' action='deliver.php' method='post'>";
            echo "<tr>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
            echo "<td>" . $row['orderDate'] . "</td>";
            echo "<td>" . $row['orderTime'] . "</td>";
            echo "<td>" . $row['custName'] . "</td>";
            echo "<td style='padding:10px;'>" . $row['foods'] . "</td>";
            echo "<td>" . $row['total_amount'] . "</td>";
             echo "<td><button onclick='deliverOrder(" . $row['order_id'] . ")'>deliver</button></td>"; 
             echo "</tr>";
            echo "</form>";
            
        }
        ?>
    </table>
       </aside>
   
<script>
        function deliverOrder(order_id) {
            // Get the form and set the order_id value
            var form = document.getElementById("deliver-form");
            var order_id_input = form.querySelector("input[name='order_id']");
            order_id_input.value = order_id;

            // Submit the form
            form.submit();
            
        }
    </script>
 <aside class="right-sidebar">
            <h2 style="margin-left: 90px;background-color: white; margin-right: 500px;">Delivery History</h2><br>
            <table>
                <tr style="border: 2px solid black;">
            <th>Order ID</th>
            <th>delivery Date</th>
            <th>Customer Name</th>
            <th>Total Amount</th>
            <th>deliver worker</th>
            <th>Action</th>
        </tr>
        <?php
        $sql1="SELECT d.order_id, d.delName, d.deliveryDate, c.custName, o.total_amount
        FROM delivery d JOIN orders o ON d.order_id = o.order_id
        JOIN customer c ON c.customer_id = o.customer_id
        WHERE d.worker_id = $worker_id
        AND o.delStatus = 'delivering'
        GROUP BY d.deliveryDate asc";
        $result1 = mysqli_query($conn, $sql1);

         while ($row = mysqli_fetch_assoc($result1)) {
            echo "<form id='deliver2-form' action='deliver2.php' method='post'>";
    echo "<tr>";
    echo "<td>" . $row['order_id'] . "</td>";
    echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
    echo "<td style='padding:20px;'>" . $row['deliveryDate'] . "</td>";
    echo "<td>" . $row['custName'] . "</td>";
    echo "<td>" . $row['total_amount'] . "</td>";
    echo "<td>" . $row['delName'] . "</td>";
    echo "<td><button onclick='doneDeliver(" . $row['order_id'] . ")'>Done</button></td>";
    echo "</tr>";
     echo "</form>";
}
     ?>
            </table>
        </aside>
    </div>
    <script>
        function doneDeliver(order_id) {
    // Get the form and set the order_id value
    var form = document.getElementById("deliver2-form");
    var order_id_input = form.querySelector("input[name='order_id']");
    order_id_input.value = order_id;

    // Submit the form
    form.submit();
}

    </script>
   
</body>
</html>

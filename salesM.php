<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style type="text/css">
        h1 {
    margin-left: 50px;
    background-color: white;
    display: inline-block;
  }

    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monthly Sales</title>
    <?php
    include('workerpage.php');

    // Check if form is submitted
    if (isset($_POST['orderDate'])) {
        $orderDate = $_POST['orderDate'];

        $sql = "SELECT * FROM orders WHERE orderDate LIKE '%$orderDate%'";
        $result = mysqli_query($conn, $sql);

         // Calculate total daily sales
        $total_sales = 0;
    }
    ?>
</head>
<body>
    <a class="sales" href="salesM.php">daily sales</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="sales" href="salesW.php">weekly sales</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="sales" href="salesMon.php">monthly sales</a>

    <h1 style="margin-left: 200px;">Daily Sales</h1>

    <form method="POST">
        <label style="margin-left: 200px;">Date</label>
        <input type="date" name="orderDate" />
        <input type="submit" value="check">
        <br><br>
    </form>

    <table>
        <thead>
            <tr>
                <th>order_id</th>
                <th>orderDate</th>
                <th>orderTime</th>
                <th>total_amount</th>

            </tr>
        </thead>
        <?php

        if (isset($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $total_sales += $row['total_amount'];
                echo "<tr>";
                echo "<td>" . $row['order_id'] . "</td>";
                echo "<td>" . $row['orderDate'] . "</td>";
                echo "<td>" . $row['orderTime'] . "</td>";
                echo "<td>" . $row['total_amount'] . "</td>";
                echo "</tr>";
            }
            echo "<tr>";
                echo "<td colspan='3'>Daily Total Sales</td>";
                echo "<td>".number_format($total_sales,2)."</td>";
                echo "</tr>";
        }
        ?>
    </table>

</body>
</html>

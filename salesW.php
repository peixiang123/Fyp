<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Weekly Sales</title>
    <style type="text/css">
        h1 {
    margin-left: 50px;
    background-color: white;
    display: inline-block;
  }
  canvas{
    margin-left: 200px; 
    width:100%;
    max-width:600px;
    background-color: #f2f2f2; 
    padding: 20px;

  }
  
    </style>
    <?php
    include('workerpage.php');

    // Check if form is submitted
    if (isset($_POST['orderDate'])) {
        $orderDate = $_POST['orderDate'];

        $sql = "SELECT orderDate, day, orderTime, SUM(total_amount) AS daily_sales
         FROM orders
         WHERE YEARWEEK(orderDate) = YEARWEEK('$orderDate')
         GROUP BY DATE(orderDate)";
        $result = mysqli_query($conn, $sql);


        $sql1="SELECT orderDate, day, orderTime, SUM(total_amount) AS daily_sales
         FROM orders
         WHERE YEARWEEK(orderDate) = YEARWEEK('$orderDate')
         GROUP BY DATE(orderDate)";
$result1 = mysqli_query($conn, $sql1);
    }

    ?>
</head>
<body>
    <a class="sales" href="salesM.php">daily sales</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="sales" href="salesW.php">weekly sales</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="sales" href="salesMon.php">monthly sales</a>

    <h1 style="margin-left: 200px;">Weekly Sales</h1>

    <form method="POST">
        <label style="margin-left: 200px;">Date</label>
        <input type = "date" name = "orderDate" />
        <input type="submit" value="check">
    </form>

    <table>
        <thead>
            <tr>
                <th>Order Date</th>
                <th>Order Time</th>
                <th>Day</th>
                <th>daily sales</th>

            </tr>
        </thead>
        <?php

        if (isset($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['orderDate'] . "</td>";
                echo "<td>" . $row['orderTime'] . "</td>";
                echo "<td>" . $row['day'] . "</td>";
                echo "<td>" . $row['daily_sales'] . "</td>";
                echo "</tr>";
            }
            
        }
        ?>
    </table>
    <br><br>
<canvas id="weekChart" ></canvas>


<script>
var xValues = [];
var yValues = [];
var barColors = ["red","lightgreen","blue","orange","brown","yellow","purple","green","pink","lightblue"];

<?php
  while ($row = mysqli_fetch_assoc($result1)) {
    echo "xValues.push('" . $row['orderDate'] . "  " . $row['day'] . "');";
    echo "yValues.push(" . $row['daily_sales'] . ");";
  }
  ?>

new Chart("weekChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "weekly sales"
    }
  }
});
</script>
</body>
</html>

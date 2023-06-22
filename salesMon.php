<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Monthly Sales</title>
    <style type="text/css">
        h1 {
    margin-left: 200px;
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

        $sql = "SELECT DATE_FORMAT(orderDate, '%m-%Y') AS month,
       SUM(total_amount) AS monthly_sales
FROM orders
WHERE DATE_FORMAT(orderDate, '%m-%Y') = '$orderDate'
GROUP BY DATE_FORMAT(orderDate, '%m-%Y')";
        $result = mysqli_query($conn, $sql);

         // Calculate total daily sales
        $total_sales = 0;

        $sql1="SELECT orderDate, day, SUM(total_amount) AS daily_sales
                FROM orders
                WHERE DATE_FORMAT(orderDate, '%m-%Y') = '$orderDate'
                GROUP BY DATE(orderDate)
            ";
            $result1 = mysqli_query($conn, $sql1);
    }
    ?>
</head>
<body>
    <a class="sales" href="salesM.php">daily sales</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="sales" href="salesW.php">weekly sales</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="sales" href="salesMon.php">monthly sales</a>

    <h1 style="margin-left: 200px;">Monthly Sales</h1>

    <form method="POST">
        <label style="margin-left: 200px;">Date</label>
        <select id='orderDate' name='orderDate' autofocus required>
        <option value= '' > - </option>
        <option value='05-2023'>May</option>
        <option value='06-2023'>June</option>
        <option value='07-2023'>July</option>
      </select>
        <input type="submit" value="check">
    </form>

    <table>
        <thead>
            <tr>
                
                <th>Month</th>
                <th>total_amount</th>

            </tr>
        </thead>
        <?php

        if (isset($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['month'] . "</td>";
                echo "<td>" . $row['monthly_sales'] . "</td>";
                echo "</tr>";
            }
            }
        ?>
    </table>
    <br><br>
<canvas id="MonChart"></canvas>

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

new Chart("MonChart", {
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
      text: "Monthly sales"
    }
  }
});
</script>

</body>
</html>

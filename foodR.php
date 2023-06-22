<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Food Rating Report</title>
  <?php
include('workerpage.php');
?>
<style type="text/css">
  canvas {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
h1 {
    margin-left: 50px;
    background-color: white;
    display: inline-block;
  }

  .container {
      display: flex;
      justify-content: space-between;
    }

    .left-sidebar canvas{
      margin-left:50px;
      width: 600px;
      height: 520px;
    }
    .right-sidebar canvas{
      margin-left:50px;
      height: 520px;
      width: 600px;
    }

    
</style>

</head>
<body>
  <div class="container">
  <aside class="left-sidebar">
  <h1 >Top10 Best Sales Foods</h1>
  <canvas id="foodChart" ></canvas><br>
<?php
$sql="SELECT f.food_id, f.name, SUM(od.quantity) AS total_quantity
FROM food f
JOIN order_detail od ON f.food_id = od.food_id
GROUP BY f.food_id, f.name
ORDER BY total_quantity DESC
limit 5;";
$result = mysqli_query($conn, $sql);
?>

<script>
var xValues = [];
var yValues = [];
var barColors = ["red","lightgreen","blue","orange","brown","yellow","purple","green","pink","lightblue"];

<?php
  while ($row = mysqli_fetch_assoc($result)) {
    echo "xValues.push('" . $row['name'] . "');";
    echo "yValues.push(" . $row['total_quantity'] . ");";
  }
  ?>

new Chart("foodChart", {
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
      text: "Top10 Sales Foods"
    }
  }
});
</script>

<h1 >Top10 Best Reputation Foods</h1>
  <canvas id="foodChart2" ></canvas><br>
<?php
$sql="SELECT * FROM food ORDER BY avg_rate  desc limit 10";
$result = mysqli_query($conn, $sql);
?>

<script>
var xValues = [];
var yValues = [];
var barColors = ["red","lightgreen","blue","orange","brown","yellow","purple","green","pink","lightblue"];

<?php
  while ($row = mysqli_fetch_assoc($result)) {
    echo "xValues.push('" . $row['name'] . "');";
    echo "yValues.push(" . $row['avg_rate'] . ");";
  }
  ?>

new Chart("foodChart2", {
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
      text: "Top10 Sales Foods"
    }
  }
});
</script>
</aside>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<aside class="right-sidebar">
<h1 >The Most Reputation category</h1>
  <canvas id="foodChart3"></canvas><br>
<?php
$sql="SELECT c.categoryName, f.category_id, COUNT(*) AS category_count
FROM (
    SELECT *
    FROM food
    ORDER BY avg_rate DESC
    
) AS top_foods
JOIN food f ON top_foods.food_id = f.food_id
JOIN category c ON c.category_id = f.category_id
GROUP BY f.category_id
ORDER BY category_count DESC;";
$result = mysqli_query($conn, $sql);
?>

<script>
var xValues = [];
var yValues = [];
var barColors = ["red","lightgreen","blue","orange","brown","yellow","purple","green","pink","lightblue"];

<?php
  while ($row = mysqli_fetch_assoc($result)) {
    echo "xValues.push('" . $row['categoryName'] . "');";
    echo "yValues.push('" . $row['category_count'] . "');";
  }
  ?>

new Chart("foodChart3", {
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
      text: "Top10 Sales Foods"
    }
  }
});
</script>

<h1 >The Best Sales category</h1>
  <canvas id="foodChart4" ></canvas><br>
<?php
$sql="SELECT c.categoryName, f.category_id, COUNT(*) AS category_count
FROM (
    SELECT *
    FROM order_detail
    ORDER BY quantity DESC
    LIMIT 10
) AS top_quantity
JOIN food f ON top_quantity.food_id = f.food_id
JOIN category c ON c.category_id = f.category_id
JOIN order_detail od ON od.food_id = f.food_id
GROUP BY f.category_id
ORDER BY category_count DESC";
$result = mysqli_query($conn, $sql);
?>

<script>
var xValues = [];
var yValues = [];
var barColors = ["red","lightgreen","blue","orange","brown","yellow","purple","green","pink","lightblue"];

<?php
  while ($row = mysqli_fetch_assoc($result)) {
    echo "xValues.push('" . $row['categoryName'] . "');";
    echo "yValues.push('" . $row['category_count'] . "');";
  }
  ?>

new Chart("foodChart4", {
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
      text: "Top10 Sales Foods"
    }
  }
});
</script>
</aside>
</div>
</body>
</html>
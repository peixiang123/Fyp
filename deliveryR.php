<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Delivery Men Rating Report</title>
  <?php
include('workerpage.php');
?>
<style type="text/css">
  canvas {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>

</head>
<body>
  <h1 style="margin-left:50px;">Top5 Best Rating Delivery Men</h1>
  <canvas id="foodChart" style="height:250px;width:100%;max-width:600px;margin-left:50px;"></canvas>
<?php
$sql="SELECT * FROM worker WHERE profesison = 'delivery men' ORDER BY delRate_avg desc limit 5";
$result = mysqli_query($conn, $sql);
?>

<script>
var xValues = [];
var yValues = [];
var barColors = ["red","lightgreen","blue","orange","brown","yellow","purple","green","pink","lightblue"];

<?php
  while ($row = mysqli_fetch_assoc($result)) {
    echo "xValues.push('" . $row['workName'] . "');";
    echo "yValues.push(" . $row['delRate_avg'] . ");";
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
      text: "Top5 best delivery men"
    }
  }
});
</script>

</body>
</html>
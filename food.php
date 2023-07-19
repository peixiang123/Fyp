
<!-- drink.php -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
.orange-star {
  color: orange;
}
</style>
  <title>insert category</title>
</head>
<body>
<?php
include('customerheader.php');

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT food_id, name, price, food_image, avg_rate FROM food WHERE category_id = $category_id";
    $result = mysqli_query($conn, $sql);
?> 
   
  <table style="width:100% position: right; border-collapse: collapse;">
  <thead style='background-color:#D3D3D3;'>
    <tr>
    <th>no</th>
    <th>image</th>
    <th>name</th>
    <th>price</th>
    <th>quantity</th>

  </tr>
</thead>
    <?php 

// Output food data in HTML format
$counter = 1;
while ($row = mysqli_fetch_assoc($result)) {
 echo "<form method='post' action='mycart.php?customer_id={$customer_id}'>";
  echo "<tr>";
   echo "<td>" . $counter . "</td>";
   echo "<td><img src='" . $row['food_image'] . "' alt='" . $row['name'] . "' style='width:100px; height:90px;'><br>
    <span class='fa fa-star orange-star'></span> " . $row['avg_rate'] . "
   </td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['price'] . "</td>";
  echo "<input type='hidden' name='food_id' value='{$row['food_id']}'/>";
  echo "<input type='hidden' name='price' value='{$row['price']}'/>";
  echo "<input type='hidden' name='name' value='{$row['name']}'/>";

  ?>
  <td>
    <input type="number" name="quantity" id="quantity" value="1" min="1" class="form-control">
    <input type="submit" name="add_to_cart" value="Add to Cart">


  </td>
</form>
  <?php
  echo "</tr>";
  $counter++;
}
echo "</table>";
}
?>

</body>
</html>
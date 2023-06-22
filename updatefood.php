<!-- updatefood.php -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>update food</title>
  <link rel="stylesheet" href="style2.css">
  <?php include('workerpage.php') ?>
</head>
<body>
  <form class="search" method="GET">
    <input class="text" style="margin-left: 200px;" type="text" name="search" placeholder="Search food's name">
    <input style="margin-left: 200px;" class="search-button" type="submit" value="Search">
  </form>
  <table style="position: right; border-collapse: collapse; margin-top: 10px;">
    <thead>
      <tr>
        <th>food_id</th>
        <th>category_id</th>
        <th>name</th>
        <th>price</th>
        <th>food_image</th>
        <th>update</th>
      </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM food";
    if (isset($_GET['search']) && !empty($_GET['search'])) {
      $search = $_GET['search'];
      $sql = " SELECT * FROM food WHERE name LIKE '%$search%'";
    }
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['food_id']."</td>";
        echo "<td>".$row['category_id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['price']."</td>";
        echo "<td><img src='" . $row['food_image'] . "'style='width:100px; height:90px;'></td>";
        echo "<td><button onclick=\"window.open('updatefood2.php?food_id=" . $row['food_id'] . "', 'google', 'width=600,height=500')\">update</button></td>";
        echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='6'>No matching results found.</td></tr>";
    }
    ?>
  </table>
</body>
</html>

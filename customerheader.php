  <!-- customerheader.php -->
  <?php 
  session_start();
  include('runSQL.php');
if (isset($_SESSION['customer_id'])){
       $customer_id= $_SESSION['customer_id'];
}
  ?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>main page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
<div>
  
<nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo" style="font-family: cursive;"><img src=""> Meow Meow Cafe</label>
      <ul>
    <li>
      <?php 
            
            echo "<p style='color: yellow; font-size: 17px; padding: 7px 13px; border-radius: 3px; text-transform: uppercase; font-family: cursive;'>Welcome, " . $_SESSION['custName'];
            
            
            ?></li>
        <li><a class="active" href="customerheader.php">Menu</a></li>
        <li><a href="myorder.php">My order</a></li>
        <li><a href="orderhistory.php">Order History</a></li>
        <li><a href="mycart.php">My cart</a></li>

    <div class="sidenav">
      
      <?php 
            $sql = "SELECT * FROM category ORDER BY categoryName";
            $result = mysqli_query($conn, $sql);

            $data = array();  // 用于存储分组数据的数组

            if (mysqli_num_rows($result) > 0) {
                // 分组并存储数据
                while($row = mysqli_fetch_assoc($result)) {
                    $categoryName = $row["categoryName"];
                    if (!array_key_exists($categoryName, $data)) {
                        $data[$categoryName] = array();
                    }
                    array_push($data[$categoryName], $row);
                }

                // 输出数据
                foreach ($data as $categoryName => $rows) {
                    $category_id = $rows[0]['category_id'];
                    echo "<a href='$categoryName.php?category_id=$category_id'>$categoryName</a>";
                }
                
              }
         ?>
      </ul>
    </nav>
  </p>
</li>
</ul>
</nav>
</div>
</body>
</html>
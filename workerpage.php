<!-- workerpage.php -->
<!DOCTYPE html>
<html>
<head>
  <?php 
   session_start();
  include('runSQL.php');
 
  if (isset($_SESSION['worker_id'])){
       $worker_id= $_SESSION['worker_id'];
}
  ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>main page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="tableW.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    </head>
<body>

  
<nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo" style="font-family: cursive;"> ADMIN PAGE</label>
      <ul>
      <li>
      <?php
           
            echo "<p style='color: yellow; font-size: 17px; padding: 7px 13px; border-radius: 3px; text-transform: uppercase; font-family: cursive;'>".$_SESSION['workName']."  Worker</p>";
         ?>
            </li>
            <li>
            <div class="dropdown">
    <button class="dropbtn">food content
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="insertcategory.php">insert category</a>
      <a href="insertfood.php">insert new food</a>
      <a href="updatefood.php">update food</a>
    </div>
  </div>
  </li> 
        <li><a href="delivery.php?worker_id=<?php echo $_SESSION['worker_id']; ?>">Delivery order</a></li>
        <li><div class="dropdown">
    <button class="dropbtn">Order History
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="orderhistoryW.php">Normal Orders</a>
      <a href="canceledorder.php">Canceled Orders</a>
    </div>
  </div></li>
    <li>
        <div class="dropdown">
    <button class="dropbtn">Report 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="foodR.php">Food rating Report</a>
      <a href="deliveryR.php">delivery men rating report</a>
      <a href="salesM.php">sales</a>
    </div>
  </div>
</li>
<li><a href="workerReg.php">worker register</a></li>
      </ul>
    </nav>
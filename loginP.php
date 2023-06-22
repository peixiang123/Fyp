<?php

include('runSQL.php');

$name2 =$_POST['name2'];
$pass =$_POST['pass'];

if(isset($name2) AND isset($pass))
{
  $sql = "SELECT * FROM customer WHERE custName = '$name2' AND pass = '$pass'";
  $result = mysqli_query($conn,$sql);

    $sql1 = "SELECT * FROM worker WHERE workName = '$name2' AND paass = '$pass'";
  $result1 = mysqli_query($conn,$sql1);

  if(mysqli_num_rows($result) > 0)
  {
    session_start();
    $row = mysqli_fetch_assoc($result);
    $_SESSION['custName'] = $row['custName'];
    $_SESSION['customer_id'] = $row['customer_id'];
    ?>

    <script type='text/javascript'>window.location.href = 'customerheader.php'</script>


    <?php
  }
  else if(mysqli_num_rows($result1) > 0)
  {
    session_start();
    $row1 = mysqli_fetch_assoc($result1);
    $_SESSION['workName'] = $row1['workName'];
    $_SESSION['worker_id'] = $row1['worker_id'];
    $_SESSION['phone'] = $row1['phone'];


    ?>

    <script type='text/javascript'>window.location.href = 'workerpage.php'</script>


    <?php
  }
  else
  {
    echo "<script type='text/javascript'>alert('No data found !')</script>";
    echo "<meta http-equiv=\"refresh\"content=\"0.2;URL=login.php\">";
  }
}

?>
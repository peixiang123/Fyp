<!-- workerIDcheck.php -->
<?php
include('runSQL.php');


$worker_id =$_POST['worker_id'];

if(isset($worker_id))
{
  $sql = "SELECT * FROM worker WHERE worker_id = '$worker_id' AND profesison = 'delivery men'";
  $result = mysqli_query($conn,$sql);

  if(mysqli_num_rows($result) > 0)
  {
    $row = mysqli_fetch_assoc($result);
    // worker is authorized to access the page
  }
  else{
    echo 'You are not able to access this page';
  }
}
?>

<?php 
session_start();
include "runSQL.php";

$category_id = $_POST['category_id'];
$name = $_POST['name'];
$price = $_POST['price'];
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if image file is a actual image or fake image
if(isset($_FILES["fileToUpload"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    
    $uploadOk = 1;
  } else {
    
    $uploadOk = 0;
  }
}

$sql = "SELECT name from food where name = '$name';";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

if($row['name'] == $name) {  
    echo "<script>alert('The food is already exist.');</script>";
    echo"<meta http-equiv='refresh' content='0; url=insertfood.php'/>";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql1 = "INSERT INTO food (category_id, name, price, food_image) VALUES ('$category_id', '$name', '$price', '$target_file');";
        $res = mysqli_query($conn,$sql1);  
        echo "<script>alert('food successful insert.');</script>";
        echo"<meta http-equiv='refresh' content='0; url=workerpage.php'/>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

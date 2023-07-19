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
    $fileTmp = $_FILES["fileToUpload"]["tmp_name"];
    if(!empty($fileTmp)) {
        $check = getimagesize($fileTmp);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('Invalid image format. Please upload a valid image file.');</script>";
            echo "<meta http-equiv='refresh' content='0; url=insertfood.php'/>";
            exit; // Terminate the script execution
        }
    } else {
        echo "<script>alert('Please select a file to upload.');</script>";
        echo "<meta http-equiv='refresh' content='0; url=insertfood.php'/>";
        exit; // Terminate the script execution
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
        $sql = "CALL insert_food('$category_id', '$name', '$price', '$target_file')";  
        if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Food successfully inserted.');</script>";
        echo "<meta http-equiv='refresh' content='0; url=workerpage.php'/>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }  
    
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

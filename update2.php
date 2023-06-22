<?php 
session_start();
include "runSQL.php";

if (isset($_POST['food_id'])) {
    $food_id = $_POST['food_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Check if a new image file was uploaded
    if ($_FILES["fileToUpdate"]["error"] === UPLOAD_ERR_OK) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpdate"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $target_file);
        $imageExtension = strtolower(end($imageExtension));
        
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "
            <script>
                alert('Invalid Image Extension');
            </script>";
        } else {
            move_uploaded_file($_FILES["fileToUpdate"]["tmp_name"], $target_file);
            $query = "UPDATE food SET name = '$name', price = '$price', food_image = '$target_file' WHERE food_id = '$food_id'";
            mysqli_query($conn, $query);
            echo "
            <script>
                alert('Successfully Updated');
            </script>";
        }
    } else {
        // No new image was uploaded, update the record without changing the image
        $query = "UPDATE food SET name = '$name', price = '$price' WHERE food_id = '$food_id'";
        mysqli_query($conn, $query);
        echo "
        <script>
            alert('Successfully Updated');
        </script>";
    }
}
?>

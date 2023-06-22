<!-- updatefood2.php -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>update food</title>
	<style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color:#DCDCDC;
    background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 700px;
    width: 400px;
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 52%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 20px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}
form h1{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
    font-family: cursive;

}
font-family: cursive;

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}

input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
select {
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
    color: #e5e5e5; /* Text color */
}

select option {
    color: #ffffff; /* Option text color */
    background-color:black ;
}

select:focus {
    outline: none;
    border-color: #ffffff; /* Focus border color */
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}
</style>
	<?php include ('runSQL.php') ;

	// 获取要更新的食品的数据
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM food WHERE food_id = '$food_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>
</head>
<body>
	<div id="frm">
		<form action= "update2.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
			<p>
				<label>food ID</label>
				<input type="text" value="<?php echo $row['food_id']; ?>" id="food_id" name="food_id" readonly style="background-color: #DCDCDC;">

		 
			</p>
			<p>
				<label>category ID</label>
				<input type="text" value = "<?php echo $row['category_id']?>" id="category_id" name="category_id" autofocus required>
		 
			</p>
			<p>
				<label>updated food name</label>
				<input type="text" value = "<?php echo $row['name']?>" id="name" name="name" autofocus required>
			</p>
			<p>
				<label>update price</label>
				<input type="text" value = "<?php echo $row['price']?>" id="price" name="price" autofocus required>
			</p>
			<p>
				<label>Select image to update:</label>
				<input type="file" name="fileToUpdate" id="fileToUpdate">
			</p>
			<img src="<?php echo $row['food_image']; ?>" width="100">
			<p>
				<button>UPDATE</button>
			</p>
		
		</form>
	</div>
</body>
</html>
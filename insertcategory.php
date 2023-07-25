<!DOCTYPE html>
<html>
<head>
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
    height: 400px;
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>insert category</title>
</head>
<body>
<?php
include('workerpage.php');

// Check if the worker's profession is "delivery men"
$worker_id = $_SESSION['worker_id'];
$query = "SELECT * FROM worker WHERE worker_id = '$worker_id' AND (profesison = 'cafe worker' OR profesison = 'manager')";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
    echo "<p style='font-size: 50px; color: #A52A2A; margin-top:200px; margin-left:350px; font-family:Fantasy;'>You are not authorized to access this page.</p>";
    //header("Location: workerpage.php");
    exit();
}
?>

<div id="frm">
		<form action= "insert.php" method="post">
			<p>
				<label>new category name</label>
				<input type="text" id="categoryName" name="categoryName" autofocus required>
			</p>
			<p>
				<label>description</label>
				<input type="text" id="desctiption" name="desctiption" autofocus required>
			</p>
			<p>
				<button>INSERT</button>
			</p>
			</form>
		</div>
</body>
</html>
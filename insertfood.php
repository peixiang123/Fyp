<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>insert category</title>
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
</head>
<body>
<?php
include('workerpage.php');
?>

<div id="frm">
		<form action= "insert2.php" method="post" enctype="multipart/form-data">
			<p>
				<label>category ID</label>
				<select id="category_id" name="category_id" autofocus required>
					<option value= "" > - </option>
				<?php 
            $sql = "SELECT * FROM category ORDER BY category_id";
            $result = mysqli_query($conn, $sql);

            $data = array();  // 用于存储分组数据的数组

            if (mysqli_num_rows($result) > 0) {
                // 分组并存储数据
                while($row = mysqli_fetch_assoc($result)) {
                    $category_id = $row["category_id"];
                    if (!array_key_exists($category_id, $data)) {
                        $data[$category_id] = array();
                    }
                    array_push($data[$category_id], $row);
                }

                // 输出数据
                foreach ($data as $category_id => $rows) {
			    $first_row = array_values($rows)[0];
			    $categoryName = $first_row['categoryName'];
			    echo "<option value='".$category_id."'>".$category_id." ".$categoryName."</option>";
			}

              }
         ?>
		  </select>
		  <div id="error-msg" style="display: none; "></div>
			</p>
			<p>
				<label>new food name</label>
				<input type="text" id="name" name="name" autofocus required>
			</p>
			<p>
				<label>price</label>
				<input type="text" id="price" name="price" autofocus required>
			</p>
			<p>
				<label>Select image to upload:</label>
				<input type="file" name="fileToUpload" id="fileToUpload">
			</p>
			<p>
				<button>INSERT</button>
			</p>
			</form>
		</div>
</body>
</html>

<?php 
   
   
   
   	
   if(isset($_POST['submit'])){
	   if(!empty($_POST['tool_name']) and !empty($_POST['user_name']) and !empty($_POST['rent_date']) and !empty($_POST['rent_return'])){
			$id = "rent-".date("U");
		   	$tool_name = trim($_POST['tool_name']);
			$user_name = trim($_POST['user_name']);
		   	$tool_quatity = trim($_POST['tool_quatity']);
		   	$rent_date = trim($_POST['rent_date']);
		   	$rent_return = trim($_POST['rent_return']);
   
   	
   
   	$sql = "INSERT INTO rent (rent_id,tool_name, user_name,tool_quatity, rent_date,rent_return) values('$id','$tool_name','$user_name','$tool_quatity', '$rent_date', '$rent_return')";
   	$query = mysqli_query($conn, $sql);
		   
   }else{
		   echo "<script>alert('กรุณากรอกชื่ออุปกรณ์ ชื่อผู้ยืม จำนวน วันที่ยืมและวันที่คืน')</script>";}
   }

   	
   ?>

<?php

$sql1 = 'select user_name ,tool_name from rent';
$result = mysqli_query($conn,$sql1);
$row = mysqli_fetch_array($result);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
	<body>
	
	<div class="row">
	<div class="col-sm-3">
		<br>
		<br>
		<!--insert-->
		<center><h2><b>ยืม</b></h2></center>
		<br>
		<form method="post">
			<label>ชื่ออุปกรณ์</label>
		<input type="text" class="form-control" name="tool_name">
			<label>ชื่อผู้ยืม</label>
		<input type="text" class="form-control" name="user_name">
			<label>จำนวนที่ยืม</label>
		<input type="number" class="form-control" name="tool_quatity" value="1">
			<label>วันที่ยืม</label>
		<input type="datetime-local" class="form-control" name="rent_date">
			<label>วันที่คืน</label>
		<input type="datetime-local" class="form-control" name="rent_return">
			<br>
			<input type="submit" class="btn btn-primary" name="submit" value="add">
		</form>
		<!--//////-->
				
		</div>
		
	<div class="col-sm-9">
		<br>
		<br>
	<!--table preview-->
		<center><h2><b>รายการ</b></h2></center>
		<br>
		<table class="table align-middle table-bordered">
			<thead align="center">
				<th>รหัสอุปกรณ์</th>
				<th>ชื่ออุปกรณ์</th>
				<th>จำนวน</th>
				<th>รูปอุปกรณ์</th>
			</thead>
			<?php
			$sql = "select * from tool order by tool_name asc"; // DESC ฮ-ก
			$result = mysqli_query($conn,$sql) or die (mysqli_error());
			while($row=mysqli_fetch_array($result)){?>
			<tr>
				<td align="center"><?php echo $row['tool_id'];?></td>
				<td><?php echo $row['tool_name'];?></td>
				<td><?php echo $row['tool_quatity'];?></td>
				<td align="center"><img src="img/<?php echo $row['tool_img'];?>" width="150px"></td>
			</tr>
			<?php } ?>
		</table>
		
		</div>
	</div>
	<!--////-->
	

</body>
</html>
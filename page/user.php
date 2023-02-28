<?php
if(isset($_POST['save'])){
	if(!empty($_POST['name']) and !empty($_POST['firstname']) and !empty($_POST['lastname']) and !empty($_POST['pass']) and !empty($_POST['level'])){
		$id = "user-".date("U");
		$name = $_POST['name'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$pass = $_POST['pass'];
		$level = $_POST['level'];
		$sql="insert into user (user_id,user_name,user_firstname,user_lastname,user_pass,user_lev)values('$id','$name','$firstname','$lastname','$pass','$level')";
		//echo $sql;
		mysqli_query($conn,$sql);
	}else{
		echo "<script>alert('กรุณากรอกชื่อผู้ใช้ ชื่อจริง รหัสผ่านและสถานะ')</script>";
	}
	
}
if(isset($_POST['edit'])){
	$id = $_GET['edit'];
	$name = $_POST['name'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$pass = $_POST['pass'];
	$level = $_POST['level'];
	$sql = "update user set user_name='$name' , user_firstname='$firstname' , user_lastname='$lastname' ,user_pass='$pass' , user_lev='$level' where user_id='$id'";
	mysqli_query($conn,$sql);
}
if(isset($_POST['del'])){
	$id = $_GET['del'];
	$sql = "delete from user where user_id = '$id'";
	mysqli_query($conn,$sql);
	header('location:?page=user');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<br>
	<br>
	<div class="row">
	<div class="col-sm-3">
		
		<?php
		if(!isset($_GET['edit'])and !isset($_GET['del'])){
		?>
		
		<!--insert-->
		<center><h2><b>เพิ่ม</b></h2></center>
		<br>
		<form method="post">
			<label>ชื่อ</label>
		<input type="text" class="form-control" name="name">
			<label>ชื่อจริง</label>
		<input type="text" class="form-control" name="firstname">
			<label>นามสกุล</label>
		<input type="text" class="form-control" name="lastname">
			<label>รหัสผ่าน</label>
		<input type="text" class="form-control" name="pass">
			<label>สถานะ</label>
		<input type="text" class="form-control" name="level">
			<br>
			<input type="submit" class="btn btn-primary" name="save" value="add">
		</form>
		<!--//////-->
		
		<?php } ?>
		
		
		<?php
		if(isset($_GET['edit'])){
		?>
		<!--edit-->
		<?php
		$id = $_GET['edit'];
		$sql2 = "select * from user where user_id = '$id'";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($result2);
		//print_r($row2);
		?>
		<center><h2><b>แก้ไข</b></h2></center>
		<br>
		<form method="post">
			<label>ชื่อ</label>
		<input type="text" class="form-control" name="name" value="<?php echo $row2['user_name'];?>">
			<label>ชื่อจริง</label>
		<input type="text" class="form-control" name="firstname" value="<?php echo $row2['user_firstname'];?>">
			<label>นามสกุล</label>
		<input type="text" class="form-control" name="lastname" value="<?php echo $row2['user_lastname'];?>">
			<label>รหัสผ่าน</label>
		<input type="text" class="form-control" name="pass" value="<?php echo $row2['user_pass'];?>">
			<label>สถานะ</label>
		<input type="text" class="form-control" name="level" value="<?php echo $row2['user_lev'];?>">
			<br>
			<div class="row">
				<div class="col-sm-6" align="right"><a href="./?page=user" class="btn btn-secondary">back</a></div>
				<div class="col-sm-6"><input type="submit" class="btn btn-warning" name="edit" value="edit"></div>
			</div>
			
		</form>
		<!--//////-->
		<?php } ?>
		
		
		
		
		<?php
		if(isset($_GET['del'])){
		?>
		
		<!--delete-->
		<?php
		$id = $_GET['del'];
		$sql2 = "select * from user where user_id = '$id'";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($result2);
		//print_r($row2);
		?>
		<center><h2><b>ลบ</b></h2></center><br>
		<center><b>คุณต้องการลบ <?php echo $row2['user_name'];?> หรือไม่</b></center>
		<br>
		<form method="post">
			<div class="row">
				<div class="col-sm-6" align="right"><a href="?page=user" class="btn btn-secondary">กลับ</a></div>
				<div class="col-sm-6"><input type="submit" class="btn btn-danger" name="del" value="ลบ"></div>
			</div>
			
		</form>
		<!--//////-->
		<?php } ?>
		
		
		
		</div>
	<div class="col-sm-9">
		
		<!--view-->
		<center><h2><b>รายการ</b></h2></center>
		<br>
		<table class="table table-bordered table-sm">
			<thead>
			<th>id</th>
			<th>ชื่อ</th>
			<th>ชื่อจริง</th>
			<th>นามสกุล</th>
			<th>สถานะ</th>
			<th>ลบ</th>
			<th>แก้ไข</th>
			</thead>
			<?php
			$sql="select * from user order by user_name asc";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_array($result)){
				//print_r($row);
			?>
			<tr>
			<td><?php echo $row['user_id'];?></td>
			<td><?php echo $row['user_name'];?></td>
			<td><?php echo $row['user_firstname'];?></td>
			<td><?php echo $row['user_lastname'];?></td>
			<td><?php echo $row['user_lev'];?></td>
				<td>
				<a href="?page=user&del=<?php echo $row['user_id'];?>" class="btn btn-danger btn-sm">ลบ</a>
				</td>
			<td>
				<a href="?page=user&edit=<?php echo $row['user_id'];?>" class="btn btn-warning btn-sm">แก้ไข</a>
				</td>
			</tr>
			
			<?php } ?>
		</table>
		<!--//////-->
		</div>
	</div>
</body>
</html>
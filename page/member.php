<?php
if(isset($_POST['save'])){
	$id = "member-".date("U");
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$phone = $_POST['phone'];
	$sql="insert into member (member_id,member_name,member_surname,member_phone)values('$id','$name','$surname','$phone')";
	//echo $sql;
	mysqli_query($conn,$sql);
}
if(isset($_POST['edit'])){
	$id = $_GET['edit'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$phone = $_POST['phone'];
	$sql = "update member set member_name='$name' , member_surname='$surname' ,member_phone='$phone' where member_id='$id'";
	mysqli_query($conn,$sql);
}
if(isset($_POST['del'])){
	$id = $_GET['del'];
	$sql = "delete from member where member_id = '$id'";
	mysqli_query($conn,$sql);
	header('location:?page=member');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<h1>จัดการสมาชิก</h1>
	
	<div class="row">
	<div class="col-sm-3">
		<?php if(!isset($_GET['edit'and !isset($_GET['del'])])){?>
		<!--insert-->
		<b>เพิ่ม</b><hr>
		<form method="post">
			<label>name</label>
		<input type="text" class="form-control" name="name">
			<label>surname</label>
		<input type="text" class="form-control" name="surname">
			<label>phone</label>
		<input type="tel" class="form-control" name="phone">
			<br>
			<input type="submit" class="btn btn-primary" name="save" value="add">
		</form>
		<?php } ?>
		<!--//////-->
		
		
		
		<!--edit-->
		<?php if(isset($_GET['edit'])){?>
		
		<b>แก้ไข</b><hr>
		<?php
			$id = $_GET['edit'];
			$sql2 = "select * from member where member_id = '$id'";
			$result2 = mysqli_query($conn,$sql2);
			$row2 = mysqli_fetch_array($result2);
			//print_r($row2);
		?>
		
		<form method="post">
			<label>name</label>
		<input type="text" class="form-control" name="name" value="<?php echo $row2['member_name'];?>">
			<label>surname</label>
		<input type="text" class="form-control" name="surname" value="<?php echo $row2['member_surname'];?>">
			<label>phonenumber</label>
		<input type="tel" class="form-control" name="phone" value="<?php echo $row2['member_phone'];?>">
			<br>
			<div class="row">
				<div class="col-sm-6" align="right"><a href="../admin_page/?page=member" class="btn btn-secondary">back</a></div>
				<div class="col-sm-6"><input type="submit" class="btn btn-warning" name="edit" value="edit"></div>
			</div>
			
		</form>
		<!--//////-->
		<?php } ?>
		
		
		<?php if(isset($_GET['del'])){?>
		
		<!--delete-->
		<?php
		$id = $_GET['del'];
		$sql2 = "select * from member where member_id = '$id'";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($result2);
		//print_r($row2);
		?>
		<b>ลบ</b><hr>
		<b>คุณต้องการลบ <?php echo $row2['member_name'];?> หรือไม่</b>
		<form method="post">
			<div class="row">
				<div class="col-sm-6" align="right"><a href="?page=member" class="btn btn-secondary">back</a></div>
				<div class="col-sm-6"><input type="submit" class="btn btn-danger" name="del" value="delete"></div>
			</div>
			
		</form>
		<!--//////-->
		<?php } ?>
		
		
		
		</div>
	<div class="col-sm-9">
		<!--view-->
		<b>รายการ</b><hr>
		<table class="table table-bordered table-sm">
			<thead>
			<th>id</th>
			<th>name</th>
			<th>surname</th>
			<th>phone</th>
			<th>delete</th>
			<th>edit</th>
			</thead>
			<?php
			$sql="select * from member order by member_name asc";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_array($result)){
				//print_r($row);
			?>
			<tr>
			<td><?php echo $row['member_id'];?></td>
			<td><?php echo $row['member_name'];?></td>
			<td><?php echo $row['member_surname'];?></td>
			<td><?php echo $row['member_phone'];?></td>
				<td>
				<a href="?page=member&del=<?php echo $row['member_id'];?>" class="btn btn-danger btn-sm">ลบ</a>
				</td>
			<td>
				<a href="?page=member&edit=<?php echo $row['member_id'];?>" class="btn btn-warning btn-sm">แก้ไข</a>
				</td>
			</tr>
			
			<?php } ?>
		</table>
		<!--//////-->
		</div>
	</div>
</body>
</html>
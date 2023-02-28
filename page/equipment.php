<?php
if(isset($_POST['save'])){
	 if(!empty($_FILES['img']) and !empty($_POST['id'])){ // ! แปลว่าไม่
		$new_name = "img-".$_SESSION['ID']."-".date("U"); //เปลี่ยนแปลงตามวินาที img-1-15268459725
		//find .jpg .png .tif .gif .pdf .docx
		$name = $_FILES['img']['name'];
		$array = explode(".",$name); // ทำการหั่น tong.i.png --> array[0] = tong /array[1]=i /array[2]=png
		$img = $new_name.".".$array[count($array)-1]; //$img = img-1-15268459725.png
		copy($_FILES['img']['tmp_name'],"img/$img"); //upload
		chmod("img/$img",0777); //cheang permision excute read write delete //0 ไม่อนุญาติ 5
		 
		$id = $_POST['id'];
		$name = $_POST['name'];
		$quatity = $_POST['quatity'];
		$sql = "insert into tool (tool_id,tool_name,tool_quatity,tool_img)VALUES('$id','$name','$quatity','$img')";
		mysqli_query($conn,$sql);
	 }else{
		 echo "<script>alert('กรุณากรอกรหัสและเลือกรูปภาพ')</script>";
	 }
	
}
if(isset($_POST['edit'])){
	if(!empty($_FILES['img']['name'])){
		$new_name = "img-".$_SESSION['ID']."-".date("U"); //เปลี่ยนแปลงตามวินาที img-1-15268459725
		//find .jpg .png .tif .gif .pdf .docx
		$name = $_FILES['img']['name'];
		$array = explode(".",$name); // ทำการหั่น tong.i.png --> array[0] = tong /array[1]=i /array[2]=png
		$img = $new_name.".".$array[count($array)-1]; //$img = img-1-15268459725.png
		copy($_FILES['img']['tmp_name'],"img/$img"); //upload
		chmod("img/$img",0777); //cheang permision excute read write delete //0 ไม่อนุญาติ 5
		$img2 = $_POST['old_img'];
		//delete image
		unlink("img/$img2");
	}else{
		$img = $_POST['old_img'];
	}
	$id = $_GET['edit'];
	$name = $_POST['name'];
	$sql = "update tool set tool_name='$name',tool_quatity='$quatity',tool_img='$img' where tool_id='$id'";
		mysqli_query($conn,$sql);
}
if(isset($_POST['del'])){
	$id = $_GET['del'];
	$img = $_POST['img'];
	//delete image
	unlink("img/$img");
	$sql = "delete from tool where tool_id = '$id'";
	mysqli_query($conn,$sql);
	header('location:?page=equipment');
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
		<?php if(!isset($_GET['edit']) and !isset($_GET['del'])){?>
		<!--form add-->
		<center><h2><b>เพิ่ม</b></h2></center>
		<br>
		<form method="post" enctype="multipart/form-data"> <!--****-->
			<label>รหัสอุปกรณ์</label>
				<input type="text" class="form-control" name="id">
			<label>ชื่ออุปกรณ์</label>
				<input type="text" class="form-control" name="name">
			<label>จำนวน</label>
				<input type="number" class="form-control" name="quatity" value="1">
			<label>รูปภาพ</label>
				<input type="file" class="form-control" name="img">
			<br>
			<input type="submit" class="btn btn-primary" name="save">
		</form>
		
		<?php } ?>
		<!--////-->
		
		
		<!--form edit-->
		<?php if(isset($_GET['edit'])){?>
		<center><h2><b>แก้ไข</b></h2></center>
		<br>
		
			<?php 
				$id = $_GET['edit'];
				$sql="select * from tool where tool_id='$id'";
				$result=mysqli_query($conn,$sql) or die(mysqli_error());
				$row = mysqli_fetch_array($result);
			?>
		
		<form method="post" enctype="multipart/form-data"> <!--****-->
			<label>รหัสอุปกรณ์</label>
				<input type="text" class="form-control" name="id" value="<?php echo $row['tool_id'] ?>" readonly>
			<label>ชื่ออุปกรณ์</label>
				<input type="text" class="form-control" name="name" value="<?php echo $row['tool_name'] ?>">
			<label>จำนวน</label>
				<input type="text" class="form-control" name="name" value="<?php echo $row['tool_quatity'] ?>">
			<label>รูปภาพ</label>
				<input type="hidden" name="old_img" value="<?php echo $row['tool_img'];?>">
				<input type="file" class="form-control" name="img">
			<br>
			<input type="submit" class="btn btn-primary" name="edit">
		</form>
		<?php } ?>
		<!--////-->
		
		<!--form delete-->
		<?php if(isset($_GET['del'])){?>
		<?php
		$id = $_GET['del'];
		$sql2 = "select * from tool where tool_id = '$id'";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($result2);
		//print_r($row2);
		?>
		<center><h2><b>ลบ</b></h2></center>
		<br>
		<center><b>คุณต้องการลบ <?php echo $row2['tool_name'];?> หรือไม่</b></center>
		<br>
		<form method="post">
			<input type="hidden" name="img" value="<?php echo $row2['tool_img'];?>">
			<div class="row">
				<div class="col-sm-6" align="right"><a href="?page=equipment" class="btn btn-secondary">กลับ</a></div>
				<div class="col-sm-6"><input type="submit" class="btn btn-danger" name="del" value="ลบ"></div>
			</div>
			
		</form>
		<?php } ?>
		<!--////-->
		</div>
		
	<div class="col-sm-9">
	<!--table preview-->
		<center><h2><b>รายการ</b></h2></center>
		<br>
		<table class="table align-middle table-bordered">
			<thead align="center">
				<th>รหัสอุปกรณ์</th>
				<th>ชื่ออุปกรณ์</th>
				<th>จำนวน</th>
				<th>รูปภาพ</th>
				<th>ลบอุปกรณ์</th>
				<th>แก้ไขอุปกรณ์</th>
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
				<td align="center"><a href="?page=equipment&del=<?php echo $row['tool_id'];?>" class="btn btn-danger btn-sm">ลบ</a></td>
				<td align="center"><a href="?page=equipment&edit=<?php echo $row['tool_id'];?>" class="btn btn-warning btn-sm">แก้ไข</a></td>
			</tr>
			<?php } ?>
		</table>
		
		</div>
	</div>
	<!--////-->
</body>
</html>
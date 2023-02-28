
<?php 
	if(isset($_POST['del'])){
	$id = $_GET['del'];
	$sql = "delete from rent where rent_id = '$id'";
	mysqli_query($conn,$sql);
	header('location:?page=borrow');
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
	
	<div class="col-sm-12">
	<!--table preview-->
		<center><h2><b>รายการคืน</b></h2></center>
		<br>
		<table class="table align-middle table-bordered">
			<thead align="center">
				<th>id</th>
				<th>name</th>
				<th>tool name</th>
				<th>quatity</th>
				<th>rent_date</th>
				<th>return_date</th>
				<th>return</th>
			</thead>
			<?php
			$sql = "select * from rent order by rent_id asc"; // DESC ฮ-ก
			$result = mysqli_query($conn,$sql) or die (mysqli_error());
			while($row=mysqli_fetch_array($result)){?>
			<tr>
				<td align="center"><?php echo $row['rent_id'];?></td>
				<td><?php echo $row['user_name']?></td>
				<td><?php echo $row['tool_name']?></td>
				<td><?php echo $row['tool_quatity']?></td>
				<td><?php echo $row['rent_date']?></td>
				<td><?php echo $row['rent_return']?></td>
				<td align="center">
				<a href="?page=resive&del=<?php echo $row['rent_id'];?>" class="btn btn-danger btn-sm">คืน</a>
				</td>

				
			</tr>
			<?php } ?>
		</table>
		
		</div>
	
	<?php
		if(isset($_GET['del'])){
		?>
	
	<?php
		$id = $_GET['del'];
		$sql2 = "select * from rent where rent_id = '$id'";
		$result2 = mysqli_query($conn,$sql2);
		$row2 = mysqli_fetch_array($result2);
		//print_r($row2);
		?>
		<b>คืน</b><br>
		<b>คุณต้องการคืน <?php echo $row2['tool_name'];?> หรือไม่</b>
		<form method="post">
			<div class="row">
				<div class="col-sm-6" align="right"><a href="?page=resive" class="btn btn-secondary">กลับ</a></div>
				<div class="col-sm-6"><input type="submit" class="btn btn-danger" name="del" value="คืน"></div>
			</div>
			
		</form>
		<?php } ?>

	
</body>
</html>
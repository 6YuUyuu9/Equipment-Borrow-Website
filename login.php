<?php

	include('connect.php');
		
	if (isset($_POST['user'])){

		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$sql = "select * from user where user_name = '$user' and user_pass = '$pass'";
		$result = mysqli_query($conn,$sql)or die(mysqli_error($conn));	

		if (mysqli_num_rows($result) == 1){
			
			$row = mysqli_fetch_array($result);{
				
				$_SESSION['ID'] = $row['user_id'];
				$_SESSION['USER'] = $row['user_firstname'] . " " . $row['user_lastname'];
				$_SESSION['USERLEVEL'] = $row['user_lev'];
				
				
				if($_SESSION['USERLEVEL'] == 'a'){
					header('location:admin_page.php'); //เปลี่ยน
				}
				if($_SESSION['USERLEVEL'] == 'm'){
					header('location:user_page.php'); //เปลี่ยน
				}
			}
		}else{
				echo "<script>alert('Username Or Password Incorrect')</script>";
			}
	}else{
		header('location:index.php');
	}

?>
<?php include("connect.php");?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>E-Borrow Equipment Website</title>
  </head>
  <body>
	  <body background="bg_img/Equipment Borrow Website (17).png"></body>
	   <br>
<center><h2>ยินดีต้อนรับ <?php echo $_SESSION['USER'];?></h2></center>
	  
	  
<div class="container-fluid">
	<div class="row">
	<div class="col-sm-3">
		<br>
		<br>
		<center><b><h2>menu</h2></b></center>
		<br>
		<br>
		<a href="?page=borrow" class="btn btn-light" style="width: 100%">ยืมอุปกรณ์</a><br><br>
		<a href="?page=resive " class="btn btn-light" style="width: 100%">คืนอุปกรณ์</a><br><br>
		<a href="logout.php" class="btn btn-light btn-sm" style="width: 100%"> ออกจากระบบ </a><br><br>
		</div>
	<div class="col-sm-9">
		<?php
			if(isset($_GET['page'])){
				switch($_GET['page']){
					case "borrow" : include("page/borrow.php");break;
						case "resive" : include("page/resive.php");break;

						
					default:include("page/borrow.php");break;
				}
			}else{
				header('location:?page=borrow');
			}
		?>
		
		
		</div>
	</div>
	  
	  </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
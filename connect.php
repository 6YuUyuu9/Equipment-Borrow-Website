<?php
ob_start();
session_start();
$conn = mysqli_connect("localhost","root","","toolstore");
if($conn){}
else{
	echo "notConnect";
}
mysqli_query($conn,"set name utf8");
?>
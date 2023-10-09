<?php
session_start();
if (isset($_POST['email'])) {
$conn=mysqli_connect("localhost","root","","student");
$email=$_SESSION['user'];
$status=$_SESSION['app'];
$sql = "INSERT INTO status VALUES ('$email', '$status')";
$result=mysqli_query($conn,$sql);
}
?>
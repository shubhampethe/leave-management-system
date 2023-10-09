<?php
if (isset($_POST['email'])) {
  $id = $_POST['email'];
  $conn = mysqli_connect("localhost", "root", "", "student");
  $sql = "DELETE FROM student WHERE email = '$id'";
  mysqli_query($conn, $sql);
  $response = array('success' => true, 'message' => 'Record deleted successfully');
  echo json_encode($response);
} else {
  $response = array('success' => false, 'message' => 'ID parameter missing');
  echo json_encode($response);
}


?>

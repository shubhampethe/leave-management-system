<?php
include "connect.php";
session_start();
if(!isset($_SESSION['user'])){
   header('location:index.php');
}

?>

<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
$name = $_POST["name"];
$email = $_POST["email"];
$day = $_POST["day"];
$type = $_POST["type"];
$reason = $_POST["reason"];
$sdate = $_POST["sdate"];
$edate = $_POST["edate"];

$conn=mysqli_connect("localhost","root","","student");

$sql = "INSERT INTO student VALUES ('$name','$email', '$day', '$type','$reason','$sdate','$edate')";
$result=mysqli_query($conn,$sql);

if($result){
$e=$_SESSION['user'];
unset($_SESSION['app']);
  $sql = "DELETE FROM status WHERE email = '$e'";
  mysqli_query($conn, $sql);
  $_SESSION['status']="Waiting";
}


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style1.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <title>Student-Dashboard</title>
</head>

<body>
  <div class="row">
    <div class="col col1">
      <h3>hi, <span>user</span></h3>
      <h1>welcome</h1>
      <img src="assets/p.png" alt="photo" width="150" height="200">
      <h1><?php echo $_SESSION['name']; ?></h1>
      <h3><?php echo $_SESSION['user']; ?></h3>
      <br>
      <p id="status">
        application is:
      <div class="st">
      <?php
      $e=$_SESSION['user'];
      
      $conn=mysqli_connect("localhost","root","","student");
      $sql = "SELECT * FROM status where email='$e'";
      // $result = $conn->query($sql);

      
      // if ($result->num_rows > 0) {
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {

        echo $row['status'];
      }
      
      }else{
        if(!isset($_SESSION['user'])){
          echo "Not Applied";
        }else{
          echo "waiting..";
        }
      }
?>
      </div>
<br>
      </p>
      <button  style="margin-bottom: 16px;"
    onclick="window.location.href = 'h.php';">
        History
    </button>

    <button  style="margin-bottom: 16px; background-color:red;"
    onclick="window.location.href = 'logout.php';">
        Logout
    </button>
    
    

    </div>
        <div class="col col2">
          <div class="container">
          <form action="student.php" id="myForm" method="POST">
              <h1>Leave Application</h1>
              <div class="field">
                <p for="">Name</p>
                <input type="text" class="in" id="name" name="name" value=<?php echo $_SESSION['name']; ?> readonly>
              </div>
              <div class="field">
                <p for="">Email</p>
                <input type="text" class="in" id="email" name="email" value=<?php echo $_SESSION['user']; ?> readonly>
              </div>

              <div class="field" id='select'>
              <p for="">Leave types</p>
                <select id="type" name="type">
                  <option value="Casual Leave">Casual Leave</option>
                  <option value="Duty Leave">Duty Leave</option>
                  <option value="Sick Leave">Sick Leave</option>
                </select>
              </div>


              <div class="field">
                <p for="">Number of days</p>
                <input type="number" class="da1" id="day" name="day" placeholder="Days">
                <div class="field">
                  <p>Reason for the leave</p>
                  <textarea type="text" class="comments" name="reason" placeholder="Enter Your Reason"></textarea>
                </div>



                <div class="display field">
                <div class="block">
                  <p for="">Start Date</p>
                  <input type="date" class="da" id="sdate" name="sdate">
                  </div>
                  <div class="block">
                  <p for="">End Date</p>
                  <input type="date" class="da" id="edate" name="edate">
                  </div>
                </div>




                <div class="btn">
                  <button type="submit">Submit</button>
                </div>
            </form>
          </div>
        </div>
    </div>

</body>

</html>
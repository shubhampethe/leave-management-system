<?php
include "connect.php";
session_start();
if(!isset($_SESSION['admin'])){
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="assets/style2.css">
  <style>
    #app {
      background-color: #4CAF50;
      /* Green */
      justify-content: space-around;
      margin: 10px;
      font-size: 16px;
    }

    #rej {
      background-color: red;
      /* Green */
      justify-content: space-around;
      font-size: 16px;
      margin: 10px;
    }
  </style>
  <title>Admin-Dashboard</title>
</head>

<body>
  <div class="row">
    <div class="col col1">
      <h3>hi, <span>Admin</span></h3>
      <h1>Welcome</h1>
      <img src="assets/p.png" alt="photo" width="200" height="250">
      <h1>Shubham</h1>
      <h3>shubhamspethe@coep.sveri.ac.in</h3>
      <br>
      <button style="margin-bottom: 16px;" onclick="window.location.href = 'history.php';">
        History
      </button>

      <button style="margin-bottom: 16px; background-color:red;" onclick="window.location.href = 'logout.php';">
        Logout
      </button>
    </div>
    <div class="col col2">
      <h1 style="text-align: center;padding:20px;">Manage Leaves</h1>
      <div class="container my-4">

        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">NAME</th>
              <th scope="col">EMAIL</th>
              <th scope="col">NO OF DAYS</th>
              <th scope="col">FROM DATE</th>
              <th scope="col">TO DATE</th>
              <th scope="col">LEAVE TYPE</th>
              <th scope="col">REASON</th>
              <th scope="col">ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php
      $conn=mysqli_connect("localhost","root","","student");

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM student";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row['name']."</td>
        <td>".$row['email']."</td>
        <td>".$row["day"]."</td>
        <td>".$row['sdate']."</td>
        <td>".$row['edate']."</td>
        <td>".$row['type']."</td>
        <td>".$row['reason']."</td>
        <td><button id='app' onclick='app(this)'>Approve</button>
        <button id='rej' onclick='rej(this)'>Reject</button></td>
        </tr>";
      }
    }
    ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="status"></div>
  </div>


</body>



<script>

  $(document).on('click', '#app', function () {
    var row = $(this).closest('tr');
    var name = row.find('td:eq(0)').text();
    var email = row.find('td:eq(1)').text();
    var day = row.find('td:eq(2)').text();
    var sdate = row.find('td:eq(3)').text();
    var edate = row.find('td:eq(4)').text();
    var type = row.find('td:eq(5)').text();
    var reason = row.find('td:eq(6)').text();

    $.ajax({
      method: 'POST',
      url: 'delete.php',
      data: { email: email },
      success: function (response) {
        console.log(response);
        row.remove();
      },
      error: function () {
        alert('Failed to delete row!');
      }
    });

    $.ajax({
      method: 'POST',
      url: 'history.php',
      data: { name: name, email: email, sdate: sdate, edate: edate, day: day, type: type, reason: reason },
      success: function (response) {
        console.log(response);
        console.log("data is inserted");
      },
      error: function () {
        alert('Failed to delete row!');
      }
    });
  });

  $(document).on('click', '#rej', function () {
    var row = $(this).closest('tr');
    var name = row.find('td:eq(0)').text();
    var email = row.find('td:eq(1)').text();
    var day = row.find('td:eq(2)').text();
    var sdate = row.find('td:eq(3)').text();
    var edate = row.find('td:eq(4)').text();
    var type = row.find('td:eq(5)').text();
    var reason = row.find('td:eq(6)').text();


    $.ajax({
      method: 'POST',
      url: 'delete.php',
      data: { email: email },
      success: function (response) {
        console.log(response);
        row.remove();
      },
      error: function () {
        alert('Failed to delete row!');
      }
    });

    $.ajax({
      method: 'POST',
      url: 'history.php',
      data: { name: name, email: email, sdate: sdate, edate: edate, day: day, type: type, reason: reason },
      success: function (response) {
        console.log(response);
        console.log("data is insertec");

      },
      error: function () {
        alert('Failed to delete row!');
      }
    });
  });




  function rej(btn) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "reject.php", true);
    xhr.send();
  }
  function app(btn) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "approve.php", true);
    xhr.send();
  }     
</script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous">
  </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<script>
  $(document).ready(function () {
    $('#myTable').DataTable();
  });
</script>

<script>
  let table = new DataTable('#myTable'); 
</script>

</html>
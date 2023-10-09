<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style3.css">
  <title>History</title>
</head>

<body>
  <div class="container my-4">
  <h1 style="text-align:center;">History-<?php echo $_SESSION['name'];?></h1>
    <table class="table" id="myTable">
      <thead>
        <tr style="background-color: coral;">
          <th scope="col">NAME</th>
          <th scope="col">EMAIl</th>
          <th scope="col">NO OF DAYS</th>
          <th scope="col">FROM DATE</th>
          <th scope="col">TO DATE</th>
          <th scope="col">LEAVE TYPE</th>
          <th scope="col">REASON</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $conn=mysqli_connect("localhost","root","","student");
          $id=$_SESSION['user'];
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM history where email='$id'";
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
            <td>".$row['status']."</td>
            </tr>";


          }

        }
        ?>

      </tbody>
    </table>
  </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.4.js"     integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
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
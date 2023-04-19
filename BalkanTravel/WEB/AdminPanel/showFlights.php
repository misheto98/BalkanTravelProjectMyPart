<?php
try {
  $conn = new PDO('mysql:host=localhost:3307;dbname=book_flights', 'root', '');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT * FROM flights";
  $PDOstatement = $conn->prepare('SELECT * FROM flights');
  $PDOstatement->execute();
  $result = $PDOstatement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Connection failed" . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>showUsers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="editFlightsStyle.css"> -->

</head>

<body>
  <?php include("../header.php"); ?>
  <br><br>

  <form action="addInDb.php?id=<?= @$id ?>" method="post">

  <fieldset style="border-width: 2px !important;
    border-style: groove !important;
    border-color: rgb(192, 192, 192) !important;
    border-image: initial !important;">
    <legend>Add flights:</legend>

      <label for="FlightDate">FlightDate:</label>
      <input type="date" class="txt_field" name="FlightDate" id="FlightDate" min="<?php echo date("Y-m-d"); ?>" required autocomplete="off"><br><br>

      <label for="FlightDuration">FlightDuration:</label>
      <input type="time" name="FlightDuration" id="FlightDuration" required autocomplete="off"><br><br>

      <label for="FlightDepartTime">FlightDepartTime:</label>
      <input type="time" name="FlightDepartTime" id="FlightDepartTime" required autocomplete="off"><br><br>

      <?php
      $sql = "SELECT * FROM cities";
      $result1 = $conn->query($sql);
      $rows = $result1->fetchAll();


      ?>

      From City: <select name="FromCityID" required>
        <?php
        foreach ($rows as $row) {
        ?>
          <option value="<?= $row['CityID'] ?>"><?= $row['CityName'] ?></option>
        <?php
        }
        ?>
      </select>
      <br><Br>

      To City: <select name="ToCityID" required>
        <?php
        foreach ($rows as $row) {
        ?>
          <option value="<?= $row['CityID'] ?>"><?= $row['CityName'] ?></option>
        <?php
        }
        ?>
      </select>
      <br><br>


      Choose class of flight: <select name="FlightClass" required>

        <option value="Economy">Ecomony</option>
        <option value="Business">Business</option>
        <option value="First Class">First Class</option>

      </select>
      <br><br>

      <label for="FlightDepartTime">FlightPrice:</label>
      <input type="number" name="FlightPrice" id="FlightPrice" min="10" required autocomplete="off"><br><br>

      <input type="submit" name="submit" class="btn btn-success"><br><br>

    </fieldset>
  </form>
  <br>




  <table class="table table-warning table-striped table-responsive">
    <!-- table-success  -->
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Flight Date</th>
        <th scope="col">Flight Depart Time</th>
        <th scope="col">Flight Duration</th>
        <th scope="col">From City</th>
        <th scope="col">To City</th>
        <th scope="col">Flight Class</th>
        <th scope="col">Flight Price</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>

    <?php

    for ($i = 0; $i < count($result); $i++) {
      echo "<tr>";
      echo   "<td>" . $result[$i]['ID'] . "</td>";
      echo   "<td>" . $result[$i]['FlightDate'] . "</td>";
      echo   "<td>" . $result[$i]['FlightDepartTime'] . "</td>";
      echo   "<td>" . $result[$i]['FlightDuration'] . "</td>";
      echo   "<td>" . $result[$i]['FromCityID'] . "</td>";
      echo   "<td>" . $result[$i]['ToCityID'] . "</td>";
      echo   "<td>" . $result[$i]['FlightClass'] . "</td>";
      echo   "<td>" . $result[$i]['FlightPrice'] . "</td>";
      echo   '<td><a class="btn btn-danger" href="deleteFlights.php?id=' . $result[$i]['ID'] . '">Delete</a></td>';
      echo   '<td><a class="btn btn-warning" href="editFlights.php?id=' . $result[$i]['ID'] . '">Edit</a></td>';
      echo "</tr>";
    }
    ?>

  </table>
</body>

</html>
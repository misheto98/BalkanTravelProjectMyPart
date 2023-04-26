<?php
try {
  $conn = new PDO('mysql:host=localhost:3307;dbname=book_flights', 'root', '');
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT * FROM flights";
  $PDOstatement = $conn->prepare('SELECT * FROM flights');
  $PDOstatement->execute();
  $result = $PDOstatement->fetchAll(PDO::FETCH_ASSOC);

  $sql = "SELECT * FROM cities";
  $result1 = $conn->query($sql);
  $rows = $result1->fetchAll();

  // Funtion to return the CityName from given CityID as parameter
  function getCity($connection,$cityID){
    $query = $connection->prepare("SELECT * FROM cities WHERE CityID = ?"); // SQL query pattern
    $query->execute([ $cityID ]); // Execute the Query with the given CityID on "?" place
    $city = $query->fetch(); // Fetch (Search and Return) for Results
    
    return $city; // Return the City
  }

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
  <!-- <link rel="stylesheet" href="editFlightsStyle.css"> -->

</head>


<body>


  <?php include("../header.php"); ?>
  <br><br>

  <form action="addInDb.php" method="post" style="width:25rem;margin:auto;">
    <fieldset style="border-width: 2px !important;
      border-style: groove !important;
      border-color: rgb(192, 192, 192) !important;
      border-image: initial !important;
      padding: 10px;
      display:flex;
      flex-direction:column;
      align-items:center;
      font-size:1.2em;">

      <div>
        <legend>Add flights</legend>
      </div>

      <div>
        <label for="FlightDate">FlightDate:</label>
        <input type="date" class="txt_field" name="FlightDate" id="FlightDate" min="<?php echo date("Y-m-d"); ?>" required autocomplete="off"><br><br>
      </div>

      <div>
        <label for="FlightDuration">FlightDuration:</label>
        <input type="time" name="FlightDuration" id="FlightDuration" required autocomplete="off"><br><br>
      </div>

      <div>
        <label for="FlightDepartTime">FlightDepartTime:</label>
        <input type="time" name="FlightDepartTime" id="FlightDepartTime" required autocomplete="off"><br><br>
      </div>

      <div>
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
      </div>

      <div>
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
      </div>

      <div>
        Choose class of flight: <select name="FlightClass" required>
          <option value="Economy">Ecomony</option>
          <option value="Business">Business</option>
          <option value="First Class">First Class</option>

        </select>
        <br><br>
      </div>

      <div>
        <label for="FlightPrice">FlightPrice:</label>
        <input type="number" name="FlightPrice" id="FlightPrice" min="10" required autocomplete="off"><br><br>
      </div>

      <div style="width:100%;">
        <input type="submit" name="submit" class="btn btn-success" style="width:100%;"><br>
      </div>
    </fieldset>
  </form>
  <br>

  <div class="table-responsive">
  <table class="table table-warning table-striped">
    <!-- table-success  -->
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Flight Date</th>
        <th scope="col">Flight Depart Time</th>
        <th scope="col">Flight Duration</th>
        <th scope="col">Flight Depart Airport</th>
        <th scope="col">Flight End Airport</th>
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
        echo   "<td>" . getCity($conn,$result[$i]['FromCityID'])["CityName"] . "</td>";
        echo   "<td>" . getCity($conn,$result[$i]['ToCityID'])["CityName"] . "</td>";
        echo   "<td>" . $result[$i]['FlightClass'] . "</td>";
        echo   "<td>" . $result[$i]['FlightPrice'] . "</td>";
        echo   '<td><a class="btn btn-danger" href="deleteFlights.php?id=' . $result[$i]['ID'] . '">Delete</a></td>';
        echo   '<td><a class="btn btn-warning" href="editFlights.php?id=' . $result[$i]['ID'] . '">Edit</a></td>';
        echo "</tr>";
      }
    ?>

  </table>
    </div>
  
    

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
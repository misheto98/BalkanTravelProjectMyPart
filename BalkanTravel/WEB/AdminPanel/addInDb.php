<?php
// @ ако има грешка не я показва
$id = @$_GET['id'];
    try{
        $conn = new PDO('mysql:host=localhost:3307;dbname=book_flights','root','');
        $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        if ( isset( $_POST['submit'] ) ) {
    
            $FlightDate = $_POST['FlightDate'];
            $FlightDepartTime= $_POST["FlightDepartTime"];
            $FlightDuration = $_POST['FlightDuration'];
            $FromCityID = $_POST['FromCityID'];
            $ToCityID = $_POST['ToCityID'];
            $FlightClass = $_POST['FlightClass'];
            $FlightPrice = $_POST['FlightPrice'];

    

            if ($FlightDate && $FlightDuration){

                if ( $id ) {

                    $sql = "UPDATE flights SET FlightDate='$FlightDate', FlightDepartTime='  $FlightDepartTime', FlightDuration='$FlightDuration',FromCityID='$FromCityID',ToCityID='$ToCityID',FlightClass=''$FlightClass,FlightPrice='$FlightPrice' WHERE id=$id";
            
                    $conn->query($sql);

                } else {
                    $sql = "INSERT INTO flights (FlightDate,FlightDepartTime,FlightDuration,FromCityID,ToCityID,FlightClass,FlightPrice) VALUES (?,?,?,?,?,?,?)";
                      $conn->prepare($sql)->execute([$FlightDate,$FlightDepartTime,$FlightDuration,$FromCityID,$ToCityID,$FlightClass,$FlightPrice]);
                }
            }
        }
        
        header('Location: showFlights.php');
    
    }catch(PDOException $e){
        echo "Connection failed" .$e ->getMessage();
    
    }
?>
<?php
    try{
        $conn = new PDO('mysql:host=localhost:3307;dbname=book_flights','root','');
        $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
        
    
        $delete_id = $_GET['id'];
        if ( $delete_id ) {
            $sql = "DELETE FROM flights WHERE id = ?";
            $conn->prepare($sql)->execute([$delete_id]);

        }
    
         
        header('Location: showFlights.php');
        
    }catch(PDOException $e){
        echo "Connection failed" .$e ->getMessage();
    
    }
?>
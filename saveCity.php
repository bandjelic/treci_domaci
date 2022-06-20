<?php 

    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    // superglobals, $_POST, $_GET, $_SERVER
    $name = $_POST['CityName'];
    $country_id = $_POST['country_id'];

    saveCityToDatabase($name, $country_id);
    
    header("location:./cities.php");
?>
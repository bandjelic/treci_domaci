<?php 

    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    // superglobals, $_POST, $_GET, $_SERVER
    $name = $_POST['CountryName'];

    saveCountryToDatabase($name);
    
    header("location:./countries.php");
?>
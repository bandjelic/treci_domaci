<?php 

    include "connectDB.php";
    include "databaseFunctions.php";

    $name = $_POST['CountryName'];
    $id = $_POST['country_id'];


    updateCountry($name,$id);

    header('location:countries.php');
?>
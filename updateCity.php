<?php 

    include "connectDB.php";
    include "databaseFunctions.php";

    $name = $_POST['CityName'];
    $country_id = $_POST['country_id'];
    $id = $_POST['city_id'];


    updateCity($name,$country_id,$id);

    header('location:cities.php');
?>
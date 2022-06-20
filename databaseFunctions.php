<?php 

    // CRUD methods for phonebook

    function getContactsFromDatabase($searchTerm = ""){
        global $db_connection;
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT
                contacts.id,
                contacts.first_name,
                contacts.last_name,
                contacts.email,
                countries.name as country_name,
                cities.name as city_name
                FROM `contacts` ,cities,countries
                WHERE contacts.city_id = cities.id
                AND cities.country_id = countries.id
                AND user_id = $user_id";

        if($searchTerm != ""){
            $term = strtolower($searchTerm);
            $sql .= " AND lower(first_name) LIKE '%$term%' OR lower(last_name) LIKE '%$term%' ";
        }

        $res = mysqli_query($db_connection, $sql);

        $contacts = [];
        while($contact = mysqli_fetch_assoc($res)){
            $contacts[] = $contact;
        }

        return $contacts;
    }

    function getCitiesFromDatabase($CitySearchTerm = ""){
        global $db_connection;
        $sql = "SELECT cities.name,
                        cities.id,
                        cities.country_id,
                        countries.name as country_name
                        
                        FROM cities,countries
                        WHERE cities.country_id = countries.id";
        if($CitySearchTerm != ""){
            $term = strtolower($CitySearchTerm);
            $sql .= " AND lower(cities.name) LIKE '%$term%'";
        }

        $res = mysqli_query($db_connection, $sql);
        $cities = [];
        while($city = mysqli_fetch_assoc($res)){
            $cities[] = $city;
        }

        return $cities;

    }

    function getCountriesFromDatabase($CountrySearchTerm = ""){
        global $db_connection;
        $sql = "SELECT countries.name,
                        countries.id
                        FROM countries";
        if($CountrySearchTerm != ""){
            $term = strtolower($CountrySearchTerm);
            $sql .= " WHERE lower(countries.name) LIKE '%$term%'";
        }

        $res = mysqli_query($db_connection, $sql);
        $countries = [];
        while($country = mysqli_fetch_assoc($res)){
            $countries[] = $country;
        }

        return $countries;

    }

    function saveContactToDatabase($first_name, $last_name, $email, $user_id, $city_id){
        global $db_connection;
        $sql = "INSERT INTO contacts (first_name, last_name, email, user_id, city_id) 
                VALUES ('$first_name', '$last_name', '$email', $user_id, $city_id)
                ";
        return mysqli_query($db_connection, $sql);
    }

    function saveCityToDatabase($name, $country_id){
        global $db_connection;
        $sql = "INSERT INTO cities (name, country_id) 
                VALUES ('$name',$country_id)
                ";
        return mysqli_query($db_connection, $sql);
    }

    function saveCountryToDatabase($name){
        global $db_connection;
        $sql = "INSERT INTO countries (name) 
                VALUES ('$name')
                ";
        return mysqli_query($db_connection, $sql);
    }

    function findContactById($id){
        global $db_connection;
        $sql = "SELECT contacts.*, countries.id as country_id 
                FROM contacts,cities,countries 
                WHERE contacts.id = $id
                AND contacts.city_id = cities.id
                AND countries.id = cities.country_id
                ";
        $res = mysqli_query($db_connection, $sql);

        return mysqli_fetch_assoc($res);
    }

    function findCityById($id){
        global $db_connection;
        $sql = "SELECT cities.*, countries.id as country_id 
                FROM cities,countries 
                WHERE cities.id = $id
                AND countries.id = cities.country_id
                ";
        $res = mysqli_query($db_connection, $sql);

        return mysqli_fetch_assoc($res);
    }

    function findCountryById($id){
        global $db_connection;
        $sql = "SELECT countries.*
                FROM countries 
                WHERE countries.id = $id
                ";
        $res = mysqli_query($db_connection, $sql);

        return mysqli_fetch_assoc($res);
    }

    function updateContact($first_name, $last_name, $email, $id, $city_id){
        global $db_connection;
        $sql = "UPDATE contacts SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                email = '$email',  
                city_id = $city_id
            WHERE id = $id ";
        return mysqli_query($db_connection, $sql);
    }

    function updateCity($name,$country_id, $id){
        global $db_connection;
        $sql = "UPDATE cities SET 
                name = '$name', 
                country_id = $country_id
            WHERE id = $id ";
        return mysqli_query($db_connection, $sql);
    }

    function updateCountry($name,$id){
        global $db_connection;
        $sql = "UPDATE countries SET 
                name = '$name'  
                WHERE id = $id ";
        return mysqli_query($db_connection, $sql);
    }

    function deleteContact($id){
        global $db_connection;


        $sql = "DELETE FROM contacts WHERE id = $id";
        return mysqli_query($db_connection, $sql);
    }

    function deleteCity($id){
        global $db_connection;
        $contacts = getContactsByCity($id);
        $temp = false;
        foreach($contacts as $contact){
            if($contact['city_id'] == $id){
                $temp = true;
            }
        }

        
        if($temp){
            return false;
        }
        else{
            $sql = "DELETE FROM cities WHERE id = $id";
            return mysqli_query($db_connection, $sql);
        }

    }

    function deleteCountry($id){
        global $db_connection;

        $cities = getCitiesFromDatabase();
        $temp = false;
        foreach($cities as $city){
            if($city['country_id'] == $id){
                $temp = true;
            }
        }
        if($temp){
            return false;
        }
        else{
            $sql = "DELETE FROM countries WHERE id = $id";
            return mysqli_query($db_connection, $sql);
        }
       

        
    }

    function findUserByUsernameAndPassword($username, $password){
        global $db_connection;
        $sql = "SELECT * FROM users 
                    WHERE username = '$username' 
                    AND `password` = '$password' 
                ";
        $res = mysqli_query($db_connection, $sql);
        return mysqli_fetch_assoc($res);
    }

    function getCountries(){
        global $db_connection;
        $sql = "SELECT * FROM countries ORDER BY name";
        return mysqli_query($db_connection, $sql);
    }

    function getCitiesByCountry($country_id){
        global $db_connection;
        $sql = "SELECT * FROM cities WHERE country_id = $country_id ORDER BY name";
        return mysqli_query($db_connection, $sql);
    }
    function getContactsByCity($city_id){
        global $db_connection;
        $sql = "SELECT * FROM contacts WHERE city_id = $city_id";
        $res = mysqli_query($db_connection, $sql);

        $contacts = [];
        while($contact = mysqli_fetch_assoc($res)){
            $contacts[] = $contact;
        }

        return $contacts;
    }








?>
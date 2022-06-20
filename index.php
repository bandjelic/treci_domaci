<?php 
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }

    $searchTerm = "";
    if(isset($_GET['searchTerm']) && $_GET['searchTerm'] != ""){
        $searchTerm = $_GET['searchTerm'];
        $contacts = getContactsFromDatabase($_GET['searchTerm']);
    }else{
        $contacts = getContactsFromDatabase();
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <title>Phonebook</title>
</head>
<body>
    
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php">Kontakti</a>
                    <a class="nav-link" href="cities.php">Gradovi</a>
                    <a class="nav-link" href="countries.php">Drzave</a>
                </div>
                </div>
            </div>
        </nav>
        <div class="row mt-5">
            <div class="col-9">

                <form action="index.php" method="GET">
                    <input type="text" value="<?=$searchTerm?>" name="searchTerm" placeholder="Pretraga" class="form-control my-3">
                </form>

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Email</th>
                            <th>Država</th>
                            <th>Grad</th>
                            <th>Izmjena</th>
                            <th>Brisanje</th>
                        </tr>
                    </thead>

                    <?php 

                        foreach($contacts as $contact){
                            
                            $first_name = $contact['first_name'];
                            $last_name = $contact['last_name'];
                            $email = $contact['email'];
                            $city_name = $contact['city_name'];
                            $country_name = $contact['country_name'];

                            $id = $contact['id'];


                            echo "
                                <tr>
                                    
                                    <td>$first_name</td>
                                    <td>$last_name</td>
                                    <td>$email</td>
                                    <td>$city_name</td>
                                    <td>$country_name</td>
                                    <td>
                                        <a href='edit.php?id=$id' class='btn - btn-success'>izmjena</a>
                                    </td>
                                    <td>
                                        <a href='deleteContact.php?id=$id' class='btn - btn-danger'>brisanje</a>
                                    </td>
                                </tr>";
                        }

                    ?>        
                </table>
            </div>
            <div class="col-3   ">
                <h3>Dodavanje novog kontakta</h3>
                <form action="saveContact.php" method="POST" enctype="multipart/form-data">
                    <input type="text" required class="mt-3 form-control" name="first_name" placeholder="Unesite ime...">
                    <input type="text" required class="mt-3 form-control" name="last_name" placeholder="Unesite prezime...">
                    <input type="email" required class="mt-3 form-control" name="email" placeholder="Unesite email...">
                    
                    <select name="country_id" id="country_id" class="form-control mt-3" onchange="displayCities()">
                        <option value="" selected disabled>- odaberite državu -</option>
                        <?php 
                            $countries = getCountries();
                            while($country = mysqli_fetch_assoc($countries)){
                                $countryId = $country['id'];
                                $countryName = $country['name'];
                                echo "<option value=\"$countryId\" >$countryName</option>";
                            }
                        ?>
                    </select>

                    <select name="city_id" id="city_id" class="form-control mt-3">
                    </select>


                    <button class="btn float-end mt-3 btn-primary">Dodaj kontakt</button>
                </form>
            </div>
        </div>

    </div>

    <script src="app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>

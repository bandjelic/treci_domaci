<?php 
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";
    
    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
    $CitySearchTerm = "";

    if(isset($_GET['CitySearchTerm']) && $_GET['CitySearchTerm'] != ""){
        $searchTerm = $_GET['CitySearchTerm'];
        $cities = getCitiesFromDatabase($_GET['CitySearchTerm']);
    }else{
        $cities = getCitiesFromDatabase();
        
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet">
    <title>Cities</title>
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
            <div class="col-8">
                <form action="cities.php" method="GET">
                    <input type="text" value="<?=$CitySearchTerm?>" name="CitySearchTerm" placeholder="Pretraga" class="form-control my-3">
                </form>
                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Drzava</th>
                            <th>Izmjena</th>
                            <th>Brisanje</th>
                        </tr>
                    </thead>

                    <?php 

                        foreach($cities as $city){
                            
                            $name = $city['name'];
                            $id = $city['id'];
                            $country_name = $city['country_name'];


                            echo "
                                <tr>
                                    
                                    <td>$name</td>
                                    <td>$country_name</td>
                                    <td>
                                        <a href='editCity.php?city_id=$id' class='btn - btn-success'>izmjena</a>
                                    </td>
                                    <td>
                                        <a data-target='#myModal-$id' data-toggle='modal'
                                            href='#myModal-$id' class='btn - btn-danger'>brisanje</a>
                        
                                    </td>
                                </tr>
                                <div class='modal' id='myModal-$id'>
                                <div class='modal-dialog '>
                                    <div class='modal-content'>
                        
                                        <div class='modal-body'>
                                        <p>Da li stvarno zelite da obrisete grad?</p>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Zatvori</button>
                                            <a href='deleteCity.php?city_id=$id' role='button' class='btn btn-danger' >Obrisi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                                
                                
                                ";
                            

                        }

                    ?>        
                </table>
            </div>
            <div class="col-4   ">
                <h3>Dodavanje novog grada</h3>
                <form action="saveCity.php" method="POST" enctype="multipart/form-data">

                <select name="country_id" id="country_id" class="form-control mt-3"">
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

                    <input type="text" required class="mt-3 form-control" name="CityName" placeholder="Unesite ime grada...">



                    <button class="btn float-end mt-3 btn-primary">Dodaj grad</button>
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

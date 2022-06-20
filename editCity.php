<?php 
    include "connectDB.php";
    include "databaseFunctions.php";

    if(isset($_GET['city_id'])){
        $city = findCityById($_GET['city_id']);
    }else{
        header("location:cities.php");
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cities</title>
</head>
<body>
    
    <div class="container">

    <form action="updateCity.php" method="POST" enctype="multipart/form-data">
        <div class="row mt-5">
        

            <div class="col-6 offset-1">
                <h3>Izmjena grada</h3>
                    
                <select name="country_id" id="country_id" class="form-control mt-3">
                        <option value="" selected disabled>- odaberite državu -</option>
                        <?php 
                            $countries = getCountries();
                            while($country = mysqli_fetch_assoc($countries)){
                                $countryId = $country['id'];
                                $countryName = $country['name'];
                                $selected = "";
                                if($countryId == $city['country_id']){
                                    $selected = "selected";
                                }
                                echo "<option value=\"$countryId\" $selected >$countryName</option>";
                            }
                        ?>
                    </select>
                    <input type="hidden" name="city_id" value="<?=$city['id']?>">
                    <input type="text" required class="mt-3 form-control" name="CityName" placeholder="Unesite ime grada..." value="<?=$city['name']?>">
                

                    <button class="btn float-end mt-3 btn-primary">Izmijeni grad</button>
            </div>
        </div>
    </form>

    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

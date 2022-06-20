<?php 
    include "connectDB.php";
    include "databaseFunctions.php";

    if(isset($_GET['country_id'])){
        $country = findCountryById($_GET['country_id']);
    }else{
        header("location:countries.php");
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Countries</title>
</head>
<body>
    
    <div class="container">

    <form action="updateCountry.php" method="POST" enctype="multipart/form-data">
        <div class="row mt-5">
        

            <div class="col-6 offset-1">
                <h3>Izmjena drzave</h3>
                    
                    <input type="hidden" name="country_id" value="<?=$country['id']?>">
                    <input type="text" required class="mt-3 form-control" name="CountryName" placeholder="Unesite ime drzave." value="<?=$country['name']?>">

                    <button class="btn float-end mt-3 btn-primary">Izmijeni grad</button>
            </div>
        </div>
    </form>

    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>


    <div class="container">
        <div class="row mt-3">
        <?php 
        include "connectDB.php";
        include "databaseFunctions.php";
    
        

        if(isset($_GET['city_id'])){
            $id = $_GET['city_id'];
        }else{
            header("location:cities.php");
        }


        if(deleteCity($id)){
            header("location:cities.php");
        }
        else{
            echo "  <div class='alert alert-danger' role='alert'>
                        Ne mogu se obrisati povezani podaci!
                    </div>
                    <a href='cities.php' class='btn - btn-success mt -3'>Vrati se</a>
                    
                    ";
                    
                    
        }
        ?>
        
        
        </div>
    
    
    </div>







    <script src="app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>












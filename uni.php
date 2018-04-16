<?php
require("vendor/autoload.php");

use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Skapa en HTTP-client
$client = new Client();

// Anropa URL: http://unicorns.idioti.se/
$res = $client->request('GET', 'http://unicorns.idioti.se/',
['headers' => ['Accept'=> 'application/json']]);

// Omvandla JSON-svar till datatyper
$data = json_decode($res->getBody());


//print_r($data);

$log = new Logger('InlämningsUppgift 1');
$log->pushHandler(new StreamHandler('greetings.log', Logger::INFO));

$name = $_GET['all'];
$log->info($name);
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="style.css">
    <title>Enhörningar!</title>
  </head>
  <body>
    <h1>Enhörningar!</h1>


   <form action="unispec.php" method="get" id="unicornform">
             <div class="form-group">
                 <input type="text" id="name" name="id" class="form-control">
             </div>

             <div class="form-group">
                 <input type="submit" name="one" value="Visa Enhörning" class="btn btn-success">
             </div>
   </form>

   <form action="uni.php" method="get" id="unicornform">
           <div class="form-group">
            <input type="submit" name="all" value="Visa Alla Enhörningar" class="btn btn-primary">
           </div>
   </form>



   <div class="containter">
     <ul class="list-group">
        <?php
        if(isset($_GET['all']))
        {
             for ($i=0; $i < sizeof($data); $i++)
             {
             if($data[$i]->name != "")
             {
               echo '<li class="list-group-item">'.$data[$i]->name.'
               <form action="unispec.php" method="get" id="unicornform">
               <div class="form-group">

                 <button name= "id" value="'.$data[$i]->id.'" type="submit">Läs mer</button>
               </div>
               </form>
               </li>';
             }
          }
        }

        ?>

     </ul>
   </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>

<?php

$expire = time() - 3600;

setcookie('username', '', $expire, '/', 'localhost', false, true);
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Support tickets</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <style>
        body {
            max-width: 1200px;
            width: 100%;
            margin: auto;
        }
    </style> 
  </head>

  <body>
  <?php require_once 'ticket-nav.php'?>


    <h2 class="text-primary">You have successfully log out</h2>
    <div class="d-fex text-center">
        <form action="ticket-login.php" method="post" >
                    <input type="submit" class="button btn btn-primary align-middle" name="ticket-listing" value="Back to Log in"/>
        </form>
    </div>
    
  </body>

</html>
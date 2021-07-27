<?php
$xml = simplexml_load_file("xml/users.xml");

if(isset($_POST['login'])){
    //get values from form and assign to local variable
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $login = false;

    foreach($xml->children() as $p){
        if($user == $p->account->username && password_verify($pass, $p->account->password)){
            
            $expire = time() + 3600;

            setcookie('username', $user, $expire, '/', 'localhost', false, true);
            setcookie('role', $p->attributes()->role, $expire, '/', 'localhost', false, true);
            setcookie('id', $p->id, $expire, '/', 'localhost', false, true);
            setcookie('province', 'ON', $expire, '/', 'localhost', false, true);
            $login =  true;
            header('Location: ticket-listing.php');
            
        }
    }
    if(!$login){
        echo "Incorrect Username/Password";
    }
}
$xml->asXml('xml/users.xml');
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
    <h2>Login form</h2>
      <div class="d-flex">
        
        
        <form method="post" action="ticket-login.php" >
            <div class="form-group">
                <label for='username'>Username: </label>
                <input type='text' class="form-control" id="username" name="username" placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label for='password'>Password: </label>
                <input type='password' class="form-control" id="password" name="password" placeholder="Enter you password">
            </div>
            <input type="submit"  class="button btn btn-primary" name="login" value="Login" />
        </form>
        
      </div>
    </body>
  

</html>
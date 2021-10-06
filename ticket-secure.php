<?php

if(!isset($_SESSION['username'])){
    header('Location: ticket-login.php');
}
?>
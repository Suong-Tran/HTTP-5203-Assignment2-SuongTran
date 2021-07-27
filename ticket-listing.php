<?php
require_once 'ticket-secure.php';
$rows = '';

$xml = simplexml_load_file("xml/tickets.xml");
$xml->asXml('xml/tickets.xml');


$role = $_COOKIE['role'];
$id = $_COOKIE['id'];
$name = $_COOKIE['name'];

if($role == 'admin'){
    foreach ($xml->children() as $p) {
        $datetime = new DateTime($p->messages->message[0]->attributes()->date);
        $rows .= '<tr>';
        $rows .= '<th>' .$p->attributes()->id .'</th>';
        $rows .= '<td>'. $datetime->format('Y-m-d') .'</td>';
        $rows .= '<th>'. ucfirst($p->attributes()->status) .'</th>';
        $rows .= '<td>'. $p->messages->message[0]->attributes()->id .'</td>';
        $rows .= '<td>'. $p->subject .'</td>';
        $rows .= '<td>'.    '<form action="ticket-detail.php" method="post">
                            <input type="hidden" name="id" value="'. $p->attributes()->id . '"/>
                            <input type="submit" class="button btn btn-primary" name="ticketDetail" value="Detail"/>
                            </form>'
                . '</td>';
        $rows .= '<tr>';
      }
} else {
    foreach ($xml->children() as $p) {
        if($p->messages->message[0]->attributes()->id == $id){
            $datetime = new DateTime($p->messages->message[0]->attributes()->date);
            $rows .= '<tr>';
            $rows .= '<th>' .$p->attributes()->id .'</th>';
            $rows .= '<td>'. $datetime->format('Y-m-d') .'</td>';
            $rows .= '<th>'. ucfirst($p->attributes()->status) .'</th>';
            $rows .= '<td>'. $p->messages->message[0]->attributes()->id .'</td>';
            $rows .= '<td>'. $p->subject .'</td>';
            $rows .= '<tr>';
        }
        
      }
}

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
    <h2 class="text-info">Hello <?=$name?></h2>
    <table class="table">
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Date Opened</th>
          <th>Status</th>
          <th>Client ID</th>
          <th>Ticket Subject</th>
          <th><th>
        </tr>
      </thead>
      <tbody>
        <?php print $rows; ?>
      </tbody>
    </table>
  </body>
</html>
<?php

$xml = simplexml_load_file("xml/tickets.xml");


$id = "";
if(isset($_POST['ticketDetail'])){
    $id = $_POST['id'];
}
else if(isset($_POST['update-status'])){
    $id = $_POST['id'];
    resolved($xml,$id);
}
$xml->asXml('xml/tickets.xml');

$contents = $datetime = $status = '';
foreach ($xml->children() as $p) {
    if($p->attributes()->id == $id){
        $datetime = new DateTime($p->messages->message[1]->attributes()->date);
        $status = ucfirst($p->attributes()->status);
        foreach($p->messages->children() as $m){
            $dt = new DateTime($m->attributes()->date);
            $contents .= 'User ID: ' . $m->attributes()->id . '  Posted: ' . $dt->format('Y-m-d') .' <br>';
            $contents .= $m . '<br><br>';
        }
    }
    
  }

function resolved($xml,$id){
    foreach ($xml->children() as $p) {
        if($p->attributes()->id == $id){
            $p->attributes()->status = "resolved";
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
</head>
  <body>
      
        <h1>Ticket Details</h1>
        <div class="d-flex justify-content-between">
            <form action="ticket-listing.php" method="post">
                <input type="submit" class="button btn btn-primary" name="ticket-listing" value="Return"/>
            </form>
            <form action="ticket-detail.php" method="post">
                <input type="hidden" name="id" value=" <?= $id ?> "/>
                <input type="submit" class="button btn btn-primary" name="update-status" value="Solved"/>
            </form>
        </div>
        
      <p>Ticket number: <?=$id?> </p>
      <p>Open date: <?= $datetime->format('Y-m-d') ?>
      <p>Status: <?= $status?></p>
    <div>
        <?php print $contents ?>
    </div>
  </body>
</html>
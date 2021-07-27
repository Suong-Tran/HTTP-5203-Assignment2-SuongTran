<?php
$contents = $datetime = $status = '';
$xml = simplexml_load_file("xml/tickets.xml");

$xml->asXml('xml/tickets.xml');
if(isset($_POST['ticketDetail'])){
    $id = $_POST['id'];
}


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
  ?>
  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Support tickets</title>
  </head>
  <body>
      <h1>Ticket Details</h1>
      <p>Ticket number: <?=$id?> </p>
      <p>Open date: <?= $datetime->format('Y-m-d') ?>
      <p>Status: <?= $status?></p>
    <div>
        <?php print $contents ?>
    </div>
  </body>
</html>
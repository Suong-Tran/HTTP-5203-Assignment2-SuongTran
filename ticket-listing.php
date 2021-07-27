<?php
$rows = '';
$xml = simplexml_load_file("xml/tickets.xml");

$xml->asXml('xml/tickets.xml');

foreach ($xml->children() as $p) {
    $datetime = new DateTime($p->messages->message[1]->attributes()->date);
    $rows .= '<tr>';
    $rows .= '<th>'. '<a href = "book.php?id='.$p->attributes()->id .'">' .$p->attributes()->id .'</a></th>';
    $rows .= '<td>'. $datetime->format('Y-m-d') .'</td>';
    $rows .= '<th>'. ucfirst($p->attributes()->status) .'</th>';
    $rows .= '<td>'. $p->messages->message[1]->attributes()->id .'</td>';
    $rows .= '<td>'. $p->subject .'</td>';
    $rows .= '<tr>';
  }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Support tickets</title>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Date Opened</th>
          <th>Status</th>
          <th>Client ID</th>
          <th>Ticket Subject</th>
        </tr>
      </thead>
      <tbody>
        <?php print $rows; ?>
      </tbody>
    </table>
  </body>
</html>
<?php
$rows = '';
$xml = simplexml_load_file("xml/tickets.xml");

$xml->asXml('xml/tickets.xml');

foreach ($xml->children() as $p) {
    $datetime = new DateTime($p->messages->message[1]->attributes()->date);
    $rows .= '<tr>';
    $rows .= '<th>' .$p->attributes()->id .'</th>';
    $rows .= '<td>'. $datetime->format('Y-m-d') .'</td>';
    $rows .= '<th>'. ucfirst($p->attributes()->status) .'</th>';
    $rows .= '<td>'. $p->messages->message[1]->attributes()->id .'</td>';
    $rows .= '<td>'. $p->subject .'</td>';
    $rows .= '<td>'.    '<form action="ticket-detail.php" method="post">
                        <input type="hidden" name="id" value="'. $p->attributes()->id . '"/>
                        <input type="submit" class="button btn btn-primary" name="ticketDetail" value="Detail"/>
                        </form>'
            . '</td>';
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
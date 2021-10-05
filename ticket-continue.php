<?php
require_once 'ticket-secure.php';
session_start();
$xml = simplexml_load_file("xml/tickets.xml");

$userId = $_COOKIE['id'];
$id = $messContent = "";
if (isset($_POST['ticketContinue'])) {
    $id = $_POST['id'];
} else if (isset($_POST['send-message'])) {
    $id = $_POST['id'];

    $messContent = htmlspecialchars($_POST['mess-content']);
    updateMess($xml, $id, $messContent, $userId);
}
$xml->asXml('xml/tickets.xml');

$contents = $datetime = $status = $style = '';
foreach ($xml->children() as $p) {
    if ($p->attributes()->id == $id) {
        $datetime = new DateTime($p->messages->message[1]->attributes()->date);
        $status = ucfirst($p->attributes()->status);
        foreach ($p->messages->children() as $m) {
            $dt = new DateTime($m->attributes()->date);
            $contents .= '<div ><p class="text-danger">User ID: ' . $m->attributes()->id . '  Posted: ' . $dt->format('Y-m-d') . ' </p>';
            if ($m->attributes()->id == $userId) {
                $style = "border rounded bg-primary text-white text-right";
            } else {
                $style = "border rounded bg-info text-white text-left";
            }
            $contents .= '<p class="' . $style . '">' . $m . '</p> <br></div>';
        }
    }
}

function updateMess($xml, $id, $content, $userId)
{
    foreach ($xml->children() as $p) {
        if ($p->attributes()->id == $id) {
            $mess = $p->messages;
            $attribute = $mess->addChild('message', $content);
            $attribute->addAttribute('id', $userId);
            $attribute->addAttribute('date', date("Y-m-d") . "T" . date("h:i:s"));
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
    <?php require_once 'ticket-nav.php' ?>
    <h1 class="text-info">Ticket Details</h1>
    <div class="d-flex justify-content-between">
        <form action="ticket-listing.php" method="post">
            <input type="submit" class="button btn btn-secondary" name="ticket-listing" value="Return" />
        </form>
    </div>

    <p class="text-secondary">Ticket number: <?= $id ?> </p>
    <p class="text-secondary">Open date: <?= $datetime->format('Y-m-d') ?>
    <p class="text-secondary">Status: <?= $status ?></p>
    <div>
        <?php print $contents ?>
    </div>
    <div>
        <form action="ticket-continue.php" method="post">
            <input type="hidden" name="id" value=" <?= $id ?> " />
            <div class="input-group pb-3">

                <div class="form-group green-border-focus" style="width:100%;">
                    <label for="mess-content">Enter your chat:</label>
                    <textarea rows="5" class="form-control" name="mess-content" id="mess-content"></textarea>
                </div>

            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-outline-primary btn-lg mb-3" name="send-message" value="Send" />
            </div>
        </form>
    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $cart = $_SESSION['cart'];
    $firstName = $_REQUEST['firstName'];
    $lastName = $_REQUEST['lastName'];
    $adress = $_REQUEST['adress'];
    $phone = $_REQUEST['phone'];

    $db = new mysqli('localhost', 'root', '', 'ristorante');
    $q = $db->prepare("INSERT INTO zamowienia VALUES (NULL,?,?,?,?)");
    $q->bind_param('ssss', $firstName, $lastName, $adress, $phone);
    $q->execute();
    $orderID = $db->insert_id;

    $q= $db->prepare("INSERT INTO orderedfood VALUES (NULL,?,?)");

    foreach($cart as $foodid) {
        $q->bind_param('ii', $orderID, $foodid);
        $q->execute();
    }
    ?>
</body>
</html>
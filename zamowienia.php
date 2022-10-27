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
    session_start();
    if(isset($_REQUEST['id'])){
        if(isset($_SESSION['cart'])) {
            array_push($_SESSION['cart'], $_REQUEST['id']);
        } else {
            $_SESSION['cart'] = array();
            array_push($_SESSION['cart'], $_REQUEST['id']);
        }
    }
    if(isset($_REQUEST['remove']))
    array_splice($_SESSION['cart'], $_REQUEST['remove'], 1);
    if (isset($_SESSION['cart'])) {
        $db = new mysqli('localhost', 'root', '', 'ristorante');
        $q = "SELECT nazwa, cena, id FROM dania";
        $result = $db->query($q);
        $names = array();
        $prices = array();
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['nazwa'];
            $price = $row['cena'];
            $names[$id] = $name;
            $prices[$id] = $price;
        }
        echo '<table>';
        $sum = 0;
        foreach($_SESSION['cart'] as $id -> $cartItem) {
            echo '<tr>';
            echo '<td>'.$names[$cartItem].'</td>';
            echo '<td>'.$prices[$cartItem]. '</td>';
            echo '<td><a href="zamowienia.php?remove='.$id.'"Usuń</a>';
            echo '</tr>';
            $sum += $prices[$cartItem];
        }
        echo '</table>';

        echo 'Suma zamówienia: '.$sum.'zł';
    } else {
        echo 'Koszyk jest pusty!';
    }
    ?>
    <p>Podaj swoje dane aby zamówić</p>
    <form action="order.php">
        <label for="firstName">Imie:</label>
        <input type="text" name="firstName">
        <label for="lastName">Nazwisko:</label>
        <input type="text" name="lastName">
        <label for="adress">Adres:</label>
        <input type="text" name="adress">
        <label for="phone">Numer telefonu:</label>
        <input type="text" name="phone">
    </form>
</body>
</html>
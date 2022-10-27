<?php 
$db = new mysqli('localhost', 'root', '', 'ristorante');

$q = "SELECT nazwa, cena, times_ordered FROM dania";

$result = $db->query($q);
while($row = $result->fetch_assoc()) {
    echo '<p>'.$row['nazwa']."<br>";
    echo $row['cena'].'<br>';
    echo $row['times_ordered'].'<br></p>';
}



?>
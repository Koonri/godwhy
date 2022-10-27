<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Aby zarejestrować się do newslettera wpisz email
    <div class="That's all">
    <form action="newsletter.php" method="POST">
        <label for="Zarejestruj"> Wpisz Email:</label><br>
        <input type="text" name="email" id="email">
        <input type="submit" value="Zarejestruj">
    </form>
    </div>
    <?php 
    $db = new mysqli('localhost', 'root', '', 'ristorante');
    $email = $_REQUEST['email'];
    $q = $db->prepare('INSERT INTO newsletter(email) VALUES (?)');
    $q->bind_param('s', $email);
    $q->execute();
    $db->close();


    ?>
</body>
</html>
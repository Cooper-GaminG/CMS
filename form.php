<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <title>Formulier</title>
</head>
<body>
    
    <form action="verzend.php" method="post">
    <fieldset>
        <legend>Persoonsgegevens</legend>
    <label for="username">Naam</label>
    <input type="text" name="username" id="username" required>

    <label for="email">Email</label>
    <input type="email" name="email" required>

    <input type="submit" name="submit" value="Verzend">

    </fieldset>
    </form>    
</body>

</html>

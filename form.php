<?php 

?>

<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <title>Log in Form</title>
</head>
<body>
    
    <form action="verzend.php" method="post">
    <fieldset>
        <legend>Persoonsgegevens</legend>
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required>
    
    <label for="email">E-Mail</label>
    <input type="email" name="email" required>
    
    <label for="password">Password</label>
    <input type="password" name="password" required>

    <input type="submit" name="submit" value="Submit">

    </fieldset>
    </form>    
</body>

</html>
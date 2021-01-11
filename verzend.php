<?php
//var_dump($_POST);
if(isset($_POST["submit"])){

    $servername = "localhost";
    $username = "mpg-cms";
    $password = "pAFvMPmbs5ssqRs2";
    $database = "mpg-cms";

    $sql = "INSERT INTO users (username, password, email, role)
    VALUES ('1', 'Wereld', 'Hallo')";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO users (username, password, email, role)
    VALUES (:username, :password, :email, :role)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':role', $role);
  
    // insert a row
    $username = $_POST["username"];
    $password = "random";
    $email = $_POST["email"];
    $role = "user";
    $stmt->execute();    

    echo "New record created successfully";

    } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    }
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<?php

    if(isset($_POST["submit"])){
        echo "<h1>Formulier is verzonden</h1>" . "<br>"; // . = concat = aan elkaar plakken

        echo "<p>" . $_POST["username"] . "</p><br>";
        echo $_POST["email"];
    }

?>

</body>
</html>

<?php
//var_dump($_POST);
if(isset($_POST["submit"])){

    $servername = "localhost";
    $username = "mpg-cms";
    $password = 'Kqqme9lcYmS8rmzH';
    $database = "mpg-cms";

    // $sql = "INSERT INTO users (username, password, email, role)
    // VALUES (:username, :password, :email, :role)";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //inserts into the users table inside the database
    // $stmt = $conn->prepare("INSERT INTO users (username, password, email, role)
    // VALUES (:username, :password, :email, :role)");
    // $stmt->bindParam(':username', $username);
    // $stmt->bindParam(':password', $password);
    // $stmt->bindParam(':email', $email);
    // $stmt->bindParam(':role', $role);

    
  
    // creates a new user inside the database
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $role = 'user';

    $sql = 'INSERT INTO users(username, password, email, role) VALUES(:username, :password, :email, :role)';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email, 'role' => $role]);
    
      

   // echo "User successfully created";

    $_SESSION['username'] = $username;

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
    <link rel="stylesheet" href='main_style.css'>
</head>
<body>

<?php

    if(isset($_POST["submit"])){
        //echo "<h1>Formulier is verzonden</h1>" . "<br>"; // . = concat = aan elkaar plakken

        echo "<p>Welcome " . $_POST["username"] . "</p><br>";

    }

    
?>




</body>
</html>

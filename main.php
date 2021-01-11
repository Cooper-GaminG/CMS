<?php
$servername = "localhost";
$username = "mpg-cms";
$password = "u8E6ZraShTHo0e0F";
$database = "mpg-cms";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*
  $sql = "INSERT INTO pages (author, content, title)
  VALUES ('1', 'Wereld', 'Hallo')";
  // use exec() because no results are returned
  $conn->exec($sql);
*/

  $sql = "SELECT users.id, users.username pages.id pages.content pages.title
         FROM users INNER JOIN pages ON users.id=pages.author";
  // query voorbereiden
  $stmt = $conn->prepare($sql);
  // query uitvoeren
  $stmt->execute();
  // haal het resultaat op
  $result = $stmt->setFetchMode(PDO::FETCH_OBJ);

  $pages = $stmt->fetchAll();

  //var_dump($users);

} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<!-- 
CRUD
Create = INSERT Query
Read = SELECT Query
Update= UPDATE Query
Delete = DELETE Query

ARRAY = in principe een LIJST
-->

<?php

  foreach( $pages as $page ) {
    //var_dump($user);
    echo "<p>" . $page->id . "</p>";
    echo "<p>" . $page->username . "</p>";
    echo "<h2>" . $page->title . "</h2>";
    echo "<p>" . $page->content . "</p>";
  }

?>


</body>
</html>
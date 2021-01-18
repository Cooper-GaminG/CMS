<?php
$pages= '';
$sql= '';

$servername = "localhost";
$username = "mpg-cms";
$password = "Kqqme9lcYmS8rmzH";
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

  $sql = "SELECT users.id, users.username, pages.id, pages.content, pages.title
         FROM users INNER JOIN pages ON users.id=pages.author";
  // query voorbereiden
  $stmt = $conn->prepare($sql);
  // query uitvoeren
  $stmt->execute();
  // haal het resultaat op
  $result = $stmt->setFetchMode(PDO::FETCH_OBJ);

  $pages = $stmt->fetchAll();

  //CREATES A NEW USER INTO THE 'users' DATABASE
  //PASSWORD IS NOG NIET BEVEILIGD
  // $username = '';
  // $password = '';
  // $email = '';
  // $role = '';

  // $sql = 'INSERT INTO users(username, password, email, role) VALUES(:username, :password, :email, :role)';
  // $stmt = $conn->prepare($sql);
  // $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email, 'role' => $role]);
  // echo 'User Created';

  //DELETES USER
  // $username = 'Kevin';

  // $sql = 'DELETE FROM users WHERE username = :username';
  // $stmt = $conn->prepare($sql);
  // $stmt->execute(['username' => $username]);
  // echo 'User Deleted';

  //$sql is hier $conn
  //CREATE
  //INSERT POST THROUGH CODE, THIS SHOULD HAPPEN; ECHO->POST ADDED AND IT SHOULD CREATE A NEW PAGE INSIDE THE DATABASE

  // $title = '';
  // $content = '';
  // //maybe, every user gets his own author number, they fill that in and it'll show the same way as it shows the users username
  // $author = '';

  // $sql = 'INSERT INTO pages(title, content, author) VALUES(:title, :content, :author)';
  // $stmt = $conn->prepare($sql);
  // $stmt->execute(['title' => $title, 'content' => $content, 'author' => $author]);
  // echo 'Post Added';

  //UPDATE
  // $id = 32;
  // $content = 'This is the updated post';

  // $sql = 'UPDATE pages SET content = :content WHERE id = :id';
  // $stmt = $conn->prepare($sql);
  // $stmt->execute(['content' => $content, 'id' => $id]);
  // echo 'Post Updated';

  //DELETE
  // $id = 32;

  // $sql = 'DELETE FROM pages WHERE id = :id';
  // $stmt = $conn->prepare($sql);
  // $stmt->execute(['id' => $id]);
  // echo 'Post Deleted';

  //READ, search for posts through database
  $search = '%t%';
  $sql = 'SELECT * FROM pages WHERE title LIKE ?';
  $stmt = $conn->prepare($sql);
  $stmt->execute([$search]);
  $pages = $stmt->fetchAll();

  foreach($pages as $page){
    echo $page['title'] . '<br>' ;
  }

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

ARRAY = in principe gewoon een LIJST
-->

<?php
// if(is_array($pages))
//   foreach( $pages as $page ) {
//     //var_dump($user);
//     echo "<p>" . $page->id . "</p>";
//     echo "<p>" . $page->username . "</p>";
//     echo "<h2>" . $page->title . "</h2>";
//     echo "<p>" . $page->content . "</p>";
//   }

?>


</body>
</html>
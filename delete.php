<?php
    $servername = "localhost";
    $username = "mpg-cms";
    $password = 'Kqqme9lcYmS8rmzH';
    $database = "mpg-cms";

    // $sql = "INSERT INTO users (username, password, email, role)
    // VALUES (:username, :password, :email, :role)";
    // CONNECTION WITH DATABASE
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    } catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href='main_style.css'>
</head>
<body>
    
<?php

$msg = '';
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $conn->prepare('SELECT * FROM pages WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Post doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $conn->prepare('DELETE FROM pages WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the post!';
            echo "<a class='button' href='verzend.php'>Back</a>";
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('Please specify the ID number in the search bar. Like this: to delete the post with ID number 1 add ?id=1 at the end of the url. 
    <br><br> The url should then look like this: localhost:8080/CMS/delete.php?id=1
    <br><br> You can find the ID number by going to the READ page and checking in the table');
}

?>

<div class="content delete">
	<h2>Delete Post #<?=$contact['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete post #<?=$contact['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$contact['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>



</body>
</html>
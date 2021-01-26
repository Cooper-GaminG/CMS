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
    <title>Create</title>
    <link rel="stylesheet" href='main_style.css'>
</head>
<body>

<?php

$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $author = isset($_POST['author']) ? $_POST['author'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['content']) ? $_POST['content'] : '';
    $post_date = isset($_POST['post_date']) ? $_POST['post_date'] : date('Y-m-d H:i:s');
    $post_update = isset($_POST['last_update']) ? $_POST['last_update'] : date('Y-m-d H:i:s');
    $image = isset($_POST['image']) ? $_POST['image'] : '';
    // Insert new record into the pages table
    $stmt = $conn->prepare('INSERT INTO pages(title, content, post_date, last_update) VALUES (?, ?, ?, ?)');
    $stmt->execute([$title, $content, $post_date, $post_update]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<div class="content update">
	<h2>Create Post</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <label for="name">Content</label>
        <input type="text" name="content" placeholder="Content" id="content">
        <!-- <label for='content'>Author</label>
        <input type='text' name='author' placeholder='username' id='author'> -->
        <label for="title">Image</label>
        <input type="text" name="image" placeholder="Image" id="image">
        <label for="created">Post Date</label>
        <input type="datetime-local" name="post_date" value="<?=date('Y-m-d\TH:i')?>" id="post_date">
        <label for="created">Post Update</label>
        <input type="datetime-local" name="post_update" value="<?=date('Y-m-d\TH:i')?>" id="post_update">
        <label for='content'>Title</Title></label>
        <input type='text' name='title' placeholder='Title' id='title'>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<br>
<a class='button' href='verzend.php'>Back</a>

</body>
</html>

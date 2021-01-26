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
    <title>Update</title>
    <link rel="stylesheet" href='main_style.css'>
</head>
<body>
<?php 
$msg = '';
// Check if the post id exists, for example update.php?id=1 will get the post with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $content = isset($_POST['content']) ? $_POST['content'] : '';
        $image = isset($_POST['image']) ? $_POST['image'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $last_update = isset($_POST['last_update']) ? $_POST['last_update'] : date('Y-m-d H:i:s');
        // Update the record
        $stmt = $conn->prepare('UPDATE pages SET id = ?, content= ?, image = ?, title = ?, last_update = ? WHERE id = ?');
        $stmt->execute([$id, $content, $image, $title, $last_update, $_GET['id']]);
        $msg = 'Updated Successfully!';
        echo "<a class='button' href='verzend.php'>Back</a>";
    }
    // Get the contact from the contacts table
    $stmt = $conn->prepare('SELECT * FROM pages WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$post) {
        exit('Post doesn\'t exist with that ID!');
    }
} else {
    exit('Please specify the ID number in the search bar. Like this: to update the post with ID number 1 add ?id=1 at the end of the url. 
    <br><br> The url should then look like this: localhost:8080/CMS/update.php?id=1
    <br><br> You can find the ID number by going to the READ page and checking in the table');
}
?>

<div class="content update">
	<h2>Update post #<?=$post['id']?></h2>
    <form action="update.php?id=<?=$post['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="1" value="<?=$post['id']?>" id="id">

        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Employee" value="<?=$post['title']?>" id="title">

        <label for="name">Content</label>
        <input type="text" name="content" placeholder="John Doe" value="<?=$post['content']?>" id="content">

        <label for="email">Image</label>
        <input type="text" name="image" placeholder="johndoe@example.com" value="<?=$post['image']?>" id="image">

        <label for="created">Update Date</label>
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($post['created']))?>" id="created">

        <input type="submit" value="Update">
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- <label for="id">ID</label>
        <input type="text" name="id" placeholder="26" value="auto" id="id">

        <label for="name">Content</label>
        <input type="text" name="content" placeholder="Content" id="content">

        <label for="title">Image</label>
        <input type="text" name="image" placeholder="Image" id="image">

        <label for="created">Post Date</label>
        <input type="datetime-local" name="post_date" value="<?=date('Y-m-d\TH:i')?>" id="post_date">

        <label for="created">Post Update</label>
        <input type="datetime-local" name="post_update" value="<?=date('Y-m-d\TH:i')?>" id="post_update">

        <label for='content'>Title</Title></label>
        <input type='text' name='title' placeholder='Title' id='title'>

        <input type="submit" value="Create"> -->
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>


</body>
</html>
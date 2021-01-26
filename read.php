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

    // Get the page via GET request (URL param: page), if non exists default the page to 1
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    // Number of records to show on each page
    $records_per_page = 50;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
</head>
<body>

<?php 
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $conn->prepare('SELECT * FROM pages ORDER BY post_date LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_posts = $conn->query('SELECT COUNT(*) FROM pages')->fetchColumn();
?>

<div class="content read">
	<h2>Read Posts</h2>
	<a href="create.php" class="create-contact">Create Post</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Author</td>
                <td>Title</td>
                <td>Content</td>
                <td>Post Date</td>
                <td>Last Update</td>
                <td>Image</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td><?=$post['id']?></td>
                <td><?=$post['author']?></td>
                <td><?=$post['title']?></td>
                <td><?=$post['content']?></td>
                <td><?=$post['post_date']?></td>
                <td><?=$post['last_update']?></td>
                <td><?=$post['image']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$post['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$post['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_posts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>



</body>
</html>
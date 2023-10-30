<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:connexion.php');
    exit;
}
try {
    $base = new PDO('mysql:host=localhost;dbname=site', 'root', '');
} catch (Exception $e) {
    die('erreur:' . $e->getMessage());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $show = $base->prepare('SELECT * FROM crud WHERE id = :id');
    $show->bindParam(':id', $id, PDO::PARAM_INT);
    $show->execute();
    $info = $show->fetch(); // Fetch the single record
} else {
    // Handle error when ID is not provided
    die("ID is missing.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <title>crud</title>
</head>
<body>
    <?php include_once('header.php') ?>
    <section>
        <div class="container">
            <h1 class='text-center my-5'>Update Record</h1>
            <div class="mt-5">
                <form method="post" action="update_process.php">
                    <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $info['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $info['mail']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $info['phone']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>

<?php
 $index=true;
 try {
    $base=New PDO('mysql:host=localhost;dbname=site','root','');
} catch (Exeption $e) {
    die('erreur:' .$e->getMessage());
}
 $show=$base->prepare('SELECT * FROM crud');
 $show->execute();
 $info=$show->fetchAll();
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
            <h1 class='text-center my-5'>crud in php</h1>
            <div>
                <a href='adduser.php' type="button" class="btn btn-primary font-bold">add users</a>
            </div>
            <div class="mt-5">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                        <th scope="col">id</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">number</th>
                        <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($info as $info): ?>
                            <tr>
                                <th scope="row"><?php echo $info['id']; ?></th>
                                <td><?php echo $info['name']; ?></td>
                                <td><?php echo $info['mail']; ?></td>
                                <td><?php echo $info['phone']; ?></td>
                                <td><a href="update.php?id=<?php echo $info['id']; ?>" type="button" class="btn btn-secondary">Update</a>

                                <a href='delete.php?id=<?php echo $info['id']?>' type="button" class="btn btn-danger p-4">delete</a></td>
                        </tr>
                        <?php endforeach; ?>
                       
                    </tbody>

                </table>

            </div>
        </div>
    </section>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:connexion.php');
    exit;
}
 $adduser=true;
try {
    $base=New PDO('mysql:host=localhost;dbname=site','root','');
} catch (Exeption $e) {
    die('erreur:' .$e->getMessage());
}
if(isset($_POST['send'])){
   if($_POST['name'] !=''&& $_POST['mail'] !=''&& $_POST['phone'] !=''){
    $insert=$base->prepare('INSERT INTO crud(name,mail,phone) VALUES(:name,:mail,:phone)');
    $insert->execute([
        'name'=>$_POST['name'],
        'mail'=>$_POST['mail'],
        'phone'=>$_POST['phone'],

    ]);
   }
}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>adduser</title>
</head>
<body>
    <?php include_once('header.php') ?>
    <div class="container mt-4">
        <form action="adduser.php" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name and firstname</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name and firstname">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" name="mail" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">number phone</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" name="phone" placeholder="number phone">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary font-bold" name='send'>send </button>        
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
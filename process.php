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
if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $mail=$_POST['mail'];
    $phone=$_POST['phone'];
    
    $update=$base->prepare('UPDATE crud SET name=:name,mail=:mail,phone=:phone where id=:id');
    $update->bindParam(':id', $id,PDO::PARAM_INT);
    $update->bindParam(':name', $name,PDO::PARAM_STR);
    $update->bindParam(':mail', $mail,PDO::PARAM_STR);
    $update->bindParam(':phone', $phone,PDO::PARAM_STR);
    if($update->execute()){
        header('location:index.php');
    }else{
        echo 'faild';
    }
  
}


?>
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Update the record in the database
    $update = $base->prepare('UPDATE crud SET name = :name, mail = :email, phone = :phone WHERE id = :id');
    $update->bindParam(':name', $name, PDO::PARAM_STR);
    $update->bindParam(':email', $email, PDO::PARAM_STR);
    $update->bindParam(':phone', $phone, PDO::PARAM_STR);
    $update->bindParam(':id', $id, PDO::PARAM_INT);

    if ($update->execute()) {
        // Redirect back to the list after update
        header("Location: index.php");
    } else {
        echo "Update failed.";
    }
}
?>

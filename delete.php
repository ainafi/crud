<?php 
try {
    $base = new PDO('mysql:host=localhost;dbname=site', 'root', '');
} catch (Exception $e) {
    die('erreur:' . $e->getMessage());
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $show=$base->prepare('SELECT * FROM crud where id=:id');
    $show->bindParam(':id',$id,PDO::PARAM_INT);
    $show->execute();
    $info=$show->fetch();
}
if(isset($_POST['delete'])){
   $id=$_POST['id'];
   $sql="DELETE FROM crud WHERE id=$id";
   if($base->query($sql)==TRUE){
    echo "<h2 class='bg-success'>delete succesfully</h2>";
   }
   else{
    echo "<h2 class='bg-danger text-uppercase text-light p-4'>try again</h2>";
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
    <title>supression</title>
</head>
<body>
<?php include_once('header.php') ?>
    <div class="container">
        <h1 class='text-center'>delete list</h1>
        <form action="" method="post">
            <input type="hidden" id='id' name="id" value='<?php echo $info['id']?>'>
            <button name="delete" value="delete" class='btn btn-danger'>delete</button>
        </form>
    </div>
</body>
</html>
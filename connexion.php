<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=site', 'root', '');
} catch (Exception $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
// inscription de l'utilisateur et envoie de l'utilisateur a la base de donnee

if (isset($_POST['signIn'])) {
    // verifier si la formulaire est vide 
    if (empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['password'])) {
        echo '<h4 class="bg-danger">Formulaire vide</h4>';
    } else {
        // Vérifier si l'utilisateur existe déjà
        $select = $db->prepare('SELECT * FROM users WHERE name = :name');
        $select->execute(['name' => $_POST['name']]);
        $result = $select->fetch();

        if ($result) {
            echo "<h4 class='bg-danger'>Lutilisateur existe déjà</h4>";
        } else {
            $insertIn = $db->prepare('INSERT INTO users (name, phone, password) VALUES (:name, :phone, :password)');
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
           
            $result = $insertIn->execute([
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'password' => $password
            ]);

            if ($result) {
                echo '<h4 class="bg-success">Inscription réussie</h4>';
            } else {
                echo '<h4 class="bg-danger">Erreur lors de l\'inscription : ' . $db->errorInfo()[2] . '</h4>';
            }
        }
    }
}

// connexion si l'utilisateur est enregistrer
if(isset($_POST['name']) && isset($_POST['password'])){
    $name=$_POST['name'];
    $password=$_POST['password'];

    $select=$db->prepare('SELECT * FROM users WHERE name=:name');
    $select->execute([
        'name'=>$name,
    ]);

    $user=$select->fetch();
    if($user && password_verify($password ,$user['password'])){
        session_start();
        $_SESSION['user_id']=$user['id'];
        header('location:index.php');
    }
    else{
        echo 'introuvable';
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
    <title>connexion</title>
</head>
<body>
    <main class="px-4 py-5 my-5 ">
        <div class="container">
            
            <div class="row ">
                <div class="col-md-6">
                    <div class="card">
                        <h4 class="p-3 mb-2 text-capitalize text-center">sign in</h4>
                        <form action="" method="post" class="p-4">
                            <label class="mb-1">name</label>
                            <input
                             type="text"
                             name="name"
                             class="form-control"
                             placeholder="your name here">
                            <label class="mb-1">phone</label>
                            <input
                             type="text"
                             name="phone"
                             class="form-control"
                             placeholder="your phone here">
                            <label class="mb-1">password</label>
                            <input
                             type="password"
                             name="password"
                             class="form-control ">
                             <button name="signIn" class=" mt-3 btn btn-primary" type="submit">sign in</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h4 class="text-center p-3 mb-2">sign up</h4>
                        <form action="" method="post" class="p-4">
                            <label class="mb-1">name</label>
                            <input
                             type="text"
                             name="name"
                             class="form-control"
                             placeholder="your phone here">
                            <label class="mb-1">password</label>
                            <input
                             type="password"
                             name="password"
                             class="form-control"
                            >
                             <button class=" p mt-3 btn btn-secondary" name="signUp" type="submit">sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
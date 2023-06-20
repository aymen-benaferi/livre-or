<?php

require_once('include.php');

$var = "Formulaire d'inscription";

if (isset($_POST['submit'])) {
    // Récupérer les valeurs du formulaire
    $login = $_POST['login'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];

    // Crypter le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Connexion à la base de données
    $conn = mysqli_connect('localhost', 'root', 'azerty', 'moduleconnexion');

    // Vérifier la connexion
    if (!$conn) {
        die("Erreur de connexion à la base de données: " . mysqli_connect_error());
    }

    // Requête d'insertion des données dans la table "user"
    $sql = "INSERT INTO `user` (`login`, `firstname`, `lastname`, `password`) VALUES ('$login', '$firstname', '$lastname', '$hashedPassword')";

    // Exécution de la requête
    if (mysqli_query($conn, $sql)) {
        echo "Inscription réussie.";
    } else {
        echo "Erreur lors de l'inscription: " . mysqli_error($conn);
    }

    // Fermer la connexion
    mysqli_close($conn);
}
?>

<!doctype html>
<html lang="fr">
<head>
    <?php
    require_once('_head/meta.php');
    require_once('_head/link.php');
    require_once('_head/script.php');
    ?>
    <title>Inscription</title>
</head>
<body>
<?php
require_once('_menu/menu.php');
?>
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6 ">
            <h1><?php echo $var ?></h1>
        <form action="inscription.php" method="post">
            <div class="mb-4">
                <input type="text" class="form-control" name="login" placeholder="Login:">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" name="firstname" placeholder="Firstname:">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" name="lastname" placeholder="Lastname:">
            </div>
            <div class="mb-4">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="mb-4">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <div><p>Already Registered <a href="connexion.php">Login Here</a></p></div>
        </div>   
        <div class="col-3"></div>
    </div>     
</div>
<?php
require_once('_footer/footer.php');
?>
</body>
</html>

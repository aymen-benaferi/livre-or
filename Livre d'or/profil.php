<?php
// Connect to the database
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'azerty';
$dbName = 'livreor'; // Utilisez le nom correct de votre base de données

// Créez la connexion à la base de données
$DB = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Vérifiez si la connexion a échoué
if (!$DB) {
    die("La connexion à la base de données a échoué: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Échappez les caractères spéciaux dans les données pour éviter les injections SQL
    $login = mysqli_real_escape_string($DB, $login);
    $password = mysqli_real_escape_string($DB, $password);

    // Mettez à jour le profil de l'utilisateur dans la base de données
    $query = "UPDATE `user` SET `login` = '$login', `password` = '$password' WHERE `id` = 1"; // Assurez-vous d'ajuster la condition WHERE selon votre logique d'identification de l'utilisateur
    $result = mysqli_query($DB, $query);

    if ($result) {
        echo "Profil updated successfully.";
    } else {
        echo "Failed to update profile: " . mysqli_error($DB);
    }
}

mysqli_close($DB);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier le profil</title>

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

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6 ">
                    <div class="mb-4">
                        <input type="text" class="form-control" name="login" placeholder="Login:" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" class="form-control" name="password" placeholder="Password:" required>
                    </div>
                    <div class="form-btn">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        </div>
    </form>

</body>

</html>

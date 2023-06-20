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
    $comment = $_POST['commentaire'];

    // Échappez les caractères spéciaux dans le commentaire pour éviter les injections SQL
    $comment = mysqli_real_escape_string($DB, $comment);

    // Insert the comment into the database
    $query = "INSERT INTO `comment` (`comment`, `id_user`, `date`) VALUES ('$comment', 1, NOW())";
    $result = mysqli_query($DB, $query);

    if ($result) {
        echo "Comment added successfully.";
    } else {
        echo "Failed to add comment: " . mysqli_error($DB);
    }
}

mysqli_close($DB);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un commentaire</title>

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

    <h1>Ajouter un commentaire</h1>

    <form method="POST" action="commentaire.php">
        <label for="commentaire">Commentaire :</label><br>
        <textarea id="commentaire" name="commentaire" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Ajouter le commentaire">
    </form>

    <?php
    require_once('_footer/footer.php');
    ?>

</body>

</html>


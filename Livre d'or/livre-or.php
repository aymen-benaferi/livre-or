<?php
// Connect to the database
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'azerty';
$dbName = 'comment'; // Utilize the correct name of your database

// Create the database connection
$DB = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Check if the connection failed
if (!$DB) {
    die("Connection to the database failed: " . mysqli_connect_error());
}

// Retrieve comments from the database, ordered by the most recent
$query = "SELECT * FROM comments ORDER BY date DESC";
$result = mysqli_query($DB, $query);

// Check if there are any comments
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $commentDate = date('d/m/Y', strtotime($row['date']));
        $commentUser = $row['id_user'];
        $commentText = $row['comment'];

        echo "Posté le $commentDate par $commentUser: $commentText<br>";
    }
} else {
    echo "Aucun commentaire trouvé.";
}

mysqli_close($DB);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Livre d'or</title>
</head>
<body>
    <?php
    // Check if the user is connected
    $connectedUser = true; // Replace with your logic to check if the user is connected

    // Display the link to the comment page if the user is connected
    if ($connectedUser) {
        echo '<a href="commentaire.php">Ajouter un commentaire</a>';
    }
    ?>
</body>
</html>

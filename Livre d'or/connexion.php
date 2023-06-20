<?php
include_once('_db/connexionDB.php');

if (!empty($_POST)) {
    extract($_POST);

    $valid = true;

    if (isset($_POST['connexion'])) {
        $login = trim($login);
        $password = trim($password);

        if (empty($login)) {
            $valid = false;
            $err_login = "Ce champ doit être rempli";
        } else {
            $req = $DB->prepare('SELECT id FROM utilisateur WHERE login = ?');
            $req->execute(array($login));
            $row = $req->fetch();

            if (!empty($row['id'])) {
                $valid = false;
                $err_login = "Ce login est déjà pris";
            }
        }

        if (empty($password)) {
            $valid = false;
            $err_password = "Ce champ doit être rempli";
        } elseif ($password !== $repeatpassword) {
            $valid = false;
            $err_password = "Le mot de passe est incorrect";
        }

        if ($valid) {
            echo 'ok';
            // insertion dans notre base de données
        } else {
            echo 'no ok';
            // rien
        }
    }
}

$var = "Connexion";
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
                <form action="connexion.php" method="post">
                    <div class="mb-4">
                        <input type="text" class="form-control" name="login" placeholder="Login:">
                    </div>
                    <div class="mb-4">
                        <input type="password" class="form-control" name="password" placeholder="Password:">
                    </div>
                    <div class="form-btn">
                        <input type="submit" class="btn btn-primary" value="Register" name="connexion">
                    </div>
                </form>
                <div>
                    <div>
                        <p>Already Registered <a href="inscription.php">Login Here</a></p>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <?php
    require_once('_footer/footer.php');
    ?>
</body>

</html>

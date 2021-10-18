<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conciergerie Lédonienne - Inscription</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php session_start();

//Première chose à faire se connecter à la base de données

// DB Online
// define('HOST', 'localhost');
// define('USER', 'dylanc903');
// define('PASSWD', 'kHDQ4b191wu1nQ==');
// define('DBNAME', 'dylanc903_');
// DB Local
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWD', '');
define('DBNAME', 'conciergerie_ledonienne');


try {
	$db = new PDO("mysql:host=". HOST .";dbname=". DBNAME, USER, PASSWD, [
		// Gestion des erreurs PHP/SQL
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		// Gestion du jeu de caractères
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		// Choix du retours des résultats
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	]);


	//echo 'Base de données connectée';
}
catch (Exception $error) {
	// Attrape une exception
	echo 'Erreur lors de la connexion à la base de données : '. $error->getMessage();
}


?>
<div class="signin-title fixed-top">
a
</div>
<main>
    <form method="post">
        <input type="text" name="username" placeholder="Entrez votre login" value="">
        <input type="text" name="first-name" placeholder="Entrez votre Prénom" value="">
        <input type="text" name="last-name" placeholder="Entrez votre Nom" value="">
        <input type="password" name="password" placeholder="Entrez votre mot de passe" value="">
        <input type="submit" value="Inscription">
    </form>
<main>

<?php
if(isset($_POST['username']) && isset($_POST['password']) && (!empty($_POST['username'])) && (!empty($_POST['password']))){
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $firstName = strip_tags($_POST['first-name']);
    $lastName = strip_tags($_POST['last-name']);

    $create_user = 'INSERT INTO utilisateurs(name_user, pass_user, firstname_user, lastname_user) VALUES (:username, :password, :firstname, :lastname)';
    $query = $db->prepare($create_user);
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->bindValue(':password', $password, PDO::PARAM_STR);
    $query->bindValue(':firstname', $firstName, PDO::PARAM_STR);
    $query->bindValue(':lastname', $lastName, PDO::PARAM_STR);
    $query->execute();

    echo 'Votre compte a bien été créé, vous pouvez désormais vous connecter.';
    header('Refresh:2; url=../index.php');
}
?>

</body>
</html>
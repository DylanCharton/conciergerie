<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Conciergerie Lédonienne - Connexion</title>
</head>
<body id="login-bg">
    

<?php session_start();

//Première chose à faire se connecter à la base de données

// DB Online
define('HOST', 'localhost');
define('USER', 'dylanc903');
define('PASSWD', 'kHDQ4b191wu1nQ==');
define('DBNAME', 'dylanc903_');
// DB Local
// define('HOST', 'localhost');
// define('USER', 'root');
// define('PASSWD', '');
// define('DBNAME', 'conciergerie_ledonienne');


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
<!-- CONNEXION FORM -->
<section class ="justify-content-center align-items-center d-flex login">
    <form method="post" class="login-form d-flex flex-column justify-content-center">
        <h2 class="text-center mb-4 login-title">Connexion</h2>
        <label for="username" class="label-login">Pseudo :</label>
        <input type="text" name="username" value="invite" required size="40">
        <label for="password" class="mt-3 label-login">Mot de passe :</label>
        <input type="password" name="password" class="label-login" value="invite" size="40" required>
        <input type="submit" value="Se connecter" class="btn btn-success mt-4 mb-2">
        <p class="text-center">Pas de compte ? <a href="./signin.php">Créez-le.</a></p>
        <?php 
if(isset($_POST['username']) && isset($_POST['password']) && (!empty($_POST['username'])) && (!empty($_POST['password']))){
    // Here I define my variables and secure them
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    // Here I create the query
    $check = 'SELECT * FROM utilisateurs WHERE name_user = :login';
    // I prepare the query
    $query = $db->prepare($check);
    // I bind the login param to my $username input field value
    $query-> bindValue(':login', $username, PDO::PARAM_STR);

    $user= $query->execute();
    // I put the result of the query in the $user variable
    $user = $query->fetch(PDO::FETCH_ASSOC);
    

    // Then I have to check if the username corresponds to what is in my DB
    // So I start by checking if it is different from a username in my DB
    if(!$user){
        echo '<div class="alert alert-danger text-center" role="alert">
        Cet utilisateur n\'existe pas.
                </div>';
        // If it is, do the "else" part and verify the password
    } else {
        if(password_verify($password, $user['pass_user'])){
            $_SESSION['concierge_connected']=true;
            $_SESSION['firstname']= $user['firstname_user'];
            $_SESSION['lastname']= $user['lastname_user'];
            header('location: ../index.php');
        } else {
            echo '<div class="alert alert-danger text-center" role="alert">
            Le mot de passe saisi est invalide.
                </div>';
        }
    }
}
?>
<p class="alert alert-info">Vous ne voulez pas de compte ? Utilisez notre compte invité en cliquant directement sur "Se connecter"</p>
    </form>
</section>





</body>
</html>
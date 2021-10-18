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
<!-- CONNEXION FORM -->
<form method="post">
    <input type="text" name="username" placeholder="Entrez votre login" value="">
    <input type="password" name="password" placeholder="Entrez votre mot de passe" value="">
    <input type="submit" value="Se connecter">
</form>

<p>Pas de compte ? <a href="./signin.php">Créez-le.</a></p>

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
        echo "Cet utilisateur n'existe pas";
        // If it is, do the "else" part and verify the password
    } else {
        if(password_verify($password, $user['pass_user'])){
            $_SESSION['concierge_connected']=true;
            $_SESSION['firstname']= $user['firstname_user'];
            $_SESSION['lastname']= $user['lastname_user'];
            header('location: ../index.php');
        } else {
            "Le mot de passe est invalide";
        }
    }
}
?>
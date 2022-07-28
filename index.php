<<<<<<< HEAD

<?php
// hote : localhost - mysql.monserveur.com
// nom de la base formation_users
// login : root
//mdp //root

?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
</head>
<body>
     
</body>
</html>


<?php 

//mysql créer une base de données dans phpmyadmin
//formation_users


//1e table
//users nombre de colonnes 4 id prenom nom serie_preferee

//valeurs dans cette table voir onglets SQL et Insérer dans phpmyadmin

//se connecter à notre table  Connect/OPERATIONS (LIRE/ECRIRE/MODIFIER/SUPPRIMER)
//3 manières de se connecter 1 mysql_ =>mySQL, obsolète / 2 mysqli_ => mySQL, amélioréées utilisées de temps en temps/
// 3 PDO => très sécurisé mySQL, Oracle, PostgreSQL très utilisé dans le monde pro
//activer pdo sous windows activer php_pdo_mysql sous wamp mais sous xampp



//récupérer données et les afficher
//ajouter données et les afficher
//ajouter données
//modifier données dans une table
//supprimer données dans une table
//Avoir plus d'infos sur nos erreurs mysql
//jointures entre plusieurs tables internes
//jointures entre plusieurs tables externes






//envoi fichier php enctype="multipart/form-data" permet de stocker l'image de manière temporaire
// <input type="file" name="image"/><br /> type file car je veux envoyer un fichier

// On teste Si on reçoit bien une image et&& on vérifie que l'image est bien réceptionnée sinon error
// if (isset($_FILES ['image']) && $_FILES ['image']['error']==0){

//      if ($_FILES  ['image']['size'] <= 3000000){

//           $informationImage = pathinfo($_FILES['image']['name']);
//           $extensionImage =  $informationImage['extension'];
//           $extensionArray =  array('png','gif','jpg','jpeg');

//           if(in_array($extensionImage,$extensionArray)){

//                move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'.time().rand().rand().'.'.$extensionImage);
//          echo'Envoi bien réussi !';
//           }
//      }
// // 1 mo = 1 000 000 d'octets on créé u tableau contenant les informations de l'image

// }


// $_FILES['image']['name']// NOM voir cette ligne  le fichier se nomme image <input type="file" name="image"/><br /> 
//la deuxième case correspond au nom name c'est l'option


// $_FILES['image']['tmp_name']// le fichier est placé temporairement dans le serveur
// $_FILES['image']['type']// TYPE
// $_FILES['image']['size']//SIZE
// $_FILES['image']['error']//ERREUR il va contenir une erreur on vérifie si l'image a bien été réceptionnée

// echo '<form method="post" action ="index.php" 
//    enctype="multipart/form-data">
//               <p>
//                  <h1>Formulaire</h1>
//                  <input type="file" name="image"/><br />
//                  <button type="submit">Envoyer</button>
//               </p>
//               </form>';




?>


<?php

//exo1 début if isset = s'il existe
//dans son cours j'apprends à sécuriser avec htmlspecialchars
// if (isset($_POST['prenom'])&&isset($_POST['nom'])) {

//                    $prenom = htmlspecialchars($_POST['prenom']);
//                    $nom = htmlspecialchars($_POST['nom']);
//      echo'Bonjour '.$prenom.'  '.$nom.' !';

// }

// echo'<form method="post" action="index.php">
//     <p>
//           <table>
//                <tr>
//                <td>Prénom</td>
//                <td><input type="text" name="prenom"/></td>
//                </tr>

//                <tr>
//                <td>Nom</td>
//                <td><input type="text" name="nom"/></td>
//                </tr>

//           </table>

//           <button type="submit">Envoyer</button>
//     </p>



// </form>'exo1fin







//if (isset($_POST['nom'])) $nom = $_POST['nom'];
// else $nom = "(Inconnu)";

// echo <<<_END

// <html>
// <head>
// <title>Formulaire de test </title>
// </head>

// <body>
// Ton nom est : $nom<br>
// <form method="post" action="index.php">
// Quel est ton nom ?
// <input type="text" name="nom">
// <input type="submit">
// </form>
// </body>

// </html>

//_END;
?> 

<?php

// Tableau (id, prenom, nom, age)
// afficher l'âge dans 50 ans
//Bonjour, nom prenom dans 50 asn vous aurez x ans.
//   $identitePersonneA= array (
//          'id'=>15,
//          'prenom'=>'Nicolas',
//          'nom'=>'Dupont',
//          'age'=>'34'
//   );


//   $age_supplementaire = $identitePersonneA['age'] + 50;

// echo 'Bonjour '.$identitePersonneA['nom'].'   '.$identitePersonneA['prenom'].' dans 50 ans vous aurez  '.$age_supplementaire.' ans.';

//Super j'ai trouvé ça seul c'est un miracle


//âge mineur majeur conditions if
     // $age = 10;
     // if($age > 18) {

     //        echo "Vous êtes majeur/e.";

     // }

     // if($age <18) {

     //      echo "Vous êtes mineur/e.";

     // }

?>



=======
<?php
session_start();

require("src/connection.php");
 
	if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm'])){
 
		// VARIABLE
 
		$pseudo       = $_POST['pseudo'];
		$email        = $_POST['email'];
		$password     = $_POST['password'];
		$pass_confirm = $_POST['password_confirm'];
 
		// TEST SI PASSWORD = PASSWORD CONFIRM
 
		if($password != $pass_confirm){
				header('Location: index.php?error=1&pass=1');
					exit();
 
		}
 
		// TEST SI EMAIL UTILISE
		$req = $db->prepare("SELECT count(*) as numberEmail FROM users WHERE email = ?");
		$req->execute(array($email));
 
		while($email_verification = $req->fetch()){
			if($email_verification['numberEmail'] != 0) {
				header('location: index.php?error=1&email=1');
				exit();
 			}
		}
 
		// HASH
 		$secret = sha1($email).time();
		$secret = sha1($secret).time().time();
 
		// CRYPTAGE DU PASSWORD
 		$password = "aq1".sha1($password."1254")."25";
 
		// ENVOI DE LA REQUETE
 		$req = $db->prepare("INSERT INTO users(pseudo, email, password, secret) VALUES(?,?,?,?)");
		$value = $req->execute(array($pseudo, $email, $password, $secret));
			
		header('location: index.php?success=1');
		exit();
 
 	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP et MySQL : la formation ULTIME</title>
	<link rel="icon" type="image/png" href="/logo.png">
	<link rel="stylesheet" type="text/css" href="design/default.css">
</head>
 
<body>
	<header>
		<h1>Inscription</h1>
	</header>

	<div class="container">

		<?php
		if(!isset($_SESSION['connect'])){ ?>

		<p id="info">Bienvenue sur mon site, pour en voir plus, inscrivez-vous. Sinon, <a href="connection.php">Connectez-vous.</a></p>

		<?php
		 
			if(isset($_GET['error'])){
		 
				if(isset($_GET['pass'])){
					echo '<p id="error">Les mots de passe ne correspondent pas.</p>';
				}
				else if(isset($_GET['email'])){
					echo '<p id="error">Cette adresse email est déjà utilisée.</p>';
				}
			}
			else if(isset($_GET['success'])){
				echo '<p id="success">Inscription prise correctement en compte.</p>';
			}
		 
		?>
	 
	 	<div id="form">
			<form method="POST" action="index.php">
				<table>
					<tr>
						<td>Pseudo</td>
						<td><input type="text" name="pseudo" placeholder="Ex : Nicolas" required></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="email" name="email" placeholder="Ex : example@google.com" required></td>
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td><input type="password" name="password" placeholder="Ex : ********" required ></td>
					</tr>
					<tr>
						<td>Retaper mot de passe</td>
						<td><input type="password" name="password_confirm" placeholder="Ex : ********" required></td>
					</tr>
				</table>
				<div id="button">
					<button type='submit'>Inscription</button>
				</div>
			</form>
		</div>

		<?php } else { ?>
		
		<p id="info">
			Bonjour <?= $_SESSION['pseudo'] ?><br>
			<a href="disconnection.php">Déconnexion</a>
		</p>

		<?php } ?>

	</div>
</body>
</html>
>>>>>>> 146e4e8 (formation Udemy phpmysql terminée j'ai copié le projet de Nicolas Neuillet, j'ai compris comment me connecter via un PDO. Attention l'utilisation du sha6 est obsolète pour ceux qui débutent)

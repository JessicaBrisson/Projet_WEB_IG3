<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Une envie de visite</title>
		<!--Lien police Google-->
		<link href='http://fonts.googleapis.com/css?family=Playball&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<!--Lien Bootstrap-->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<!--Rattachement au CSS-->
		<link href="./CSS/MiseP.css" rel="stylesheet" type="text/css" />
	</head>
    <body style="background:#99ccff">
		<div id="ConfirmationSuppression">
			<!--Bandeau-->
			<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation"> 
				<div class="logo">
					<a href="./index.html" alt="Retour page principal" >
						<img src="./Images/titreBlancD.png" 
						alt="logo" title="Retour page principal" height="100" >
					</a>
				</div>
			</nav>
			<!--Retour écran boite alerte-->
			<div id="Traitement" >
			<?php
				//Test si le champs mail est rempli
				if ($_POST['mail']=="" && $_POST['psw']!="01Projet06Web42"){
					?>
					<div class="container">
						<h2><strong>Alerte</strong></h2>
						<div class="alert alert-danger">
							<strong>ATTENTION!</strong> Vous n'avez pas rempli votre e-mail. </br>
							<a class="btn btn-danger" onclick="history.back()">Retour au formulaire</a>
						</div>
					</div>
					<?php
				} else {
					/*Connexion a une base de donnees*/
					$serveur="localhost";
					$login="root";
					$pass ="";
					$nomBase ="projet_web";
					/*$serveur = "mysql.hostinger.fr";
					$nomBase = "u773229064_based";
					$login = "u773229064_pjtw";
					$pass = "IprojetGweb3";*/
					try{
						$connexion =new PDO("mysql:host=$serveur;dbname=$nomBase",$login,$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
						$connexion ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					}
					catch(PDOException $e){
						echo 'Echec de la connexion:'. $e->getMessage();
					}
					if ($_POST['psw']=="01Projet06Web42"){ //identifiant admin
						// Formulation de la requete
						$suppression = 'DELETE FROM visite WHERE Id_Visite='.$_GET['Identifiant'];
						// Execution de la requete
						$connexion -> query($suppression);
						/*Mail envoyé*/
						?>
							<div class="container">
								<div class="alert alert-success">
									Suppression Réussie</br>
									<a href="./index.html" class="btn btn-success">Retour à l'accueil</a>
								</div>
							</div>
						<?php
					} else { //Utilisateur landa, envoie de mail à administrateur et retour validation à untilisateur
						// Formulation de la requete pour récupérer le nom de la visite
						$query = 'SELECT Nom_Visite, Nom_Ville FROM visite, ville WHERE fk_Ville=Id_Ville AND Id_Visite = '.$_GET['Identifiant'];
						// Execution de la requete
						$reponse=$connexion->query($query);
						//On place les elements de la requete dans un tableau
						$data = $reponse->fetchAll(PDO::FETCH_ASSOC); 
						/*Composition du message*/
						$message= "De: ".$_POST['mail']."\r\n";
						$message.= "Demande de supression : ".$data[0]['Nom_Visite']." dans la ville de ".$data[0]['Nom_Ville'] ."\r\n";
						if ($_POST['message'] != ""){
							$message.="L'internaute a laissé ce commentaire en plus : \r\n";
							$message.=$_POST['message'];
						}
						/*Envoi du mail avec la fonction php mail*/
						$mail=mail("unevilleunevisite@sfr.fr", "Demande de Suppression", $message);
						/*Affichage message si mail envoyé ou non*/
						if ($mail){
							/*Mail envoyé*/
							?>
							<div class="container">
								<div class="alert alert-success">
									Le signalement a bien été envoyé</br>
									<a href="./index.html" class="btn btn-success">Retour à l'accueil</a>
								</div>
							</div>
							<?php
						}else{
							/*Mail non envoyé*/
							?>
							<div class="container">
								<div class="alert alert-warning">
									<strong>ATTENTION!</strong> Le message n'a pas pu être envoyé. Réessayez ultérieurement. </br>
									<a href="./index.html" class="btn btn-warning">Retour à l'accueil</a>
								</div>
							</div>
							<?php
						}
					}
				}
			?>
			</div>
		</div>
		<footer class="navbar-fixed-bottom">
			<p>Copyright BRISSON Jessica - Tous droits réservés
			<a href="./Email.php">Me contacter !</a></p>
		</footer>
	</body>
</html>
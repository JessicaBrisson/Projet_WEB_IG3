<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Une envie de visite</title>
		<!--Lien police Google-->
		<link href='http://fonts.googleapis.com/css?family=Playball&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		<!--Lien Bootstrap-->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<!--Rattachement au CSS-->
		<link href="./CSS/MiseP.css" rel="stylesheet" type="text/css" />
	</head>
	<body style="background:#99ccff">
		<div id="PageValidationEmail">
			<!--Installation de la bare de haut de page-->
			<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation"> 
				<div class="logo">
					<!--Mise en page du logo-->
					<a href="./index.html" alt="Retour page principal" >
						<img src="./Images/titreBlancD.png" 
						alt="logo" title="Retour page principal" height="100" >
					</a>
				</div>
			</nav>
			<div id="traitement">
				<?php
					/*Vérification de la méthode de transmission*/
					if($_SERVER['REQUEST_METHOD'] == 'POST'){
						/*Vérification des valeurs si tout les champs sont remplis*/
						if ($_POST['nom'] != "" && $_POST['email'] != "" &&  $_POST['objet'] != "" &&  $_POST['message'] != ""){
							/*Composition du message*/
							$message='De: "'. $_POST['nom'] .'" '.$_POST['email']."\r\n";
							$message.='Objet: '. $_POST['objet'] ."\r\n";
							$message.=$_POST['message'];
							/*Envoi du mail avec la fonction mail php*/
							$mail=mail("unevilleunevisite@sfr.fr", "Prise de contact", $message);
							/*Affichage message si mail envoyé ou non*/
							if ($mail){
								/*Mail envoyé*/
								?>
								<div class="container">
									<div class="alert alert-success">
										Votre message a été envoyé au gestionnaire du site, une réponse vous sera envoyée sur l'email fourni</br>
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
						}else{
							/*Les champs ne sont pas tous rempli*/
							?>
							<div class="container">
								<h2><strong>Alerte</strong></h2>
								<div class="alert alert-danger">
									<strong>ATTENTION!</strong> Vous n'avez pas rempli tous les champs obligatoires. </br>
									<a href="./Email.php" class="btn btn-danger">Retour à la recherche</a>
								</div>
							</div>
							<?php
						}
					}
				?>
			</div>
		</div>
		<footer class="navbar-fixed-bottom">
			<p>Copyright BRISSON Jessica - Tous droits réservés
		</footer>
	</body>
</html>
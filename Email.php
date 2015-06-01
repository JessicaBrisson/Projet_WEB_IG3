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
		<div id="PageEmail">
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
			<div id="Poste">
				<h1> Me contacter </h1>
				<form method="POST" action="ValiderEmail.php" id="EnvoiEmail" class="well well-lg">
					<p>
						<!--Insertion votre nom-->
						<label for="pays">Votre NOM et Prénom (obligatoire) </label>
						</br>
						<input type="text" name="nom" class="zonetexte">
					</p>
					<BR>
					<p>
						<!--Insertion du email-->
						<label for="pays">Votre email (obligatoire) </label>
						</br>
						<input type="text" name="email" class="zonetexte">
					</p>
					<BR>
					<p>
						<!--Insertion du objet-->
						<label for="pays">Objet </label>
						</br>
						<input type="text" name="objet" class="zonetexte zonespe" >
					</p>
					<BR>
					<p>
						<!--Insertion du message-->
						<label for="pays">Votre message </label>
						</br>
						<textarea name="message"></textarea>
					</p>
					<BR>
					<input type="submit" value="Envoyer" id="submit" class="btn btn-primary">
				</form>
			</div>
			<footer class="navbar-fixed-bottom">
				<p>Copyright BRISSON Jessica - Tous droits réservés
			</footer>
		</div>
	</body>
</html>
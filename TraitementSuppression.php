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
		<div id="TraitementSupp">
			<!--Bandeau-->
			<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation"> 
				<div class="logo">
					<a href="./index.html" alt="Retour page principal" >
						<img src="./Images/titreBlancD.png" 
						alt="logo" title="Retour page principal" height="100" >
					</a>
					<a href="./Inserer.php">
						<span class="glyphicon glyphicon-align-justify" > </span>
					</a>
				</div>
			</nav>
			<!--Formulaire + Rectangle  de couleur-->
			<div id="FormulaireConfirmationSupp" class="well well-lg">
				<!--Determination du formulaire pour traiter la recherche-->
				<?php
					echo('<form method="POST" action="Suppression.php?Identifiant='. $_GET['Identifiant'] .'">');
						/*Connexion a une base de donnees*/
						$serveur = "";
						$nomBase = "";
						$login = "";
						$pass = "";
						try{
							$connexion =new PDO("mysql:host=$serveur;dbname=$nomBase",$login,$pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
							$connexion ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						}
						catch(PDOException $e){
							echo 'Echec de la connexion:'. $e->getMessage();
						}
						// Formulation de la requete
						$query = 'SELECT Nom_Visite FROM visite WHERE  Id_Visite = '.$_GET['Identifiant'];
						// Execution de la requete
						$reponse=$connexion -> query($query);
						//On place les elements de la requete dans un tableau
						$data = $reponse->fetchAll(PDO::FETCH_ASSOC); 
						echo("<p> Êtes vous sûre de vouloir signaler l'article : <strong>".$data[0]['Nom_Visite']."</strong> à administrateur pour qu'il soit supprimmer du site. </p>");
					?>
					<p class="mail">
						<!--Insertion du mail-->
						Saisissez une adresse mail pour vous joindre en cas de besoin : 
						<input type="texte" name="mail">
					</p>
					<p>
						<!--Insertion d'un message-->
						<BR>
						Indiquez, si vous le souhaité, les raisons de ce signalement : </br>
						<textarea name="message"></textarea>
					</p>
					<input class="btn btn-primary" type="bouton" onclick="history.back()" value="Retour Descriptif"/>
					<input class="btn btn-primary" type="submit" value="Valider mon signalement"/>
					<p>
						<!--Insertion du code administrateur-->
						Code Administrateur : 
						<input type="password" name="psw">
					</p>
				</form>
			</div>	
			<footer class="navbar-fixed-bottom">
				<p>Copyright BRISSON Jessica - Tous droits réservés
				<a href="./Email.php">Me contacter !</a></p>
			</footer>
		</div>
	</body>
</html>
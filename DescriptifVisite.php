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
		<div id="DescriptifVisite">
			<!--Bandeau-->
			<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation"> 
				<div class="logo">
					<a href="./index.html" alt="Retour page principal" >
						<img src="./Images/titreBlancD.png" 
						alt="logo" title="Retour page principal" height="100" >
					</a>
					<a href="./Inserer.php" alt="Insérer">
						<span class="glyphicon glyphicon-align-justify" > </span>
					</a>
				</div>
			</nav>
			<div id="RetourRecherche">
				<a onclick="history.back()">Retour au résultat</a>
			</div>
			<div class="well well-lg">
				<div id="boutonSupprimer">
				<?php
					echo('<a href="./TraitementSuppression.php?Identifiant='. $_GET['Identifiant'] .' " alt="Supprimmer">');
				?>
						<span class="glyphicon glyphicon-remove-sign"> </span>
					</a>
				</div>
				<?php
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
					$query = 'SELECT Nom_Visite,Descriptif,Photo,Nom_Pays,Nom_Ville,Nom_Catego FROM visite,ville,pays,categorie ';
					$query .= 'WHERE  Id_Visite = '.$_GET['Identifiant'].' AND fk_Ville = Id_Ville AND fk_Pays = Id_Pays AND fk_Catego = Id_Catego';
					// Execution de la requete
					$reponse=$connexion -> query($query);
					//On place les elements de la requete dans un tableau
					$data = $reponse->fetchAll(PDO::FETCH_ASSOC); 
					//Affichage du titre
					echo('<h1>'.$data[0]['Nom_Visite'].'</h1>');
					if ($data[0]['Photo'] != NULL){
						echo('<div id="PhotoTexte" class="row">');
							echo('<div class="col-md-5">');
								echo ('<img src="'.$data[0]['Photo'].'" alt="'.$data[0]['Nom_Visite'].'" style="width:100%" >');
							echo('</div>');
							echo('<div class="col-md-7">');
								echo('<p><strong><U>Pays</U> : </strong>'.$data[0]['Nom_Pays'].'</br><BR><strong><U>Ville</U> : </strong>'.$data[0]['Nom_Ville']);
								echo ('</br><BR><strong><U>Type</U> : </strong>'.$data[0]['Nom_Catego'].'</br><BR><strong><U>Descriptif</U> : </strong>');
								if ($data[0]['Descriptif'] != NULL){
									echo($data[0]['Nom_Catego']);
								}else{
									echo('<i>La description n\'est pas disponible</i>');
								}
								echo('</p>');
							echo('</div>');
						echo('</div>');
					}else{
						echo('<div id="Texte">');
							echo('<p><strong><U>Pays</U> : </strong>'.$data[0]['Nom_Pays'].'</br><BR><strong><U>Ville</U> : </strong>'.$data[0]['Nom_Ville']);
							echo ('</br><BR><strong><U>Type</U> : </strong>'.$data[0]['Nom_Catego'].'</br><BR><strong><U>Descriptif</U> : </strong>');
							if ($data[0]['Descriptif'] != NULL){
								echo($data[0]['Descriptif']);
							}else{
								echo('<i>La description n\'est pas disponible</i>');
							}
							echo('</p>');
						echo('</div>');
					}
					$reponse->closeCursor();
					
				?>
			</div>
			<footer class="navbar-fixed-bottom">
				<p>Copyright BRISSON Jessica - Tous droits réservés
				<a href="./Email.php">Me contacter !</a></p>
			</footer>
		</div>
	</body>
</html>
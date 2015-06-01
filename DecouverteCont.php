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
		<div id="DecouverteCont">
			<!--Installation de la bare de haut de page-->
			<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation"> 
				<div class="logo">
					<!--Mise en page du logo-->
					<a href="./index.html" alt="Retour page principal" >
						<img src="./Images/titreBlancD.png" 
						alt="logo" title="Retour page principal" height="100" >
					</a>
					<!--Logo Menu-->
					<a href="./Inserer.php">
						<span class="glyphicon glyphicon-align-justify"></span>
					</a>
				</div>
			</nav>
			<div id="Affichage">
				<div id="RetourRecherche">
					<a onclick="history.back()">Retour au Menu</a>
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
					$query = 'SELECT Nom_Continent, Description_Continent FROM continent WHERE  Id_Continent = '.$_GET['Id'];
					// Execution de la requete
					$reponse=$connexion->query($query);
					//On place les elements de la requete dans un tableau
					$data=$reponse->fetchAll(PDO::FETCH_ASSOC); 
					//Affichage du nom continent en titre
					echo('<h1>'.$data[0]['Nom_Continent'].'</h1>');
					//Inscription d'une petite introduction
					echo('<p>'.$data[0]['Description_Continent'].'</p>');
					$reponse->closeCursor();
					//Récupération des pays 
					$pays = 'SELECT Id_Pays,Nom_Pays FROM pays WHERE  fk_Continent = '.$_GET['Id'];
					// Execution de la requete
					$reponse_pays=$connexion -> query($pays);
					//Lecture des résultats un à un
					while($data_pays=$reponse_pays->fetch()){
						//Requete pour trouver les pays dans les catégories de lieux
						$catego='SELECT Id_Catego,Nom_Catego FROM categorie';
						// Execution de la requete
						$reponse_catego=$connexion -> query($catego);
						$tour_boucle=1;			
						while($data_catego=$reponse_catego->fetch()){
							//Requete pour trouver les pays dans les continents
							$requete_final = 'SELECT Id_Visite, Nom_Visite, Photo';
							$requete_final .= ' FROM ville, visite';
							$requete_final .= ' WHERE fk_Ville = Id_Ville AND fk_Catego = '.$data_catego['Id_Catego'];
							$requete_final .= ' AND fk_Pays = '.$data_pays['Id_Pays'];
							// Execution de la requete
							$retour=$connexion->query($requete_final);
							if ($retour->rowCount() > 0){
								if ($tour_boucle==1){
									echo('<fieldset>');
									echo('<legend>'.$data_pays['Nom_Pays'].'</legend>');
									echo('<ul>');
									$tour_boucle++;
								}
								echo('<li>'.$data_catego['Nom_Catego'].'</li>');
								echo('<div class="row">');
								while($data_final=$retour->fetch()){
									echo('<div class="col-md-4">');
										echo('<a href="DescriptifVisite.php?Identifiant='.$data_final['Id_Visite'].'" class="thumbnail">');
										echo('<p>'.$data_final['Nom_Visite'].'</p>'); 
										if ($data_final['Photo'] != NULL){
											echo('<img src="'.$data_final['Photo'].'" alt="'.$data_final['Nom_Visite'].'" style="width:150px">');
										}
										echo('</a>');
									echo('</div>');
								}
								echo('</div>');
							}
						}
						echo('</ul>');
						echo('</fieldset>');
					}
					$reponse_pays->closeCursor();
					$reponse_catego->closeCursor();
					$retour->closeCursor();
				?>
			</div>
			<footer class="navbar-fixed-bottom">
				<p>Copyright BRISSON Jessica - Tous droits réservés
				<a href="./Email.php">Me contacter !</a></p>
			</footer>
		</div>
	</body>
</html>
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
		<div id="PageAffichage">
			<!--Installation de la bare de haut de page-->
			<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation"> 
				<div class="logo">
					<!--Mise en page du logo-->
					<a href="./index.html" alt="Retour page principal" >
						<img src="./Images/titreBlancD.png" 
						alt="logo" title="Retour page principal" height="100" >
					</a>
					<!--Logo Inserer-->
					<a href="./Inserer.php" alt="Insérer">
						<span class="glyphicon glyphicon-align-justify"></span>
					</a>
				</div>
				<!--Onglet-->
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#Continent">Continent</a></li>
					<li><a data-toggle="tab" href="#PageRecherche">Recherche</a></li>
				</ul>
			</nav>
			<!--Definition du corps-->
			<div class="tab-content">
				<div id="Continent" class="tab-pane fade in active">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<!-- Declaration slide -->
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
							<li data-target="#myCarousel" data-slide-to="3"></li>
							<li data-target="#myCarousel" data-slide-to="4"></li>
							<li data-target="#myCarousel" data-slide-to="5"></li>
						</ol>
						<!-- Determination slide-->
						<div class="carousel-inner" role="listbox">
							<!--Slide Afrique-->
							<div class="item active">
								<!--Etablissement du lien vers une autre page-->
								<a href="DecouverteCont.php?Id=4">
									<!--Photo-->
									<img class="Images_Continents" src="./Images/PhotosContinents/Afrique.png" alt="Afrique" title="Cliquez pour découvrir le continent">
									<!--Legende-->
									<div class="carousel-caption">
										<h3>Afrique</h3>
									</div>
								</a>
							</div>
							<!--Slide Amerique du Nord-->
							<div class="item">
								<!--Etablissement du lien vers une autre page-->
								<a href="DecouverteCont.php?Id=1">
									<!--Photo-->
									<img class="Images_Continents" src="./Images/PhotosContinents/Amerique_Nord.png" alt="AmeriqueN" title="Cliquez pour découvrir le continent">
									<!--Legende-->
									<div class="carousel-caption">
										<h3>Amerique du Nord</h3>
									</div>
								</a>
							</div>
							<!--Slide Amerique du Sud-->
							<div class="item">
								<!--Etablissement du lien vers une autre page-->
								<a href="DecouverteCont.php?Id=2">
									<!--Photo-->
									<img class="Images_Continents" src="./Images/PhotosContinents/Amerique_Sud.png" alt="AmeriqueS" title="Cliquez pour découvrir le continent">
									<!--Legende-->
									<div class="carousel-caption">
										<h3>Amerique du Sud</h3>
									</div>
								</a>
							</div>
							<!--Slide Asie-->
							<div class="item">
								<!--Etablissement du lien vers une autre page-->
								<a href="DecouverteCont.php?Id=5">
									<!--Photo-->
									<img class="Images_Continents" src="./Images/PhotosContinents/Asie.png" alt="Asie" title="Cliquez pour découvrir le continent">
									<!--Legende-->
									<div class="carousel-caption">
										<h3>Asie</h3>
									</div>
								</a>
							</div>
							<!--Slide Europe-->
							<div class="item">
								<!--Etablissement du lien vers une autre page-->
								<a href="DecouverteCont.php?Id=3">
									<!--Photo-->
									<img class="Images_Continents" src="./Images/PhotosContinents/Europe.png" alt="Europe" title="Cliquez pour découvrir le continent">
									<!--Legende-->
									<div class="carousel-caption">
										<h3>Europe</h3>
									</div>
								</a>
							</div>
							<!--Slide Oceanie-->
							<div class="item">
								<!--Etablissement du lien vers une autre page-->
								<a href="DecouverteCont.php?Id=6">
									<!--Photo-->
									<img class="Images_Continents" src="./Images/PhotosContinents/Oceanie.png" alt="Oceanie" title="Cliquez pour découvrir le continent">
									<!--Legende-->
									<div class="carousel-caption">
										<h3>Océanie</h3>
									</div>
								</a>
							</div>
						</div>
						<!-- Bouton suivant et precedent -->
						<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Précédent</span>
						</a>
						<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Suivant</span>
						</a>
					</div>	
				</div>
				<!--Page Recherche-->
				<div id="PageRecherche" class="tab-pane fade">
					<!--Titre Page-->
					<div id="Titre">
						<h1> Recherche </h1>
					</div>
					<div class="corp">
						<!--Formulaire + Rectangle  de couleur-->
						<div id="Formulaire" class="well well-lg">
							<!--Determination du formulaire pour traiter la recherche-->
							<form method="POST" action="TraitementRecherche.php" >
								<p>
									<!--Liste deroulante des pays-->
									<label for="pays">Choisisez un pays : </label>
									<select name="pays" id="pays">
										<option value="NULL">------Pays------</option>
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
											$query = "SELECT * FROM continent ORDER BY Nom_Continent";
											// Execution de la requete
											$reponse=$connexion -> query($query);
											while($data=$reponse->fetch()){
												//Requete pour trouver les pays dans les continents
												$requete = 'SELECT DISTINCT(Nom_Pays) FROM pays, ville, visite where fk_Ville = Id_Ville AND fk_pays = Id_Pays AND fk_Continent ='.$data['Id_Continent'].' ORDER BY Nom_Pays';
												// Execution de la requete
												$retour=$connexion->query($requete);
												// Verification du resultat => la requete envoyee a MySQL ainsi que l'erreur. 
												if (!$connexion) {
													$message  = 'Requete invalide : ERREUR\n';
													$message .= 'Requete complète : ' . $query;
													die($message);
												}
												if ($retour->rowCount() > 0){
													echo ('<optgroup label="'.$data['Nom_Continent'].'">');
													//Affichade des resultats
													while($donnee=$retour->fetch()){
														echo ('<option value="'.$donnee['Nom_Pays'].'">'. $donnee['Nom_Pays'] .'</option>');
													}
													echo ('</optgroup>');
												}
											}
											$reponse->closeCursor();
											$retour->closeCursor();
										?>
									</select></br></br>
									<!--Liste deroulante des pays-->
									<label for="ville">Choisisez une ville : </label>
									<select name="ville" id="ville">
											<option value="NULL">------Ville------</option>
										<?php
											// Formulation de la requete
											$query = "SELECT * FROM pays ORDER BY Nom_Pays";
											// Execution de la requete
											$reponse=$connexion -> query($query);
											while($data=$reponse->fetch()){
												//Requete pour trouver les villes dans les pays
												$requete = 'SELECT DISTINCT(Nom_Ville) FROM ville, visite where fk_Ville = Id_Ville AND fk_Pays ='.$data['Id_Pays'].' ORDER BY Nom_Ville';
												// Execution de la requete
												$retour=$connexion->query($requete);
												// Verification du resultat => la requete envoyee a MySQL ainsi que l'erreur. 
												if (!$connexion) {
													$message  = 'Requete invalide : ERREUR\n';
													$message .= 'Requete complète : ' . $query;
													die($message);
												}
												if ($retour->rowCount() > 0){
													echo ('<optgroup label="'.$data['Nom_Pays'].'">');
													//Affichade des resultats
													while($donnee=$retour->fetch()){
														echo ('<option value="'.$donnee['Nom_Ville'].'">'. $donnee['Nom_Ville'] .'</option>');
													}
													echo ('</optgroup>');
												}
											}
											$reponse->closeCursor();
											$retour->closeCursor();
										?>
									</select></br></br>
									<!--Liste deroulante des pays-->
									<label for="categorie">Choisissez le type de lieu souhaite: </label></br>
									<label class="radio-inline">
										<input type="radio" name="type" value="NULL" checked="checked">Pas de preference
									</label>
									<?php
										//Requete pour trouver les villes dans les pays
										$requete = 'SELECT DISTINCT(Nom_Catego) FROM categorie,visite WHERE fk_Catego= Id_Catego ORDER BY Nom_Catego';
										// Execution de la requete
										$retour=$connexion->query($requete);
										// Verification du resultat => la requete envoyee a MySQL ainsi que l'erreur. 
										if (!$connexion) {
											$message  = 'Requete invalide : ERREUR\n';
											$message .= 'Requete complète : ' . $query;
											die($message);
										}
										//Affichade des resultats
										while($donnee=$retour->fetch()){
											echo('<label class="radio-inline">');
											echo ('<input type="radio" name="type" value="'. $donnee['Nom_Catego'].'">'. $donnee['Nom_Catego'] );
											echo('</label>');
										}
										$retour->closeCursor();
									?>
								</p></br>
								<!--Bouton emvoyant directement sur la page de traitement de la requete-->
								<input class="btn btn-primary" type="submit" value="Envoyer"/>
							</form>
						</div>
					</div>
				</div>
			</div>
			<footer class="navbar-fixed-bottom">
				<p>Copyright BRISSON Jessica - Tous droits réservés
				<a href="./Email.php">Me contacter !</a></p>
			</footer>
		</div>
	</body>
</html>
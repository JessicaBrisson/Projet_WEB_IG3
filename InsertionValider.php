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
		<div id="PageInsertionValidation">
			<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation"> 
				<div class="logo">
					<a href="./index.html" alt="Retour page principal" >
						<img src="./Images/titreBlancD.png" 
						alt="logo" title="Retour page principal" height="100" >
					</a>
					<a href="./Menu.php">
						<span class="glyphicon glyphicon-th-large" > </span>
					</a>
				</div>
			</nav>
			<?php
				//Fonction pour sécuriser les données rentrées
				function securisation($donnees){
					//supression des espaces en trop 
					$donnees = trim($donnees);
					//supprime les balises html qui peuvent être insérer
					$donnees = strip_tags($donnees);
					return $donnees;
				}
				$bienRempli = false;
				/*On teste si les 4 variables principal existe*/
				if(isset($_POST['pays']) && isset($_POST['ville']) && isset($_POST['visite']) && isset($_POST['type'])){
					/*On teste leur valeur*/
					if($_POST['pays'] != 'NULL' && $_POST['ville'] != "" &&  $_POST['visite'] != ""){
						/*On regarde la valeur de Pays vu que l'on sait qu'elle n'est pas vide*/
						if($_POST['pays'] == 'Autre'){
							/*On cherche à voir si continent et pays2 sont rempli*/
							if($_POST['continent'] != "" && $_POST['pays2'] != "") {
								/*Toutes les cases existent et ont une valeur correcte donc on passe la variable à true*/
								$bienRempli = true;
							}
						} else {
							/*Vu que toute nos cases existent et qu'elles ne sont pas vide, on passe la variable à true*/
							$bienRempli = true;
						}
					}
				}
				if(!$bienRempli){
					?>
					<!--Message erreur-->
					<div id="erreur" class="container">
						<h2><strong>Alerte</strong></h2>
						<div class="alert alert-danger">
							<strong>ATTENTION!</strong> Vous n'avez pas rempli tous les champs obligatoires. </br>
							<a href="./Inserer.php" class="btn btn-danger" role="button">Retour à la recherche</a>
						</div>
					</div>
					<?php
				} else {
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
					if($_POST['pays'] == 'Autre'){ //Pays n'existe pas donc il doit etre insérer
						/*Récupération de l'Id_Continent*/
						/*Récupération valeur saisie*/
						$valContinent = securisation($_POST['continent']);
						$requeteCont='SELECT Id_Continent FROM continent WHERE Nom_Continent like \''.securisation($valContinent).'\'';
						$continent=$connexion->query($requeteCont);
						if ($continent->rowCount() > 0) { //Recuperation du continent qui existe
							//On place les elements de la requete dans un tableau
							$dataCont = $continent->fetchAll(PDO::FETCH_ASSOC); 
							/*Récupération valeur saisie*/
							$valPays = securisation($_POST['pays2']);
							/*Vérification que le pays soit pas dans la base*/
							$requetePays= 'SELECT Id_Pays FROM pays WHERE Nom_Pays like "'. securisation($valPays).'"';
							$pays=$connexion->query($requetePays);
							/*Insertion si le pays exite pas*/
							if ($pays->rowCount() <= 0) { 
								/*Insérer le nouveau Pays dans la base*/
								$insererPays= 'INSERT INTO pays (Nom_Pays, fk_Continent) VALUES ( \''.securisation($valPays).'\' , '.$dataCont[0]['Id_Continent'].' )';
								$connexion->query($insererPays);
							}
						} else { //Continent pas trouvé Message d'erreur
							?>
							<!--Message erreur-->
							<div id="erreur" class="container">
								<h2><strong>Alerte</strong></h2>
								<div class="alert alert-danger">
									<p><strong>ATTENTION!</strong> Le nom du continent saisie n'est pas bon.</br> 
									Seul : Afrique, Amérique du Nord, Amérique du Sud, Asie, Europe et Océanie sont autorisés. </br></p>
									<a href="./Inserer.php" class="btn btn-danger">Retour à la recherche</a>
								</div>
							</div>
							<?php
						}
					}else{ //Pays existant dans la base
						$valPays = securisation($_POST['pays']);
					}
					/*Récupération de Id_Pays ajouté*/
					$requetePays= 'SELECT Id_Pays FROM pays WHERE Nom_Pays like \''. securisation($valPays).'\'';
					$pays=$connexion->query($requetePays);
					if (!$connexion) {
									$message  = 'Requete invalide : ERREUR\n';
									$message .= 'Requete complète : ' . $query;
									die($message);
								}
					$dataPays = $pays->fetchAll(PDO::FETCH_ASSOC); 
					/*Récupération valeur saisie*/
					$valVille = securisation($_POST['ville']);
					/*Récupération de Id_Ville ajouté*/
					$requeteVille= 'SELECT Id_Ville FROM ville WHERE Nom_Ville like \''. securisation($valVille).'\'';
					$ville=$connexion->query($requeteVille);
					if ($ville->rowCount() <= 0) { //On teste si la ville n'existe pas
						/*Insérer le nouveau ville dans la base*/
						$insererVille= 'INSERT INTO ville (Nom_Ville, fk_Pays) VALUES ( \''.securisation($valVille).'\' , '.$dataPays[0]['Id_Pays'].' )';
						$connexion->query($insererVille);
						/*Récupération de Id_Ville ajouté*/
						$requeteVille= 'SELECT Id_Ville FROM ville WHERE Nom_Ville like \''. securisation($valVille).'\'';
						$ville=$connexion->query($requeteVille);
					}
					$dataVille = $ville->fetchAll(PDO::FETCH_ASSOC); 
					/*Récupération valeur saisie*/
					$valCatego = securisation($_POST['type']);
					/*Récupération de Id_Catego choisi*/
					$requeteCatego= 'SELECT Id_Catego FROM categorie WHERE Nom_Catego like \''. securisation($valCatego).'\'';
					$catego=$connexion->query($requeteCatego);
					$dataCatego = $catego->fetchAll(PDO::FETCH_ASSOC);
					/*Récupération valeur saisie*/
					$valVisite = securisation($_POST['visite']);
					if ($_POST['description']!=""){
						/*Récupération valeur saisie*/
						$valDescription = securisation($_POST['description']);
					} else{
						$valDescription = NULL;
					}
					/*Insérer le nouveau visite dans la base*/
					$insererVisite = 'INSERT INTO visite (Nom_Visite, Descriptif, fk_Catego, fk_Ville) ';
					$insererVisite .= 'VALUES ( \''.securisation($valVisite).'\' , "'.securisation($valDescription).'" , '.$dataCatego[0]['Id_Catego'].' , '.$dataVille[0]['Id_Ville'].' )';
					$connexion->query($insererVisite);
					if (!$connexion) {
									$message  = 'Requete invalide : ERREUR\n';
									$message .= 'Requete complète : ' . $query;
									die($message);
								}
					/*Récupération de Id_Visite inséré*/
					$requeteVisite= 'SELECT Id_Visite FROM visite WHERE Nom_Visite like \''. securisation($valVisite).'\'';
					$visite=$connexion->query($requeteVisite);
					$dataVisite = $visite->fetchAll(PDO::FETCH_ASSOC);
					?>
					<!--Affichage message réussite-->
					<div class="container">
						<div class="alert alert-success">
							Insertion est réussite.</br> Merci d'avoir partagé votre expérience.</br>
							<a href="./index.html" class="btn btn-success" >Retour à l'accueil</a>
							<?php
							echo '<a href="./DescriptifVisite.php?Identifiant='.$dataVisite[0]['Id_Visite'].'" class="btn btn-success">Afficher l\'article</a>';
							?>
						</div>
					</div>
					<?php
				}
			?>
		</div>
		<footer class="navbar-fixed-bottom">
			<p>Copyright BRISSON Jessica - Tous droits réservés
			<a href="./Email.php">Me contacter !</a></p>
		</footer>
	</body>
</html>
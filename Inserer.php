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
		<!--Ajouter une fonction java script pour afficher une zone de texte en plus-->
		<script type="text/javascript">
			function changeFunc() {
				/*Recupere l'element de la liste pays*/
				var creationPays = document.getElementById("pays");
				var selectedValue = creationPays.options[creationPays.selectedIndex].value;
				/*Cas ou la valeur selectionne est 'autre'*/
				if(selectedValue == "Autre"){
					/*determination du texte à afficher*/
					var TexteAAfficher= '<label for="Continent">Indiquez le continent (Obligatoire) :</label><input type="text" name="continent" id="Continent">';
					TexteAAfficher += '<BR><label for="pays2">Indiquez le pays (Obligatoire) :</label><input type="text" name="pays2" id="pays2">';
					document.getElementById("creationPays").innerHTML = TexteAAfficher;
				} else { /*Autre cas que 'autre'*/
					/*On affiche rien*/
					document.getElementById("creationPays").innerHTML = "";
				}
			}
		</script>
	</head>
    <body style="background:#99ccff">
		<!--Haut de page=> logo + page AffichageCont-->
		<div id="PageInsertion">
			<nav id="myNavbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation"> 
				<div class="logo">
					<a href="./index.html" alt="Retour page principal" >
						<img src="./Images/titreBlancD.png" 
						alt="logo" title="Retour page principal" height="100" >
					</a>
					<a href="./Menu.php" alt="Menu Recherche">
						<span class="glyphicon glyphicon-th-large" > </span>
					</a>
				</div>
			</nav>
			<!--Titre Page-->
			<div id="Titre">
				<h1>Inserer</h1>
			</div>
			<div id="Corp">
				<div id="Legende">
					<p>Cette page vous invite à partager vos expériences personnelles et vos découvertes que vous avez pu faire à travers le monde.
					Hésitez pas à partager une place, une avenue, un musée ou un point de vue.</br> A vous de jouez!</br>
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
						$query = "SELECT * FROM mise_a_jour_bd";
						// Execution de la requete
						$reponse=$connexion -> query($query);
						$data=$reponse->fetchAll(PDO::FETCH_ASSOC);
						echo('<strong>Le dernière ajout date du '. $data[0]['Derniere_MAJ'].'</strong>');
					?>
					</p>
				</div>
				<!--Formulaire + Rectangle  de couleur-->
				<div id="FormulaireInsertion" class="well well-lg">
					<!--Determination du formulaire pour traiter la recherche-->
					<form method="POST" action="InsertionValider.php" >
						<p>
							<!--Insertion du Pays-->
							<label for="pays">Choisisez un pays : </label>
								<select name="pays" id="pays" onchange="changeFunc();">
									<option value="NULL">------Pays------</option>
									<option value="Autre"> Autre </option>
							<?php
								// Formulation de la requete
								$query = "SELECT * FROM continent ORDER BY Nom_Continent";
								// Execution de la requete
								$reponse=$connexion -> query($query);
								while($data=$reponse->fetch()){
									//Requete pour trouver les pays dans les continents
									$requete = 'SELECT Nom_Pays FROM pays where fk_Continent ='.$data['Id_Continent'].' ORDER BY Nom_Pays';
									// Execution de la requete
									$retour=$connexion->query($requete);
									// Verification du resultat => la requete envoyee a MySQL ainsi que l'erreur. 
									if (!$connexion) {
										$message  = 'Requete invalide : ERREUR\n';
										$message .= 'Requete complète : ' . $query;
										die($message);
									}
									echo ('<optgroup label="'.$data['Nom_Continent'].'">');
									//Affichade des resultats
									while($donnee=$retour->fetch()){
										echo ('<option value="'.$donnee['Nom_Pays'].'">'. $donnee['Nom_Pays'] .'</option>');
									}
									echo ('</optgroup>');
								}
								$reponse->closeCursor();
								$retour->closeCursor();
							?>
						</select>
						</p>
						<p id="creationPays"></p>
						<BR>
						<p>
							<!--Insertion de la ville-->
							<label for="ville">Indiquez la ville (Obligatoire) :</label>
							<input type="text" name="ville" id="ville" class="zonetexte">
						</p>
						<BR>
						<p>
							<!--Insertion de la visite-->
							<label for="visite">Indiquez le nom de l'ajout (Obligatoire) : </label>
							<input type="text" name="visite" id="visite" class="zonetexte">
						</p>
						<BR>
						<p>
							<!--Insertion de la description-->
							<label for="description">Faites une description qui donne envie à d'autre de s'y rendre : </label>
							</br>
							<textarea name="description"></textarea>
						</p>
						<p>
							<!--Selection du type-->
							</br>
							<label for="type">Indiquez quel type de lieux vous voulez insérer (Obligatoire) : </br> </label>
							</br>
							<?php
								//Requete pour trouver les villes dans les pays
								$requete = 'SELECT Nom_Catego FROM categorie ORDER BY Nom_Catego';
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
							<!--Bouton emvoyant directement sur la page de traitement de la requete-->
							<BR>
							<input class="btn btn-primary" type="submit" value="Valider"/>
						</p>
					</form>
				</div>
			</div>
			<footer class="navbar-fixed-bottom">
				<p>Copyright BRISSON Jessica - Tous droits réservés
				<a href="./Email.php">Me contacter !</a></p>
			</footer>
		</div>
	</body>
</html>
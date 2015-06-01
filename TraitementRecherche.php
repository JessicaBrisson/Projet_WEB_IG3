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
		<div id="PageTraitement">
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
			<?php
				/*Cas ou utilisateur n'a pas indiqué de ville ni de pays*/
				if ($_POST['pays'] == 'NULL' && $_POST['ville'] == 'NULL'){
					?>
					<!--Message erreur-->
					<div id="erreur" class="container">
						<h2><strong>Alerte</strong></h2>
						<div class="alert alert-danger">
							<strong>ATTENTION!</strong> Vous n'avez pas sélectionné de pays ni de ville pour votre recherche. </br>
							<a href="./Menu.php" class="btn btn-danger" role="button">Retour à la recherche</a>
						</div>
					</div>
					<?php
				} else {
					?>
					<div id="retour">
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
						//Requete pour traiter la recherche
						if ($_POST['pays'] == 'NULL'){
							$requete = 'SELECT Id_Visite, Nom_Visite, Photo FROM ville, visite, categorie ';
							$requete .= 'where fk_Ville = Id_Ville AND fk_Catego = Id_Catego AND Nom_Ville like "'.$_POST['ville'].'"';
						}else if ($_POST['ville'] == 'NULL'){
							$requete = 'SELECT Id_Visite, Nom_Visite, Photo FROM pays, ville, visite, categorie ';
							$requete .= 'where fk_Ville = Id_Ville AND fk_Pays = Id_Pays AND fk_Catego = Id_Catego AND Nom_Pays like "'.$_POST['pays'].'"';
						}else{
							$requete = 'SELECT Id_Visite, Nom_Visite, Photo FROM pays, ville, visite, categorie ';
							$requete .= 'where fk_Ville = Id_Ville AND fk_Pays = Id_Pays AND fk_Catego = Id_Catego';
							$requete .=' AND Nom_Pays like "'.$_POST['pays'].'" AND Nom_Ville like "'.$_POST['ville'].'"';
						}
						// Execution de la requete
						$retour=$connexion->query($requete);
						if ($retour->rowCount() == 0) {
							?>
							<!--Message incoherence pays/ville-->
							<div id="erreur" class="container">
								<h2><strong>Alerte</strong></h2>
								<div class="alert alert-danger">
									<strong>ATTENTION!</strong> Vous avez sélectioné un pays et une ville incompatible. </br> 
									<a href="./Menu.php" class="btn btn-danger" role="button">Retour à la recherche</a>
								</div>
							</div>
							<?php
						}else{
							//Complement requete
							if ($_POST['type'] != 'NULL'){ 
								$requete .= ' AND Nom_Catego like "'.$_POST['type'].'" ORDER BY Nom_Ville, Nom_Visite';
							}else{
								$requete .= ' ORDER BY Nom_Ville, Nom_Visite';
							}
							// Execution de la requete
							$retour=$connexion->query($requete);
							if ($retour->rowCount() == 0) {
								?>
								<!--Message erreur pas de retour-->
								<div id="erreur" class="container">
									<h2><strong>Alerte</strong></h2>
									<div class="alert alert-danger">
										<strong>ATTENTION!</strong> Nous sommes désolé nous n'avons aucun enregistrement qui satisfait votre demande. </br> 
										<a href="./Menu.php/#PageRecherche" class="btn btn-danger">Retour à la recherche</a>
									</div>
								</div>
								<?php
							}else{
								//affichage résultat requete
								echo('<h1>Les Résultats</h1>');
								echo('<div class="row">');
								while($data=$retour->fetch()){
									echo('<div class="col-md-4">');
										echo('<a href="DescriptifVisite.php?Identifiant='.$data['Id_Visite'].'" class="thumbnail">');
										echo('<p>'.$data['Nom_Visite'].'</p>'); 
										if ($data['Photo'] != NULL){
											echo('<img src="'.$data['Photo'].'" alt="'.$data['Nom_Visite'].'" style="width:150px">');
										}
										echo('</a>');
									echo('</div>');
								}
							}
							?>
								</div>
								<div id="RetourRecherche">
									<a onclick="history.back()">Retour à la recherche</a>
								</div>
							<?php
						}
						$retour->closeCursor();
					echo('</div>');
				}
			?>
			<footer class="navbar-fixed-bottom">
				<p>Copyright BRISSON Jessica - Tous droits réservés
				<a href="./Email.php">Me contacter !</a></p>
			</footer>
		</div>
	</body>
</html>
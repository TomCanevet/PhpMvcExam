<?php	
	$session = \Config\Services::session();
	$session = session();
	$loginVisiteur = $session->get('login');

	$quantiteETP = $session->get('ETP');
	$quantiteKM = $session->get('KM');
	$quantiteNUI = $session->get('NUI');
	$quantiteREP = $session->get('REP');

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Formulaire</title>
  <link rel="stylesheet" href="<?php echo base_url('/public/css/test.css'); ?>" /> 
 
</head>

<body>
  <h1> GSB FRAIS VISTITEUR </h1>
 
	<h2> Profil </h2>
	<p class="Nom-Prenom-Fonction"> <?php echo 'Pseudo : ' . $loginVisiteur ?> </p></br>
	<button type="submit"><a href="index.php?action=consulter">Consulter fiche de frais</a> </button></br>
	<button type="submit"><a href="index.php?action=ChoixVisiteur">Choix Visiteur</a> </button></br>
	<button type="submit"><a href="index.php?action=deconnexion">Se déconnecter</a> </button></br>
	<h2> Frais forfaitaire mois</h2>
	<ol>
		<?php echo 'Forfait Etape : ' . $quantiteETP ?>
		<form method="POST" action="index.php">
			<p>Modifier : </p> <input type="text" name="fraisEtape"/>
			<input type="submit" value="Valider"/>
		</form>
		<br>

		<?php echo 'Forfait Kilomètre : ' . $quantiteKM ?>
		<form method="POST" action="index.php" > 
			<p>Modifier : </p> <input type="text" name="fraisKilometrique"/>
			<input type="submit"value="Valider"/>
		</form>
		<br>

		<?php echo 'Forfait Hotel : ' . $quantiteNUI ?>
		<form method="POST" action="index.php" > 
			<p>Modifier : </p> <input type="text" name="fraisHotel"/>
			<input type="submit"value="Valider"/>
		</form>
		<br>

		<?php echo 'Forfait Restaurant : ' . $quantiteREP ?>
		<form method="POST" action="index.php" > 
			<p>Modifier : </p> <input type="text" name="fraisRestaurant"/>
			<input type="submit"value="Valider"/>
		</form>
		<br>
	</ol>
	
	
	<h2> Autre frais mois</h2>
	<ol>
		<?php
		if(isset($_SESSION["libelle"]))
		{
		$size = count($_SESSION['libelle']);
		for($i=0; $i<$size; $i++)
		{
			echo 'Hors forfait : ' . $_SESSION['libelle'][$i] . ' du ' . $_SESSION['date'][$i] . ' pour un montant de : ' . $_SESSION['montant'][$i] . '€. <br/>';
		}
		}
		?>
	</ol>
	
	<h3>Ajouter des frais : </h3> 
	<form method="POST" action="index.php"> 

		<p> Date d'engagement : </p> <input type="text" name="dateEngagement"/> <br>

		<p> Libellé : </p> <input type="text" name="fraisLibelle"/><br>

		<p> Montant : </p> <input type="text" name="montantAutreFrais"/><br>
		<input type="submit"value="Valider"/>
		<br> <br> <br> <br>
	</form>

  
</body>
</html>
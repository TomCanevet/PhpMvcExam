<?php	
	$session = \Config\Services::session();
	$session = session();
	$loginVisiteur = $session->get('login');
?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet"href="<?php echo base_url('/public/css/test.css'); ?>" /> 
  <title>Consultation</title>
</head>

<body>
	<h1 class="test"> GSB FRAIS VISTITEUR </h1>
		<h2> Profil </h2></br>
			<p class="Nom-Prenom-Fonction"> <?php echo 'Pseudo : ' . $loginVisiteur ?> </p>
			<button type="submit"><a href="index.php?action=renseigner">Renseigner fiche de frais</a> </button></br>
			<button type="submit"><a href="index.php?action=ChoixVisiteur">Choix Visiteur</a> </button></br>
			<button type="submit"><a href="index.php?action=deconnexion">Se déconnecter</a> </button></br>


		<h2>Consulter vos fiches de frais </h2>
		<form method="POST" action="index.php">
			<select name="mois" id="mois-select">
			<option value="">--Selectionner votre mois--</option>
			<option value="January">Janvier</option>
			<option value="February">Février</option>
			<option value="March">Mars</option>
			<option value="April">Avril</option>
			<option value="May">Mai</option>
			<option value="June">Juin</option>
			<option value="July">Juillet</option>
			<option value="August">Août</option>
			<option value="September">Septembre</option>
			<option value="October">Octobre</option>
			<option value="November">Novembre</option>
			<option value="December">Decembre</option>
			<input type="submit"value="Valider"/>
			</select>
		</form>

		<h2> Vos fiche de paie du mois choisis : </h2>
			<h3> Vos frais hors forfait(s) : </h3>
	<?php
			if(isset($_SESSION["libelle"]))
			{
			$size = count($_SESSION['libelle']);
			for($i=0; $i<$size; $i++)
			{
				echo 'Hors forfait : ' . $_SESSION['libelle'][$i] . ' du ' . $_SESSION['date'][$i] . ' pour un montant de : ' . $_SESSION['montant'][$i] . '€. <br/>';
			}
			$session->remove('libelle');
			$session->remove('date');
			
			}
	?>
			<h3> Vos frais forfait(s) : </h3>

	
	<?php
		if(isset($_SESSION["ETP"]))
		{
			echo ' Votre forfait "Etape" est de : ' . $_SESSION['ETP'] . '<br>' ;
			$session->remove('ETP');
		}
		if(isset($_SESSION["KM"]))
		{
			echo ' Votre forfait "Kilomètre" est de : ' . $_SESSION['KM']. '<br>' ;
			$session->remove('KM');
		}
		if(isset($_SESSION["NUI"]))
		{
			echo ' Votre forfait "Hotel" est de : ' . $_SESSION['NUI']. '<br>' ;
			$session->remove('NUI');
		}
		if(isset($_SESSION["REP"]))
		{
			echo ' Votre forfait "Restaurant" est de : ' . $_SESSION['REP']. '<br>' ;
			$session->remove('REP');
		}

		
	?>

</body>
</html>

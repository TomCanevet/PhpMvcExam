<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>ConnecteInfo</title>
  <link rel="stylesheet"href="<?php echo base_url('/public/css/choix.css'); ?>" /> 
 
</head>

<body>
  <h1> GSB FRAIS VISTITEUR </h1>
 
	<h2> Profil </h2></div test>
	<p class="Nom-Prenom-Fonction"> Nom Prenom Fonction</p>

  
  <form> 
	<h2> Frais forfaitaire mois Septembre</h2>
	<ol>
		<li>Forfait étape :</li>
		<form> <p>Modifier :</p> <input type="text" name="fraisEtape"/> <input type="submit"value="Valider"/></form>
		<li>Frais kilométriques :</li>
		<form><p>Modifier :</p> <input type="text" name="fraisKilometrique"/><input type="submit"value="Valider"/></form>
		<li>Nuitée hôtel :</li>
		<form><p>Modifier :</p> <input type="text" name="fraisHotel"/><input type="submit"value="Valider"/></form>
		<li>Repas restaurant :</li>
		<form><p>Modifier :</p> <input type="text" name="fraisRestaurant"/><input type="submit"value="Valider"/></form>
	</ol>
	</div test>
	
	<p> Total :</p>
	<h2> Autre frais mois Septembre</h2>
	<ol>
		<li>Le 18/11/2013 – Repas représentation – 156€</li>
	</ol>
	<form> 
		<p>Ajouter des frais : </p> 
		<p> Date d'engagement : </p> <input type="text" name="dateEngagement"/>
		<p> Libellé : </p> <input type="text" name="fraisLibelle"/>
		<p> Montant : </p> <input type="text" name="montantAutreFrais"/>
		<input type="submit"value="Valider"/>
	</form>
	<p> Total :</p>
  </form>
  
</body>
</html>
<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url('/public/css/style.css'); ?>" /> 
</head> 
<body>
<?php $titre = 'Billet'; ?>

<?php 
//==========================================================================
// récupération du jeu de données $data, attention on n'accede pas a $data, 
// mais à la variable $resultat définie dans le Controleur via $data['resultat']=$donnees;
// ensuite, on boucle sur les différents tuples résultats via le foreach 
// puis on accède à une donnée en particulier avec la syntaxe : $liste->BIL_TITRE
// BIL_TITRE étant l'attribut défini dans la BDD
//==========================================================================

//liste contenu Blog
echo 'Contenu du billet :';
 
echo '<table border=1>';

//==========================================================================
// on boucle pour chaque ligne de résultat de la requete sql
// on stocke chaque ligne dans une variable $details
//==========================================================================
foreach ($resultat as $details): 

//==========================================================================
// on on affiche le titre, la date et le contenu des billets présents en BDD 
// via $details qui ne contien qu'une ligne de résultat
//==========================================================================
	echo '<tr>';
			echo $details->BIL_TITRE;
	echo '</tr>';
	echo '<tr>';
			echo $details->BIL_DATE;
	echo '</tr>';
	echo '<tr>';
			echo $details->BIL_CONTENU;
	echo '</tr>';

endforeach; 
echo '<table>';
echo '</BR>';

//==========================================================================
// le lien suivant renvoie une variable $_GET['action']=retour 
// à votre Controleur.php via l'index de CodeIgniter
//==========================================================================
echo '<a href="'.base_url().'/public/index.php?action=retour">Website</a>'
?>
</body>
</html>
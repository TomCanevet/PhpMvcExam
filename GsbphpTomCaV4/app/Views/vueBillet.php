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
// r�cup�ration du jeu de donn�es $data, attention on n'accede pas a $data, 
// mais � la variable $resultat d�finie dans le Controleur via $data['resultat']=$donnees;
// ensuite, on boucle sur les diff�rents tuples r�sultats via le foreach 
// puis on acc�de � une donn�e en particulier avec la syntaxe : $liste->BIL_TITRE
// BIL_TITRE �tant l'attribut d�fini dans la BDD
//==========================================================================

//liste contenu Blog
echo 'Contenu du billet :';
 
echo '<table border=1>';

//==========================================================================
// on boucle pour chaque ligne de r�sultat de la requete sql
// on stocke chaque ligne dans une variable $details
//==========================================================================
foreach ($resultat as $details): 

//==========================================================================
// on on affiche le titre, la date et le contenu des billets pr�sents en BDD 
// via $details qui ne contien qu'une ligne de r�sultat
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
// � votre Controleur.php via l'index de CodeIgniter
//==========================================================================
echo '<a href="'.base_url().'/public/index.php?action=retour">Website</a>'
?>
</body>
</html>
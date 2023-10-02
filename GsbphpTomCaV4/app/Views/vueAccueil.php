<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8" />
<link rel="stylesheet" href="<?php echo base_url('/public/css/style.css'); ?>" /> 
</head> 
<body>
<?php $titre = 'Mon Blog'; ?>

<?php 
echo base_url('/public/css/style.css');
//==========================================================================
// récupération du jeu de données $data, attention on n'accede pas a $data, 
// mais à la variable $resultat définie dans le Controleur via $data['resultat']=$donnees;
// ensuite, on boucle sur les différents tuples résultats via le foreach 
// puis on accède à une donnée en particulier avec la syntaxe : $liste->BIL_TITRE
// BIL_TITRE étant l'attribut défini dans la BDD
//==========================================================================

//liste contenu Blog
echo 'Resume contenu Blog :'; 
echo '<table border=1>';

//==========================================================================
// on boucle pour chaque ligne de résultat de la requete sql
// on stocke chaque ligne dans une variable $liste
//==========================================================================
foreach ($resultat as $liste): 

//==========================================================================
// on on affiche le titre et date des billets présents en BDD
// via $liste qui ne contien qu'une ligne de résultat
//==========================================================================

	echo '<tr>';
	echo '<td>';
			echo $liste->BIL_TITRE;
	echo '</td>';
	echo '<td>';
			echo $liste->BIL_DATE;
	echo '</td>';
	echo '</tr>';

endforeach; 
echo '<table>';
echo '</BR>';



echo 'Selection du billet de Blog :  ';
 
echo '<Form action=index.php method=post>';
echo '<Select name=billet>';

//==========================================================================
// on boucle pour chaque ligne de résultat de la requete sql
// on stocke chaque ligne dans une variable $liste
//==========================================================================
foreach ($resultat as $liste): 
 
//==========================================================================
// on on affiche l'id, le titre et la date des billets présents en BDD dans un champ select
// via $liste qui ne contien qu'une ligne de résultat
//==========================================================================
	echo '<option value='.$liste->BIL_ID.'>'.$liste->BIL_TITRE." : ".$liste->BIL_DATE.'</option>';
endforeach;

echo '</Select>'; 
echo '<input type=submit value=Afficher>';
echo '</Form>';
 
?>
</body>
</html>
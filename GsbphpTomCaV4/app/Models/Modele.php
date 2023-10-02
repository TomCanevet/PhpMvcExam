<?php
//acces au Modele parent pour l heritage
namespace App\Models;
use CodeIgniter\Model;

//=========================================================================================
//définition d'une classe Modele (meme nom que votre fichier Modele.php) 
//héritée de Modele et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================
class Modele extends Model {

//=================================//
// Toutes les requêtes SQL ici     //
//=================================//

//==========================
// Code du modele
//==========================

// Fonction pour contrôler l'athentification 
public function controlLogin($login, $password) 
{   
    $db = db_connect();
    $sql = 'SELECT login, mdp FROM Visiteur where login = ? AND mdp= ?';
    $resultat = $db->query($sql, [$login, $password]);
    $resultat = $resultat->getResult();
    return $resultat;
}

// Fonction pour récuperer l'idVisiteur 
public function setIdVisiteur($login)
{
	$db = db_connect();
	$sql = 'SELECT id FROM Visiteur WHERE login = ?';
    $id = $db->query($sql, $login);
    $id = $id->getResult();
	return $id;
}

// Vérification si le Visiteur a déjà une fiche de frais
public function Verification($id, $mois){
	$db = db_connect();
	$sql = 'SELECT COUNT(*) AS nb FROM FicheFrais where idVisiteur = ? AND mois = ?';
	$resultat = $db->query($sql, [$id, $mois]);
	$resultat = $resultat->getResult();
	return $resultat;
}

// Création d'une fiche frais avec initialisation des valeurs à 0
public function CreerFicheDeFrais($idVisiteur, $mois){
	$db = db_connect();

	$sql = 'INSERT INTO FicheFrais VALUES (?, ?, 0, 0, ?, "CR")';
	$resultat = $db->query($sql, [$idVisiteur, $mois, date("Y-m-d")]);

	$firstSQL = 'INSERT INTO LigneFraisForfait VALUES (?,?,"ETP",0)';
	$secondSQL = 'INSERT INTO LigneFraisForfait VALUES (?,?,"KM",0)';
	$thirdSQL = 'INSERT INTO LigneFraisForfait VALUES (?,?,"NUI",0)';
	$fourthSQL = 'INSERT INTO LigneFraisForfait VALUES (?,?,"REP",0)';

	$resultat = $db->query($firstSQL, [$idVisiteur, $mois]);
	$resultat = $db->query($secondSQL, [$idVisiteur, $mois]);
	$resultat = $db->query($thirdSQL, [$idVisiteur, $mois]);
	$resultat = $db->query($fourthSQL, [$idVisiteur, $mois]);

}

// Modification de la fiche LigneFraisForfait 
public function UpdateForfait($quantite, $idVisiteur, $idFicheFrais)
{
    $sql = 'UPDATE LigneFraisForfait
    SET quantite = ?
    WHERE idVisiteur = ? AND idFraisForfait = ?';
	$db = db_connect();
    $db->query($sql, [$quantite, $idVisiteur, $idFicheFrais]);

}

// Actualisation des quantités des forfaits à chaque chargement de page
public function getData($idVisiteur, $mois, $typeForfait)
{
    $db = db_connect();
    $firstSQL = 'SELECT quantite FROM LigneFraisForfait WHERE idVisiteur = ? AND mois = ? AND idFraisForfait = ?';
    $resultat = $db->query($firstSQL, [$idVisiteur, $mois, $typeForfait]);
    $resultat = $resultat->getResult();
    if ($resultat != null)
    {
    $resultat = $resultat[0]->quantite;
    }
    return $resultat;
}

// Modification de la fiche LigneFraisHorsForfait 
public function InsertHorsForfait($idVisiteur, $libelle, $montant, $dateEngagement)
{
    $db = db_connect();
    $sql = 'INSERT INTO LigneFraisHorsForfait (idVisiteur,mois,libelle,date,montant) VALUES (?,?,?,?,?)';
    $mois = date('F');
    $db->query($sql, [$idVisiteur,$mois,$libelle,$dateEngagement,$montant]);
    
}

// Actualisation des ligne de la table fraishorsforfais à chaque chargement de page
public function getDataHorsForfait($idVisiteur, $mois)
{
    $db = db_connect();
    $firstSQL = 'SELECT libelle, montant, date FROM LigneFraisHorsForfait WHERE idVisiteur = ? AND mois = ?';
    $resultat = $db->query($firstSQL, [$idVisiteur, $mois]);
    $resultat = $resultat->getResult();
    return $resultat;
}


public function ConsulterFrais()
{
    $db = db_connect();
    $firstSQL = 'SELECT libelle, montant, date FROM LigneFraisHorsForfait WHERE idVisiteur = ? AND mois = ?';
    $resultat = $db->query($firstSQL, [$idVisiteur, $mois]);
    $resultat = $resultat->getResult();
    return $resultat;
}



public function AfficheFraisForfait(){
    $db = db_connect();
    $sql = 'SELECT quantite FROM LigneFraisForfait where idVisiteur = ? AND mois = ?, idFraisForfait = ?';
    $resultat = $db->query($sql, []);
    $resultat = $resultat->getResult();

} 


public function FicheDeFraisExiste ($login)
{
    $db = db_connect();
    
    // Recupère l'id de la table visiteur du login concerné
    $sql = 'SELECT id FROM Visiteur WHERE login = ?';
    $id = $db->query($sql, [$login]);
    $id = $id->getResult();
    // Tente de récuperer l'idVisiteur de la table FicheFrais, du vistieur concerné
    $sql3 = 'SELECT idVisiteur FROM FicheFrais WHERE IdVisiteur = ? AND mois = ?';
    $idFicheFrais = $db->query($sql3, [$id[0]->id, date('F')]);
    $idFicheFrais = $idFicheFrais->getResult();

    // Contrôle si l'ID n'existe pas, sinon création.
    if(!isset($idFicheFrais[0]->idVisiteur))
    {
    $sql2 = "INSERT INTO FicheFrais (idVisiteur, mois, dateModif, idEtat) VALUES (?, date('F'),date(),'CR')" ;
    $creation = $db->query($sql2, [$id]);
    $creation = $creation-> getResult();
    }

}


//==========================
// Fin Code du modele
//===========================


//fin de la classe
}


?>

<?php
//acces au controller parent pour l heritage
namespace App\Controllers;
use CodeIgniter\Controller;


//=========================================================================================
//définition d'une classe Controleur (meme nom que votre fichier Controleur.php) 
//héritée de Controller et permettant d'utiliser les raccoucis et fonctions de CodeIgniter
//  Attention vos Fichiers et Classes Controleur et Modele doit commencer par une Majuscule 
//  et suivre par des minuscules
//=========================================================================================

class Controleur extends Controller {

//=====================================================================
//Fonction index correspondant au Controleur frontal (ou index.php) en MVC libre
//=====================================================================
	public function index()
	{	
		//Réaction du controlleur en fonction des variables reçues

		// Lancement de la fonction de contrôle de la paire identifiant/motdepasse
		if(isset($_POST["login"]) && ($_POST["password"])) 
		{
			$this->loginControl(); 
		}
		
		// Affichage de la page RenseignerFicheDeFrais ou ConsulterFicheDeFrais si variable "action" reçue
		//Liens des pages
		elseif(isset($_GET["action"]))
		{
			if($_GET["action"]== 'renseigner')
			{
				$this->RenseignerFicheDeFrais();
			}
			
			if($_GET["action"]== 'consulter')
			{
				$this->ConsulterFicheDeFrais();
			}

			if($_GET["action"]== 'ChoixVisiteur')
			{
				$this->ChoixVisiteur();
			}

			if($_GET["action"]== 'deconnexion')
			{
				$this->Deconnexion();
			}
		}
		
		// Mise à jour de la table lignefraisforfait en fonction des modfications envoyé depuis la page RenseignerFicheDeFrais.php
		elseif(isset($_POST["fraisEtape"]))
		{
			$this->UpdateForfait($_POST['fraisEtape'], 'ETP');
		}
		elseif(isset($_POST["fraisKilometrique"]))
		{
			$this->UpdateForfait($_POST['fraisKilometrique'], 'KM');
		}
		elseif(isset($_POST["fraisHotel"]))
		{
			$this->UpdateForfait($_POST['fraisHotel'], 'NUI');
		}
		elseif(isset($_POST["fraisRestaurant"]))
		{
			$this->UpdateForfait($_POST['fraisRestaurant'], 'REP');
		}

		// Mise à jour de la table lignefraisHorsforfait en fonction des modfications envoyé depuis la page RenseignerFicheDeFrais.php
		elseif(isset($_POST["dateEngagement"]) && isset($_POST["fraisLibelle"]) && isset($_POST["montantAutreFrais"]))
		{
			$this->InsertHorsForfait();
		}

		elseif(isset($_POST["mois"]))
		{
			$this->ConsulterFrais($_POST["mois"]);
		}
		
		// Si aucune variable reçue, l'utilisateur est redirigé vers la page de connexion
		else
		{
			$this->login();
		}

	}

	// Affichage de la page login pour la connexion du visiteur
	public function login() 
	{
				echo view('Login');
	}

	// Contrôle des identifiants et mots de passes
	public function loginControl() 
	{   //Vérifie si ce sont les mêmes identifiants traits pour traits.
		if (isset($_POST["login"]) && isset($_POST["password"])) 
		{
			// Récupération et exécution de la fonction loginControl() depuis Modele.php
			$Modele = new \App\Models\Modele();
			$donnees = $Modele->controlLogin($_POST["login"], $_POST["password"]);
			
			// Déclaration de variable session si authentification réussie
			if (isset($donnees[0]->mdp))
			{
				$session = \Config\Services::session();
				$session = session();
				$session->set('login', $_POST["login"]);	// Déclaration de login en session
				$session->set('connecté', 'true');			// Déclaration d'état de connexion

				// Fonction pour récupérer l'id du visiteur en session
				$setId = $Modele->setIdVisiteur($_POST['login']);
				$session->set('idVisiteur', $setId[0]->id); // Déclaration de l'idVisiteur
				$idVisiteur = $session->get('idVisiteur');
				// Vérification si une fiche de paie du mois existe pour le visiteur
				$verificationFicheDePaie = $Modele->Verification($idVisiteur, date("F"));

				//////////////////\\\\\\\\\\\\\\\\\\\
				// Si aucune fichedepaie n'existe :\\
				//////////////////\\\\\\\\\\\\\\\\\\\

				if($verificationFicheDePaie[0]->nb==0)
				{
					$Modele->CreerFicheDeFrais($idVisiteur, date("F"));
				}

				// Si le controle de login et les préparation de session sont finis : lancement de la page ChoixVisiteur
				$this->ChoixVisiteur();
			}
			
			else
			{
				echo view('Login');
			}
		}
	
	}

	// Affichage de la page Choix Visiteur
	public function ChoixVisiteur()
	{
		echo view('ChoixVisiteur');
	}

	// Lancement de la page RenseignerFicheDeFrais avec préparation pour le bon déroulement
	public function RenseignerFicheDeFrais()
	{
		$Modele = new \App\Models\Modele();
		$session = \Config\Services::session();
		$session = session();
		$idVisiteur = $session->get('idVisiteur'); // Récupération de de l'idVisiteur
		$libelle = null;
		$date = null;
		$montant = null;

		// Récupération des quantités/type forfaits ACTUEL du visiteur dans des variables SESSIONS
		$donnees = $Modele->getData($idVisiteur, date("F"), 'ETP');
		//print_r($donnees);
		$session->set('ETP', $donnees);

		$donnees = $Modele->getData($idVisiteur, date("F"), 'KM');
		$session->set('KM', $donnees);

		$donnees = $Modele->getData($idVisiteur, date("F"), 'NUI');
		$session->set('NUI', $donnees);

		$donnees = $Modele->getData($idVisiteur, date("F"), 'REP');
		$session->set('REP', $donnees);


		$idVisiteur = $session->get('idVisiteur');

		// Récupération des lignes de la table HorsForfait ACTUEL du visiteur dans des variables SESSIONS
		$resultat = $Modele->getDataHorsForfait($idVisiteur, date("F"));
		$size = count($resultat);
		
		for ($i=0; $i<$size; $i++) 
		{
		$libelle[$i]= $resultat[$i]->libelle;
		$montant[$i] = $resultat[$i]->montant;
		$date[$i] = $resultat[$i]->date;
		}
		$session->set('libelle', $libelle);
		$session->set('montant', $montant);
		$session->set('date', $date);

		// Affichage de la page
		echo view('RenseignerFicheDeFrais');
		
	}

	// Affichage de la page ConsulterFicheDeFrais
	public function ConsulterFicheDeFrais()
	{
		echo view('ConsulterFicheDeFrais');
	}




	// Enregistrement des updatesdeForfait récupérer depuis le modele, dans des variables SESSIONS
	public function UpdateForfait($quantite, $idFicheFrais)
	{
		$session = \Config\Services::session();
		$session = session();
		$idVisiteur = $session->get('idVisiteur');
		$Modele = new \App\Models\Modele();
		$Modele->UpdateForfait($quantite, $idVisiteur, $idFicheFrais);
			
		$this->RenseignerFicheDeFrais();
		
	}

	// Envoie des varibles requis au modele pour l'insertion d'une nouvelle ligne hors forfait dans la base de donnée
	public function InsertHorsForfait()
	{
			$session = \Config\Services::session();
			$session = session();
			$idVisiteur = $session->get('idVisiteur');
			$libelle = $_POST['fraisLibelle'];
			$montant = $_POST['montantAutreFrais'];
			$dateEngagement = $_POST['dateEngagement'];
			$Modele = new \App\Models\Modele();
			$Modele->InsertHorsForfait($idVisiteur, $libelle, $montant,$dateEngagement);

		$this->RenseignerFicheDeFrais();
	}


	public function ConsulterFrais($mois)
	{
		// Récupère l'idVisiteur
		$session = \Config\Services::session();
		$session = session();
		$idVisiteur = $session->get('idVisiteur');
		$session->set('moisDemandé', $mois);

		// Instance de Modele
		$Modele = new \App\Models\Modele();

		// Récupère et set dans des variables session les frais hors forfait s'ils existent
		$resultat = $Modele->getDataHorsForfait($idVisiteur, $mois);
		if ($resultat != null ){
		$size = count($resultat);

		for ($i=0; $i<$size; $i++) 
		{
		$libelle[$i]= $resultat[$i]->libelle;
		$montant[$i] = $resultat[$i]->montant;
		$date[$i] = $resultat[$i]->date;
		}
		$session->set('libelle', $libelle);
		$session->set('montant', $montant);
		$session->set('date', $date);
		} 
		
		// Récupère et set dans des variables session les frais forfait
		$donnees = $Modele->getData($idVisiteur, $mois, 'ETP');
		//print_r ($donnees);
		if($donnees != null){$session->set('ETP', $donnees);}

		$donnees = $Modele->getData($idVisiteur, $mois, 'KM');
		if($donnees != null){$session->set('KM', $donnees);}

		$donnees = $Modele->getData($idVisiteur, $mois, 'NUI');
		if($donnees != null){$session->set('NUI', $donnees);}

		$donnees = $Modele->getData($idVisiteur, $mois, 'REP');
		if($donnees != null){$session->set('REP', $donnees);}

		echo view('ConsulterFicheDeFrais');
	}

	
	// Clear des variables SESSIONS enregistrer au cours de la navigation du visiteur
	public function Deconnexion()
	{
		$session = \Config\Services::session();
		$session = session();
		$session->remove('login');
		$session->remove('connecté');
		$session->remove('idVisiteur');
		$session->remove('libelle');
		$session->remove('date');
		$session->remove('montant');
		$session->remove('moisDemandé');
		$this-> login();
	}
	//fin de la classe
}
?>

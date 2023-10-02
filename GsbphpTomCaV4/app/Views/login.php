<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Définition de l'encodage de caractères -->
    <meta charset="UTF-8">
    <!-- Spécification pour la compatibilité avec Internet Explorer -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Configuration de la vue pour les appareils mobiles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Lien vers la feuille de style CSS -->
    <link href="<?= base_url('public/css/style.css'); ?>" rel="stylesheet">
    <!-- Lien vers l'icône du site (favicon) -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('public/images/favicon.ico'); ?>">
    <!-- Titre de la page -->
    <title>Connexion</title>
</head>
<body>
    <!-- Contenu principal de la page -->
    <div class="main">
        <!-- Formulaire de connexion -->
        <div class="connect">
            <!-- Logo de l'application -->
            <img src="<?= base_url('public/images/logo1.png'); ?>">
            <!-- Formulaire de connexion avec méthode POST -->
            <form method="POST" action="postdata">
                <!-- Champ pour l'identifiant -->
                <div>
                    <input type="text" placeholder="Identifiant" name="login" required>
                </div>
                <!-- Champ pour le mot de passe -->
                <div>
                    <input type="password" placeholder="Mot de Passe" name="mdp" required>
                </div>
                <!-- Bouton de soumission du formulaire -->
                <div>
                    <input type="submit" value="Connexion">
                </div>
            </form>
            <!-- Affichage d'un message d'erreur s'il y en a un dans la session -->
            <?php if(isset($_SESSION['error'])): ?>
                <div class="error-message"><?= esc($_SESSION['error']); ?></div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

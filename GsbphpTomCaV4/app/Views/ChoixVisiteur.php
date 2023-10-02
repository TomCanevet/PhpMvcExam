<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Choix</title>
  <link rel="stylesheet" href="<?php echo base_url('/public/css/test.css'); ?>" /> 

</head>
<body>
  <form>
     
    <h1>Profil</h1>
    
    <p class="Choix1">Quelles actions souhaitez-vous effectuer? :</p>
    
    <div class="choix">
      <button type="submit"><a href="index.php?action=renseigner">Renseigner fiche de frais</a> </button></br>
      <button type="submit"><a href="index.php?action=consulter">Consulter fiche de frais</a> </button></br>
      <button type="submit"><a href="index.php?action=deconnexion">Se déconnecter</a> </button></br>
    </div>  
  
  </form>
</body>
</html>
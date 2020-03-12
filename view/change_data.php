<?php
session_start();
include ('../controleur/controleur_change_data.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/css/main.css">
  <title>Tweet Académie</title>
</head>
<body>
  <header>
    <div class="container">
      <div class="row div-log">
      <div class="col-md-3"><a href="./profil.php" class="btn btn-secondary">Retour</a>
      <div class="row separator"></div>
    </div>
        <div class="col-md-6">
          <div class="logo">
          <img src="../public/src/twit.png" alt="logo twitter" width="100px" height="100px">
        </div>
          <h1>Editer mes données</h1>
          <form id="form_edition">
          <div class="form-group">
              <label for="nom">Nom</label>
              <input type="nom" class="form-control" name="nom" id="nom" value="<?= $_SESSION['nom']; ?>" required>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom</label>
              <input type="prenom" class="form-control" name="prenom" id="prenom" value="<?= $_SESSION['prenom']; ?>" required>
            </div>
            <div class="form-group">
              <label for="pseudo">Pseudo</label>
              <input type="pseudo" class="form-control" name="pseudo" id="pseudo" value="<?= $_SESSION['pseudo']; ?>" required>&nbsp;
            </div>
            <div class="form-group">
              <label for="email">Adresse Mail</label>
              <input type="email" class="form-control" name="email" id="email" value="<?= $_SESSION['email']; ?>" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" value="" required>
            </div><br>
            
            <input type="submit" value="Valider" id="edition" name="edition" class="btn btn-primary ">
          </form><br>
        
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </header>
  <script src="../public/script/jquery.js"></script>
  <script src="../public/script/script_change_data.js"></script>  
</body>
</html>
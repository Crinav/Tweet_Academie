<?php
session_start();
//include ('../controleur/controleur_inscription.php');
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
      <div class="col-md-3"><a href="../index.php" class="btn btn-secondary">Retour</a>
      <div class="row separator"></div>
      </div>
        <div class="col-md-6">
          <div class="logo">
          <img src="../public/src/twit.png" alt="logo twitter" width="100px" height="100px">
        </div>
          <h1>Inscrivez vous sur Tweet Académie</h1>
          <form id="form_inscription">
          <div class="form-group">
              <label for="nom">Nom</label>
              <input type="nom" class="form-control" name="nom" id="nom" required>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom</label>
              <input type="prenom" class="form-control" name="prenom" id="prenom" required>
            </div>
            <div class="form-group">
              <label for="pseudo">Pseudo</label>
              <input type="pseudo" class="form-control" name="pseudo" id="pseudo" required>&nbsp;
            </div>
            <div class="form-group">
              <label for="email">Adresse Mail</label>
              <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div><br>
            
            <input type="submit" value="Valider" id="inscription" class="btn btn-primary ">
          </form><br>
          <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="check_age" required>
<span class="form-check-label" for="check">Je certifie avoir plus de 16 ans</span>
        </div>
        
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </header>
  <script src="../public/script/jquery.js"></script>
  <script src="../public/script/script_log.js"></script>  
</body>
</html>
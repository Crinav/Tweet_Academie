<?php
session_start();

//include ('controleur/controleur_log.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="public/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/css/main.css">
  <title>Tweet Académie</title>
</head>
<body>
  <header>
    <div class="container">
      <div class="row div-log">
      <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="logo">
          <img src="public/src/twit.png" alt="logo twitter"  width="100px" height="100px">
        </div>
          <h1>Connectez vous sur Tweet Académie</h1>
          <div id="erreur"><p>Vous n'avez pas rempli correctement les champs du formulaire !</p></div>
          <form id="form_log">
            <div class="form-group">
              <label for="email">Adresse Mail</label>
              <input type="email" data-toggle="popover" tittle="5 caractères minimum" class="form-control is_invalid" name="email" id="email">

            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password">
            </div><br>
            
            <input type="submit" value="valider" id="log" class="btn btn-primary ">
         
            </form><br> 
          <a href="view/inscription.php" role="link" class="home_link">S'inscrire sur Tweet académie</a>

        <div class="col-md-3"></div>
      </div>
    </div>
  </header>
  
  <script src="public/script/jquery-3.4.1.min.js"></script>
  <script src="public/script/script_log.js"></script>
</body>
</html>
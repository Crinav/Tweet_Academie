<?php
session_start();
$id_member= $_SESSION['id_member'];
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Tweet Academy-Messagerie</title>
        <meta charset="utf-08">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../public/css/messagerie_styles.css">
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container principal_container">
            <div class="row principal_row">


            
                <div class="col-md-3 nav_colonne">
                    <p class="nav_titre"><img class="logo_twit" src="../public/src/twit.png"></p>
                    
                        <div class="row nav_row">
                        <div class="col-md-5"><a href="accueil.php"><img class="logo_house" src="../public/src/house.png"></div>
                        <div class="col-md-7 nav_text">Accueil</div></a>
                    </div>
                    <div class="row nav_row">
                        <div class="col-md-5"><a href="messagerie.php"><img class="logo_mess" src="../public/src/mess.png"></div>
                        <div class="col-md-7 nav_text">Messages</div></a>
                    </div>
                    <div class="row nav_row">
                        <div class="col-md-5"><a href="profil.php"><img class="logo_prof" src="../public/src/prof.png"></div>
                        <div class="col-md-7 nav_text">Profil</div></a>
                    </div>
                    
                    
                    <div class="row nav_row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 btn btn-primary btn-lg">Tweeter</div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
               




                <div class="col-md-3 accueil_menu">
                    <p class="accueil_titre">Messages</p>
                    <div class="div_accueil_tweeter">
                        <div class="row accueil_right_research">
                        <div class="col-md-10"><form id="research"><input class="input_research" id="search" type="text" placeholder="Recherche Tweet Academy..."></div>
                        <div class="col-md-2"><img class="logo_research" src="../public/src/research.png"></div></form>
                        </div>
                    </div>
                    <div class="row accueil_separator">
                        <div class="col-md-12"></div>
                    </div>
                </div>


                <div class="col-md-5 messagerie_messages">
                    <p class="accueil_titre">Nom/prenom</p>
                    <div class="show_messages">




                    </div>
                </div>



            </div>
        </div>

       
        <script src="../public/script/jquery.js"></script>
        <script src="../public/script/script_messagerie.js"></script>
        <script src="../public/script/bootstrap.min.js"></script>
    </body>
</html>
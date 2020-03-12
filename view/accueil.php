<?php
session_start();
include ('../controleur/controleur_accueil.php');
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Tweet Academy-Accueil</title>
        <meta charset="utf-08">
        <link rel="stylesheet" href="../public/css/accueil_styles.css">
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    </head>
    <body>
        <header>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-5 bienvenue">Bienvenue
                <?= $_SESSION['pseudo']; ?> &nbsp;!</div>
                
                <div class="col-md-4"></div>
            </div>
        </header>
        <div class="container principal_container">
            <div class="row principal_row">


            
            <div class="col-md-3 nav_colonne">
                    <p class="nav_titre"><img class="logo_twit" src="../public/src/twit.png"></p>
                    <div class="row nav_row"></div>
                        <div class="row nav_row">
                        <div class="col-md-4"><a href="./accueil.php"><img class="logo_house" src="../public/src/house.png"></div>
                        <div class="col-md-6 nav_text">Accueil</div></a>
                    </div>
                    <div class="row nav_row">
                        <div class="col-md-4"><a href="./messagerie.php"><img class="logo_mess" src="../public/src/mess.png"></div>
                        <div class="col-md-6 nav_text">Messages</div></a>
                    </div>
                    <div class="row nav_row">
                        <div class="col-md-4"><a href="./profil.php"><img class="logo_prof" src="../public/src/prof.png"></div>
                        <div class="col-md-6 nav_text">Profil</div></a>
                    </div>
                    <div class="row nav_row"></div>
                    <div class="row nav_row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 btn btn-primary btn-md">Tweeter</div>
                        <div class="col-md-2"></div>
                    </div>
                </div>


                <div class="col-md-5 accueil_menu">
                    <p class="accueil_titre">Accueil</p>
                    <div class="div_accueil_tweeter">
                        <div class="row accueil_row">
                            <div class="col-md-2"><img class="logo_user" src="../public/src/user.png"></div>
                            <div class="col-md-10"><textarea class="input_quoi form-control z-depth-1" cols="35" rows="4" id="input_quoi" placeholder="Quoi de neuf ?"  required></textarea></div>
                            </div>
                        <div class="row accueil_row">
                            <div class="col-md-7"><label>140 carac. Max:</label><input class="carac"  id="input_quoi_carac"></div>
                            <div class="col-md-5"><form id="form_tweet"><input class="btn btn-primary" type="submit" id="tweet"  value="Tweeter"></form></div>
                            </div>
                            <div class="row">
                            <div class="col-md-12 tag"></div>
                            </div>
                    </div>
                    <div class="row accueil_separator">
                       
                        
                    </div>
                    <div class="affiche_tweet"></div>
                </div>




                <div class="col-md-3 accueil_right_menu">
                <div><input id = "logout" class="btn btn-secondary" value="Deconnexion"type="submit"></div>
                    <div class="row accueil_right_research">
                        <div class="col-md-10"><form id="research"><input class="input_research" id="search" type="text" placeholder="Recherche Tweet Academy..."></div>
                        <div class="col-md-2"><img class="logo_research" src="../public/src/research.png"></div></form>
                    </div>
                    <div class="row ">
                    <div class='col-md-12 result'></div>
                    </div>
                    <div class="row accueil_right_followings">
                        <div class="col-md-12"><b>Followings</b></div>
                            
                            
                    </div>

                    <div class="row accueil_right_followers">
                        <div class="col-md-12"><b>Followers</b></div>
                        <br>
              
                    </div>
                </div>
            </div>
        </div>

       
        <script src="../public/script/jquery.js"></script>
        <script src="../public/script/script_accueil.js"></script>
        <script src="../public/script/bootstrap.min.js"></script>
    </body>
</html>
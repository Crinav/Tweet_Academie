<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
    	<meta charset="UTF-8">
        	<title> profil_tweeter </title>
            <link rel="stylesheet" type="text/css" href="../public/css/profil.css"/>
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"/>
	</head>
	<header> 
	</header>
	<body>
	    <div class="container">
	        <div class="row_profil">


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




	            <div class="col-md-6">
	                <div class="row profile-sidebar">
	                    <div class="col-md-1"></div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12"></div>
							</div>
						</div>
						<div class="col-md-7"></div>
	                </div>
	                <div class="row avatar">
	                	<div class="col-md-12">
	                		<div class="row profil_separator">
	                			<div class="col-md-12"></div>
	                		</div>
		                	<div class="row profil_photo">
			                	<div class="col-md-4">
			                        <img class="avatar_photo"src="../public/src/images/user.png" atl=""/> 
			                    </div> 
			                 	<div class="col-md-5"></div> 
			                    <div class="col-md-3"></div>
		                	</div>
		                	<div class="row">
		                		<div class="col-md-4"></div> 
			                    <div class="col-md-5"></div> 
			                    <div class="col-md-3"><a href="change_data.php"><button type="button" id="edit_profil" class="btn btn btn-primary">Editer mon profil</button></a></div>
		                	</div>
		                </div>
	                </div>
	                <div class="row">
	                  <div class="col-md-3"><?= $_SESSION['prenom']?>&nbsp;<?= $_SESSION['nom']?>
	                  	<div class="row">
	                  		<div class="col-md-3"><b>@<?= $_SESSION['pseudo'] ?></b></div>
	                  		<div class="col-md-9"></div>
	                  	</div>
	                  </div>
	                  <div class="col-md-9"></div> 
	                </div>
	                <div class="row">
	                	<div class="col-md-1"><img src="../public/src/calend.png" class="calend" alt="logo de calendrier"></div>
	                	<div class="col-md-6">a rejoint twitter le <?= $_SESSION['inscription_date']?></div>
	                	<div class="col-md-5"></div>
	                </div>
	                <div class="row follow">
	                	<div class="col-md-1" id="followings"></div>
	                	<div class="col-md-2">followings</div>
	                	<div class="col-md-1" id="followers"></div>
	                	<div class="col-md-2">followers</div>
	                	<div class="col-md-3"></div>
	                </div>


	                

	                <div class="row">
	                	<div class="col-md-12" id="tweet_et_comm">
	                	
	                	</div>
	                </div>
	        	</div>





	        	<div class="col-md-3 accueil_right_menu">
                <div><input id = "logout" class="btn btn-secondary" value="Deconnexion"type="submit"></div>
                    <div class="row accueil_right_research">
                        <div class="col-md-10"><form id="research"><input class="input_research" id="search" type="text" placeholder="Recherche Tweet Academy..."></div>
                        <div class="col-md-2"><img class="logo_research" src="../public/src/research.png"></div></form>
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
		<script src="../public/script/script_accueil.js"> </script>
		<script src="../public/script/script_profil.js"> </script>
	</body>
</html>
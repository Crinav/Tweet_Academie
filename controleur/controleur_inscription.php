<?php
session_start();
include ('../model/model_log_inscription.php');
if(!empty($_POST['nom'])){
    
    $nom = ucfirst(htmlspecialchars($_POST['nom']));
    $prenom = ucfirst(htmlspecialchars($_POST['prenom']));
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $_POST['password']=null;
    $password_hash = hash_hmac('ripemd160', $password, 'vive le projet tweet_academy');
    $password=null;
    $user = new User;
    $resultat_email = $user->verif_email($email);
    $resultat_pseudo = $user->verif_pseudo($pseudo);
    
    if (empty($resultat_email[0]['email'])) {
        if (empty($resultat_pseudo[0]['pseudo'])) {
            $last_id = $user->insert($nom, $prenom,$pseudo, $email, $password_hash);
            session_unset();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['nom'] = $resultat_email[0]['lastname'];
            $_SESSION['prenom'] = $resultat_email[0]['firstname'];
            $_SESSION['email'] = $resultat_email[0]['email'];
            $date = new DateTime($resultat_email[0]['inscription_date']);
		$_SESSION['inscription_date'] = $date->format('d-m-Y');
            $_SESSION['id_member'] = $last_id;
            isset($_COOKIE[$email])? : setcookie($email, $last_id, time() + 3600 * 60 * 365, null, null, false, true);
            settype($last_id, "integer");
            echo $last_id;
        }
        else{
            $erreur = "erreur_pseudo";
            echo json_encode($erreur);   
        }
    }
    else{
        $erreur = "erreur_email";
            echo json_encode($erreur); 
    }

}

?>
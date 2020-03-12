<?php
session_start();

include ('../model/model_change_data.php');
$id_member = $_SESSION['id_member'];
if(!empty($_POST['nom'])){
    $nom = ucfirst(htmlspecialchars($_POST['nom']));
    $prenom = ucfirst(htmlspecialchars($_POST['prenom']));
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $_POST['password']=null;
    $password_hash = hash_hmac('ripemd160', $password, 'vive le projet tweet_academy');
    $password=null;
    $edit = new Edit;
    $resultat_email = $edit->verif_email($email);
    $resultat_pseudo = $edit->verif_pseudo($pseudo);
    
    if (empty($resultat_email[0]['email']) || $_SESSION['email']== $email) {
        if (empty($resultat_pseudo[0]['pseudo']) || $_SESSION['pseudo']== $pseudo) {
            $edit->update($id_member,$nom, $prenom,$pseudo, $email, $password_hash);
            session_unset();
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $email;
            $_SESSION['id_member'] = $resultat_email[0]['id_member'];
            isset($_COOKIE[$email])?$_COOKIE[$email = $resultat_email[0]['id_member']] : setcookie($email, $resultat_email[0]['id_member'], time() + 3600 * 60 * 365, null, null, false, true);
            $pass = 'réussi';
            echo $pass;
        }
        else{
            $erreur = "erreur_pseudo";
            echo $erreur;   
        }
    }
    else{
        $erreur = "erreur_email";
            echo $erreur; 
    }

}
?>
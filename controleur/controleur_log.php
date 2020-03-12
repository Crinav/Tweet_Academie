<?php
include ('../model/model_log_inscription.php');
session_start();


if (!empty($_POST["email"]) && !isset($_POST['nom'])) {
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$_POST['password'] = null;
	$password_hash = hash_hmac('ripemd160', $password, 'vive le projet tweet_academy');
	$password = null;
	$user = new User;
	$resultat = $user->verif_email($email);
	if ($resultat[0]['email'] == $email && $resultat[0]['password'] == $password_hash && $resultat[0]['activity'] == 1) {
		session_unset();
		$_SESSION['pseudo'] = $resultat[0]['pseudo'];
		$_SESSION['id_member'] = $resultat[0]['id_member'];
		$_SESSION['nom'] = $resultat[0]['lastname'];
		$_SESSION['prenom'] = $resultat[0]['firstname'];
		$_SESSION['email'] = $resultat[0]['email'];
		$date = new DateTime($resultat_email[0]['inscription_date']);
		$_SESSION['inscription_date'] = $date->format('d-m-Y'); 

		isset($_COOKIE[$email])? : setcookie($email, $resultat[0]['id_member'], time() + 3600 * 60 * 365, null, null, false, true);
		echo $resultat[0]['email'];
	} else {
		$erreur = "erreur";
		echo $erreur;
	}
}


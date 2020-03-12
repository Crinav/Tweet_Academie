<?php
session_start();
include ('../model/model_profil.php');
$id_member = $_SESSION['id_member'];
if(!empty($_POST["comm"])){
    $content = $_POST["comm"];
    $id_tweet = $_POST['id_tweet'];
	$add_comm = new Tweeter;
	$add_comm->add_comment($id_tweet,$id_member,$content);
}
if(!empty($_POST["affiche_comm"])){
    $add_comm = new Tweeter; 
    $add_comm->show_tweets_member_with_comment($id_member);
}
if(!empty($_POST['affiche_followings'])){
    $nb = new Tweeter;
    $nb->followings($id_member);
    
    
}
if(!empty($_POST['affiche_followers'])){
    $nb = new Tweeter;
    $nb->followers($id_member);
    
}

?>
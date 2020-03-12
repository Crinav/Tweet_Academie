<?php
session_start();
include ('../model/model_accueil.php');

$id_member = $_SESSION['id_member']; 

//affiche les tweets followings sur la page d'accueil
if(!empty($_POST['affiche_tweet'])){
	$add =new Tweeter;
	$add->show_tweets_followings_with_comment($id_member);
	
}
//affiche les followingsssss
if(!empty($_POST['affiche_followings'])){
	$add =new Tweeter;
	$add->show_followings($id_member);
}
//affiche les followersssss
if(!empty($_POST['affiche_followers'])){
	$add =new Tweeter;
	$add->show_followers($id_member);
}
//tweet

if(!empty($_POST['tweet'])){
	$img="";
	$array_tag=[];
	$array_hashtag=[];
	$id_member = $_SESSION['id_member']; 
	$content = htmlspecialchars($_POST['tweet']); 
	$pattern = '#https?:\/\/w?w?w?\.?[a-zA-Z0-9-\.]+\.[a-zA-Z]{2,4}(/\S*)[ ]?#';
	preg_match($pattern, $content, $img);
	$lien = " http://www.".substr(sha1(mt_rand(101,1000)),0,5)."/image.jpg "; 
	$content= preg_replace($pattern,'<a href="$0" target="_blank" class="lien">'.$lien.'</a>', $content); 
	$pattern_tag = '#@[a-zA-Z0-9éèàôîêùïë_-]{1,}#';
	preg_match_all($pattern_tag, $content, $array_tag);
	$content = preg_replace($pattern_tag,'<a href="view/profil.php?pseudo=$0" class="lien">$0</a>',$content);
	
	$pattern_hashtag = '#\#[a-zA-Z0-9éèàôîêùïë_-]{1,}#';
	preg_match_all($pattern_hashtag, $content, $array_hashtag);
	$content = preg_replace($pattern_hashtag, ' <a href="view/accueil.php?hastag=$0" class="lien">$0</a> ',$content);
	
	$add =new Tweeter;
	
	$last_id = $add->add_tweet($id_member,$content, $img[0]);
	foreach($array_tag as $value){
		foreach($value as $val){
			$add->add_tag($last_id, $id_member, $val);	
		}
	}
	foreach($array_hashtag as $value){
		foreach($value as $val){
			$add->add_hashtag($last_id, substr($val,1,15));
		}
		
		
	}
	echo 'tweet ok';
}

//deconnexion
if(!empty($_POST["logout"])){
	session_unset();
	session_destroy();
	$logout= 'logout';
	echo $logout;
}
//recherche @ et #
if(!empty($_POST['research'])){
	$data = $_POST['research'];
	if(substr($data, 0,1) == "@"){
		$pseudo = substr($data, 1,15);
		$search = new Tweeter;
		$search->search_tag($pseudo);
	}
	if(substr($data, 0,1) == "#"){
		$hashtag = substr($data, 1,15);
		echo $hashtag;
	}
}

if(!empty($_POST["retweet"])){
	$id_tweet = $_POST["retweet"];
	$retweet = new Tweeter;
	$retweet->add_retweet($id_tweet, $id_member);
	
}
if(!empty($_POST['img'])){
	$img = $_POST["img"];
	$retweet = new Tweeter;
	$retweet->add_tweet($id_member, $id_tweet,$img);
}

if(!empty($_POST['affiche_tag'])){
	$id_tag = $_POST['affiche_tag'];
	echo $_POST['pseudo'];
}
if(!empty($_POST['abo'])){
	$id_following = $_POST['abo'];
	$abo = new Tweeter;
	$result = $abo->verif_abo($id_member, $id_following);
	if($result == 'Vous êtes déjà abonné à ce membre'){
		echo $result;
	}
	else{
		$abo->abonne($id_member,$id_following);
	}
	
}
if(!empty($_POST['mp'])){
	$id_member_sender = $_POST['mp'];
	$id_member_receiver = $id_member;
	$mess = $_POST['mess'];
	$mp = new Tweeter;
	$mp->write_mp($id_member_sender,$id_member_receiver,$mess);
}


if(!empty($_POST['id'])){
	$id = $_POST['id'];
	$user = new Tweeter;
	$user->desabonne($id_member,$id);
	
}

?>
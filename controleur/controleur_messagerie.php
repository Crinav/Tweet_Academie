<?php
session_start();
include ('../model/model_messagerie.php');
$id_member = $_SESSION['id_member'];
if(!empty($_POST['affiche_messages'])){
    $messages = new MP;
    $messages->view_conversations($id_member);
}
if(!empty($_POST['sender'])){
    $id_member_sender = $_POST['sender'];
    $id_member_receiver = $_POST['receiver'];
    $messages = new MP;
    $messages->view_messages($id_member,$id_member_receiver, $id_member_sender);
}

if($_POST['mess']){
    $id_member_sender = $id_member;
	$id_member_receiver = $_POST['id_mess'];
	$mess =  $_POST['mess'];
	$new_mess = new MP;
    $new_mess->write_mp($id_member_receiver, $id_member_sender, $mess);
    echo 'Message envoyé avec succés';
}
?>
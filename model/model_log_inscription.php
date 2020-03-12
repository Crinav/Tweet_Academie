<?php
//LOG
class User {
      
    function verif_email($email){
        try{
            $server = 'localhost';
            $db = 'common-database';
            $user = 'root';
            $pass = 'noel167';
            $dbconnect = new PDO("mysql:host=$server;dbname=$db;charset=UTF8", $user, $pass);
            $dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $requete = "SELECT * FROM member WHERE email = :email ";
            $prepare = $dbconnect->prepare("".$requete."");
            $prepare->bindParam(':email', $email, PDO::PARAM_STR);
            $prepare->execute();
            $resultat = $prepare->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    function verif_pseudo($pseudo){
        try{
            $server = 'localhost';
            $db = 'common-database';
            $user = 'root';
            $pass = 'noel167';
            $dbconnect = new PDO("mysql:host=$server;dbname=$db;charset=UTF8", $user, $pass);
            $dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $requete = "SELECT * FROM member WHERE pseudo = :pseudo ";
            $prepare = $dbconnect->prepare("".$requete."");
            $prepare->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
            $prepare->execute();
            $resultat = $prepare->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

// INSCRIPTION
      
    function insert($nom, $prenom,$pseudo, $email, $password_hash){
        try{
         $server = 'localhost';
         $db = 'common-database';
         $user = 'root';
         $pass = 'noel167';
         $dbconnect = new PDO("mysql:host=$server;dbname=$db;charset=UTF8", $user, $pass);
         $dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
         $requete = "INSERT INTO member ( lastname, firstname, pseudo, email, password) VALUES ( :nom, :prenom, :pseudo,:email, :password_hash)";
         $prepare = $dbconnect->prepare("".$requete."");
         $prepare->bindParam(':nom', $nom, PDO::PARAM_STR);
         $prepare->bindParam(':prenom', $prenom, PDO::PARAM_STR);
         $prepare->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
         $prepare->bindParam(':email', $email, PDO::PARAM_STR);
         $prepare->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
         $prepare->execute();
         $last_id = $dbconnect->lastInsertId();
         return $last_id;
     } catch (PDOException $e) {
         echo "Erreur : " . $e->getMessage();
     }
    }
}
?>
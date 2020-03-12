<?php
class MP {
      
    public $dbconnect;

  //connexion automatique à la bdd
  function __construct(){
      global $dbconnect;
      try{
          $server = 'localhost';
          $db = 'common-database';
          $user = 'root';
          $pass = 'noel167';
          $dbconnect = new PDO("mysql:host=$server;dbname=$db;charset=UTF8", $user, $pass);
          $dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          echo "Erreur : " . $e->getMessage();
      }
  }

    //afficher les conversations
    function view_conversations($id_member){
        global $dbconnect;
        $requete = "SELECT * FROM private_message inner join member on (private_message.id_member_receiver = member.id_member) or (private_message.id_member_sender = member.id_member) where id_member_sender=:id_member or id_member_receiver=:id_member group by member.id_member ORDER BY id_message DESC";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->execute();
        while($donnees = $prepare->fetch()){
           
            if($donnees['id_member'] != $id_member){
                echo "
                    <form class='voir_conv'>
                    
                    <div class='row messagerie_list_separator'>
                        <div class='col-md-4'>
                            <input type='hidden' class='hidden_member' value=".$donnees['id_member'].">
                            <a href='#' class='logo_user'>
                            
                            <img  src='../public/src/user.png'></a>
                            
                            <input type='hidden' class='hidden_receiver' value=".$donnees['id_member_receiver'].">
                            <input type='hidden' class='hidden_sender' value=".$donnees['id_member_sender'].">
                        </div>
                        <div class='col-md-8 messagerie_list'>"
                            .$donnees['firstname']." ".$donnees['lastname']."<br>@".$donnees['pseudo'].
                            "<div class='row'>
                                <div class='col-md-12'>"
                                    .substr($donnees['message'],0,50).
                                "</div>
                            </div>
                        </div>
                        
                    </div>
                    
                    </form>
                ";
            }
        }
        
    }

    //afficher LA conversation
    function view_messages($id_member,$id_member_receiver, $id_member_sender){
        global $dbconnect;
        $requete = "SELECT * FROM private_message inner join member on private_message.id_member_sender = member.id_member WHERE ((id_member_sender = :id_member_sender) OR (id_member_receiver=:id_member_sender)) AND ((id_member_sender = :id_member_receiver) OR (id_member_receiver=:id_member_receiver)) ORDER BY date ASC";
        $prepare = $dbconnect -> prepare("".$requete."");
        $prepare->bindParam('id_member_receiver', $id_member_receiver, PDO::PARAM_INT);
        $prepare->bindParam('id_member_sender', $id_member_sender, PDO::PARAM_INT);
        $prepare-> execute();
        

        while($donnees = $prepare->fetch()){
            $date = new DateTime($donnees['date']);
		    $new_date = $date->format('d-m-Y');
            if($donnees['id_member_sender']==$id_member){
                
                echo "<div class='conversations_sender'>";
                echo "<br>";
                echo $donnees['firstname'].$donnees['lastname'];
                echo "<br>";
                echo "<br>";
                echo $donnees['message'];
                echo "<br>";
                echo $new_date;
                echo "<br>";
                echo "</div>";
                
            } else {
                
                echo "<div class='conversations_receiver'>";
                echo "<br>";
                echo $donnees['firstname'].$donnees['lastname'];
                echo "<br>";
                echo "<br>";
                echo $donnees['message'];
                echo "<br>";
                echo $new_date;
                echo "<br>";               
                echo "</div>";

            }
        }       

    }
    //Ecrire un MP
    function write_mp($id_member_sender,$id_member_receiver,$mess){
        global $dbconnect;
        $requete = "INSERT INTO private_message (id_member_sender, id_member_receiver, message) VALUES (:id_member_sender, :id_member_receiver, :mess)";
        $prepare = $dbconnect -> prepare("".$requete."");
        $prepare->bindParam('id_member_sender', $id_member_receiver, PDO::PARAM_INT);
        $prepare->bindParam('id_member_receiver', $id_member_sender, PDO::PARAM_INT);
        $prepare->bindParam('mess', $mess, PDO::PARAM_STR);
        $prepare-> execute();
    }    
}
?>
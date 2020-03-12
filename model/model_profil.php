<?php
class Tweeter { 
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

//ajouter un commentaire
    function add_comment($id_tweet,$id_member,$content){
        global $dbconnect;
        $requete = "INSERT INTO comment (id_tweet, id_member, content) VALUES ( :id_tweet, :id_member, :content)";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_tweet', $id_tweet, PDO::PARAM_INT);
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->bindParam(':content', $content, PDO::PARAM_STR);
        $prepare->execute();
        $last_id = $dbconnect->lastInsertId();
        return $last_id;
    }

    //afficher les tweets du membre connecté (dans profil)
    function show_tweets_member_with_comment($id_member){
        global $dbconnect;
        $requete = "SELECT * FROM tweet INNER JOIN member ON tweet.id_member = member.id_member WHERE tweet.id_member = :id_member ORDER BY date DESC";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->execute();
        while($donnees = $prepare->fetch()){
            $date = new DateTime($donnees['date']);
		    $new_date = $date->format('d-m-Y');
            $id_member_retweet = $donnees['id_member_retweet'];
            echo '
                <div class="row accueil_div_tweet">
                    <div class="col-md-12">
                        <div class="row accueil_div_tweet_retweet">
                            <div class="col-md-12"></div>
                        </div>
                        <div class="row accueil_div_tweet_pseudo">
                            <div class="col-md-2"><img class="logo_user" src="../public/src/user.png"></div>
                            <div class="col-md-10"><p class="accueil_tweet_pseudo">'.$donnees['firstname'].' '.$donnees['lastname'].' '.'@'.$donnees['pseudo'].' '.$new_date.'</div>
                        </div>
                        <div class="row accueil_div_tweet_answer">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">';
                                if($id_member_retweet!=null){
                                    $requete3 = "SELECT * FROM tweet INNER JOIN member ON tweet.id_member_retweet = member.id_member WHERE tweet.id_member_retweet = :id_member_retweet";
                                    $prepare3 = $dbconnect->prepare("".$requete3."");
                                    $prepare3->bindParam(':id_member_retweet', $id_member_retweet, PDO::PARAM_INT);
                                    $prepare3->execute();
                                    $donnees3=$prepare3->fetch();
                                    echo '
                                        <div class row>
                                            <div class col-md-2></div>
                                            <div col-md-2><b>Ceci est un retweet du tweet de '.$donnees3['firstname'].' '.$donnees3['lastname'].':</b></div>
                                            <div col-md-8></div>
                                        </div>
                                    ';
                                }
                        echo '</div>
                        </div>
                        <div class="row accueil_div_tweet_text">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">'.$donnees[2].'
                            </div>
                        </div>
                        <div class="row accueil_div_tweet_image">
                            <div class="col-md-2"></div>
                            <div class="col-md-10"><img class="img_test" src="'.$donnees['img'].'"></div>
                        </div>
                        <div class="row accueil_div_tweet_comm">
                            <div class="col-md-2"></div>
                            <div class=" col-sm-3"><form class="com"><a href="#"><img class="logo_comm" src="../public/src/comm.png"><input type="hidden" class="hidden_receiver" value='.$donnees["id_tweet"].'></a></form></div>
                                <div class=" col-sm-4"><form class="retweet"><a href=""><img class="logo_retweet" src="../public/src/retweet.png"><input type="hidden" class="hidden_receiver" value='.$donnees["id_tweet"].'></a></form></div>
                                <div class=" col-sm-3"><form class="like"><a href=""><img class="logo_like" src="../public/src/like.png"><input type="hidden" class="hidden_receiver" value='.$donnees["id_tweet"].'></a></form></div>
                        </div>
                    </div>
                
            ';
            $id_tweet = $donnees['id_tweet'];
            $requete2 = "SELECT * FROM comment INNER JOIN member ON comment.id_member = member.id_member WHERE comment.id_tweet = :id_tweet";
            $prepare2 = $dbconnect->prepare("".$requete2."");
            $prepare2->bindParam(':id_tweet', $id_tweet, PDO::PARAM_INT);
            $prepare2->execute();
            echo '                    
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10"><b>Commentaires</b>:
                        <br>
                        ';
                while($donnees2 = $prepare2->fetch()){
                    $i=1;
                    $date = new DateTime($donnees['date']);
                    $new_date = $date->format('d-m-Y');
                    echo '
                        <div class="row">
                            <div class="col-md-12"><b>. </b>'.$donnees2['firstname'].' '.$donnees2['lastname'].' - le <i>'.$new_date.'</i></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">'.$donnees2['content'].'</div>
                        </div>
                    <br>
                    ';
                }
                if($donnees2==false && $i!=1){
                    echo "pas de commentaires";
                }
                echo '                        
                    </div>
            </div>
            </div>
            ';
        }
    }

    //affiche le nb de followings // a recifier ,ne marche pas
    function followings($id_member){
        global $dbconnect;
        $requete = "SELECT count(id_following) as nb FROM following WHERE id_member = :id_member ";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->execute();
        while($donnees = $prepare->fetch()){
        echo($donnees['nb']);
        }
    }

    //affiche le nb de followers // a recifier ,ne marche pas
    function followers($id_member){
        global $dbconnect;
        $requete = "SELECT count(id_follower) as nb FROM follower WHERE id_member = :id_member ";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->execute();
        while($donnees = $prepare->fetch()){
            echo($donnees['nb']);
            }
    }
}
?>
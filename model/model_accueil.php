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
    
    //ajouter un tweet
    function add_tweet($id_member, $content, $img){
        global $dbconnect;
        $requete = "INSERT INTO tweet (id_member, content, img) VALUES ( :id_member, :content, :img)";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->bindParam(':content', $content, PDO::PARAM_STR);
        $prepare->bindParam(':img', $img, PDO::PARAM_STR);
        $prepare->execute();
        $last_id = $dbconnect->lastInsertId();
        return $last_id;
    }

    //ajouter un tag
    function add_tag($id_tweet, $id_member, $pseudo){
        global $dbconnect;
        $requete = "INSERT INTO tag (id_tweet, id_member, pseudo) VALUES ( :id_tweet, :id_member, :pseudo)";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_tweet', $id_tweet, PDO::PARAM_INT);
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);//echo $id_tweet;print_r($id_member);echo $pseudo;
        $prepare->execute();
        $dbconnect->lastInsertId();
       
    }

    //ajouter un hashtag
    function add_hashtag($id_tweet, $hashtag){ //echo $id_tweet; echo $hashtag;
        global $dbconnect;
        $requete = "INSERT INTO hashtag (id_tweet, keyword) VALUES ( :id_tweet, :hashtag)";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_tweet', $id_tweet, PDO::PARAM_INT);
        $prepare->bindParam(':hashtag', $hashtag, PDO::PARAM_STR);
        $prepare->execute();
        $dbconnect->lastInsertId();
        
    }
    //afficher les tweets des followings du membre connecté AVEC COMMENTAIRES (dans accueil)
    function show_tweets_followings_with_comment($id_member){
        global $dbconnect;
        $requete = "SELECT * FROM tweet INNER JOIN member ON tweet.id_member = member.id_member INNER JOIN following ON tweet.id_member = following.id_following WHERE following.id_member = :id_member ORDER BY tweet.date DESC";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->execute();
        while($donnees = $prepare->fetch()){
            $id_member_retweet = $donnees['id_member_retweet'];
            $date = new DateTime($donnees['date']);
		    $new_date = $date->format('d-m-Y');
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
                            <div class="col-md-10">'.$donnees[2].'</div>
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
                </div>
            ';
            $id_tweet = $donnees['id_tweet'];
            $requete2 = "SELECT * FROM comment INNER JOIN member ON comment.id_member = member.id_member WHERE comment.id_tweet = :id_tweet ORDER BY comment.date DESC";
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
                    $date = new DateTime($donnees2['date']);
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
            </div>';
        }
    }
    
    //afficher les followings du membre (ceux que l'on suit)
    function show_followings($id_member){
        global $dbconnect;
        $requete = "SELECT * FROM member INNER JOIN following ON member.id_member = following.id_following WHERE following.id_member= :id_member LIMIT 5";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->execute();
        $i=0;
        while($donnees = $prepare->fetch()){
            $i++;
            echo '
                <div class="row row_followings">
                    <div class="col-md-2"><img class="logo_user_follow" src="../public/src/user.png"></div>
                    <div class="col-md-10">'.$donnees["firstname"]." ".$donnees["lastname"].'
                        <div class="row row_followings">
                            <div class="col-md-4">'.$donnees["pseudo"].'</div>
                            <div class="col-md-8"><input class="button_desabonne btn btn-primary" type="button" value="Se désabonner"><input type="hidden" name="hidden_id" value="'.$donnees["id_following"].'"></div>
                        </div>
                    </div>
                </div>
            ';
        }
        switch ($i){
            case 0:
            echo '
                <div class="row row_followers">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">Vous ne suivez personne actuellement...</div>
                </div>
            ';
            break;
            case 5:
                echo '
                <div class="row row_followers">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 voir_plus"><input type="button" value="voir plus..."></div>
                </div>
            ';break;
        }
        
    }

    //afficher les followers d'un membre (ceux qui nous suivent)
    function show_followers($id_member){
        global $dbconnect;
        $requete = "SELECT * FROM member INNER JOIN following ON member.id_member = following.id_member WHERE following.id_following = :id_member LIMIT 5";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->execute();
        $i = 0;
        while($donnees = $prepare->fetch()){
            $i++;
            echo '
                <div class="row row_followers">
                    <div class="col-md-2"><img class="logo_user_follow" src="../public/src/user.png"></div>
                    <div class="col-md-10">'.$donnees["firstname"]." ".$donnees["lastname"].'
                        <div class="row row_followers">
                            <div class="col-md-5">'.$donnees["pseudo"].'</div>
                            <div class="col-md-7"><input class=" btn btn-primary button_suivre abo" type="button" value="Suivre"><input type="hidden" name="hidden_id" value="'.$donnees["id_member"].'"></div>
                        </div>
                    </div>
                </div>
            ';
        }
        switch ($i){
            case 0:
            echo '
                <div class="row row_followers">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">Personne ne vous suit actuellement... :(</div>
                </div>
            ';
            break;
            case 5:
                echo '
                <div class="row row_followers">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 voir_plus"><input type "button" value="voir plus..."></div>
                </div>
            ';
            break;
        }
        
    }
  
    function like($id_member, $id_tweet){
        global $dbconnect;
        $requete = "INSERT INTO tweet (id_tweet, id_member) VALUES ( :id_tweet, :id_member)";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->bindParam(':id_tweet', $id_tweet, PDO::PARAM_INT);
        $prepare->execute();
        //......
    }

    //chercher les tags
    function search_tag($pseudo){
        global $dbconnect;
        $param = "{$pseudo}%";
        $requete = "SELECT * FROM member WHERE pseudo LIKE :pseudo";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':pseudo', $param, PDO::PARAM_STR);
        $prepare->execute();
        $donnees = $prepare->fetch();
            echo "<div><form ><input type='hidden' value='".$donnees['id_member']."' ><a href='./profil.php?pseudo=".$donnees['pseudo']."' id='a_pseudo' >".$donnees['pseudo']."</a><input type='hidden' value='".$donnees['pseudo']."' ></form>
            </div>";
        
    }

    /*function upload_img($img){
        global $dbconnect;
        $requete = "INSERT INTO `tweet`(`id_tweet`, `id_member`, `content`, `img`) VALUES (42,7,'contenu','$img',)";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->execute();
        
    }*/
    //retweet
    function add_retweet($id_tweet, $id_member){
        global $dbconnect;
        $requete = "SELECT * FROM tweet WHERE id_tweet=:id_tweet";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_tweet', $id_tweet, PDO::PARAM_INT);
        $prepare->execute();
        $donnees = $prepare->fetch();
        $id_member_retweet = $donnees['id_member'];
        $requete = "INSERT INTO tweet (id_member, content, img, id_member_retweet) VALUES ( :id_member, :content, :img, :id_member_retweet)";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->bindParam(':content', $donnees['content'], PDO::PARAM_STR);
        $prepare->bindParam(':img', $donnees['img'], PDO::PARAM_STR);
        $prepare->bindParam(':id_member_retweet', $id_member_retweet, PDO::PARAM_INT);
        $prepare->execute();
        echo "ajout reussi!";
    }

    //se desabonner
    function desabonne($id_member,$id_following){
        global $dbconnect;
        $requete = "DELETE FROM following WHERE id_following=:id_following AND id_member=:id_member";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_following', $id_following, PDO::PARAM_INT);
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->execute();
        $requete = "SELECT * FROM member WHERE id_member=:id_following";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_following', $id_following, PDO::PARAM_INT);
        $prepare->execute();
        while($donnees = $prepare->fetch()){
        echo($donnees['pseudo']);
        }
    }
    function abonne($id_member,$id_following){
        global $dbconnect;
        $requete = "INSERT INTO following (id_following, id_member) VALUES (:id_following, :id_member)";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_following', $id_following, PDO::PARAM_INT);
        $prepare->bindParam(':id_member', $id_member, PDO::PARAM_INT);
        $prepare->execute();
        $requete = "SELECT * FROM member WHERE id_member=:id_following";
        $prepare = $dbconnect->prepare("".$requete."");
        $prepare->bindParam(':id_following', $id_following, PDO::PARAM_INT);
        $prepare->execute();
        while($donnees = $prepare->fetch()){
        echo($donnees['pseudo']);
        }
        
    }


    
    //ecrire un MP
    function write_mp($id_member_sender,$id_member_receiver,$mess){
        global $dbconnect;
        $requete = "INSERT INTO private_message (id_member_sender, id_member_receiver, message) VALUES (:id_member_sender, :id_member_receiver, :mess)";
        $prepare = $dbconnect -> prepare("".$requete."");
        $prepare->bindParam('id_member_sender', $id_member_receiver, PDO::PARAM_INT);
        $prepare->bindParam('id_member_receiver', $id_member_sender, PDO::PARAM_INT);
        $prepare->bindParam('mess', $mess, PDO::PARAM_STR);
        $prepare-> execute();
    } 
    
    //verifier si ddeja abo  // A VERIFIER AVEC MICK me renvoie toujours 1 !
    function verif_abo($id_member, $id_following){
        global $dbconnect;
        $requete = "SELECT * FROM following WHERE id_member=:id_member";
        $prepare = $dbconnect -> prepare("".$requete."");
        $prepare->bindParam('id_member', $id_member, PDO::PARAM_INT);
        $result = $prepare-> execute();
        while($donnees = $prepare->fetch()){
            if($donnees['id_following'] == $id_following){
                $result= 'Vous êtes déjà abonné à ce membre';
                return $result;
            }
            
        }
        
    }
}

?>
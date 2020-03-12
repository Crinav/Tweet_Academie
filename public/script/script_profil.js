$(document).ready(function () {
    //affiche les tweet et commentaires
    $.ajax({ 
        type: 'POST',
        url: '../controleur/controleur_profil.php',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: 'affiche_comm=affiche'
    })
    .done(function(response) {
        $("#tweet_et_comm").html(response);
       
    });
    
    //affiche le nb de followings
    $.ajax({ 
        type: 'POST',
        url: '../controleur/controleur_profil.php',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: 'affiche_followings=affiche'
    })
    .done(function(response) {
        $("#followings").html(response);
    });

    //affiche le nb de followers
    $.ajax({ 
        type: 'POST',
        url: '../controleur/controleur_profil.php',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: 'affiche_followers=affiche'
    })
    .done(function(response) {
        $("#followers").html(response);
    });
});
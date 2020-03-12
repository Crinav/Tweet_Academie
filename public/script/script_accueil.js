$(document).ready(function () {
    //affiche les tweets
    $.ajax({ 
        type: 'POST',
        url: '../controleur/controleur_accueil.php',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: 'affiche_tweet=affiche'
    })
    .done(function(response) {
        $(".affiche_tweet").append(response);
       
    }); 
    //affiche les followings
    $.ajax({ 
        type: 'POST',
        url: '../controleur/controleur_accueil.php',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: 'affiche_followings=affiche'
    })
    .done(function(response) {
        $(".accueil_right_followings").append(response);
       
    });
    //affiche les followers
    $.ajax({ 
        type: 'POST',
        url: '../controleur/controleur_accueil.php',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: 'affiche_followers=affiche'
    })
    .done(function(response) {
        $(".accueil_right_followers").append(response);
       
    });       
 
//refresh les tweets followings sur la page d'accueil// a finir
    /*function refresh_div() {
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_accueil.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: 'affiche_tweet=affiche'
        })
        .done(function(response) {
            $(".accueil_menu").append(response);
           
        }); 
    } */   
    //time = setInterval(refresh_div,10000);

    $('.logo_research').click(function(){
        var datas = $('#search').val();
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_accueil.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: "research="+datas
        })
        .done(function(response) {
            if(phrase.substring(0,1) == "#"){
                // action pour les #
                phrase = "";
                $('#search').val("");
            }
            if(phrase.substring(0,1) == "@"){
                $('.result').css({
                'background-color':'rgb(229, 239, 245)',
                 'margin-bottom':'2%','padding':'2%',
                 'border-radius':'10%'})
                $('.result').html(response);
                phrase = "";
               $('#search').val("");
            }
        });
    })
    //recherche de tag et hashtag dans la barre de recherche
    let phrase = "";
    $('#search').keypress(function(event){
        let  a = event.key;
        phrase += a;
        if(phrase.substring(0,1) == "@"){
            $(this).css("color","red");       
        }
        if(phrase.substring(0,1) == "#" ){
            $(this).css("color","green");
        }
        if(a == "Delete" || a == "Backspace"){
            $(this).css("color","black");
            phrase = phrase.substring(0,phrase.length-1);
        }
        $('#search').on('keydown', function(event) {
            if (event.which === 32)
              return false;
        })
        var key = event.which;
        if(key == 13){
            $('.logo_research').click();
            return false;  
        }
     return phrase;   
    })
    
    //selectionner un tag
    $(document).on('click','#a_pseudo', function(e){
        e.preventDefault();
        let id = $(this).prev().val();
        let pseudo = $(this).next().val();
        let text = $('.tag').append($('<div class="row">\
        <form class="media-body mp">\
          <div class="form-group basic-textarea rounded-corners">\
            <textarea class="form-control z-depth-1" id="textarea_tag" rows="3" placeholder="Ecrivez lui un message privé..."></textarea>\
            <input type="submit" class="btn btn-primary" id="mp" value="Envoyer">\
            <input type="hidden" class="hidden_id" id="hidden_mess" value="'+id+'">\
            </div>\
        </form>\
      </div>'));
        
         
 
    })
    //tweet
    $('#form_tweet').submit(function(event){
        event.preventDefault();
        let strlong = $('#input_quoi').val().length;
        if(strlong < 140){
            var datas = $("#input_quoi").val();
            $.ajax({ 
                type: 'POST',
                url: '../controleur/controleur_accueil.php',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
                data: 'tweet='+datas
            })
            .done(function(response) {
           // $(".accueil_menu").append(response);
            $("#input_quoi").val("");
            (response == 'tweet ok')?alert('Votre Tweet a bien été envoyé !'):alert('Une erreur est survenu, veuillez nous en excuser');
            }) 
            .fail(function (jqXHR, textStatus, errorThrown) {
                alert('Une erreur est survenu, veuillez nous en excuser');
            }); 
        }
        else{
            alert('Veuillez écrire un Tweet de moins de 140 caractères s\'il vous plait');
        }  
    });
    //compteur de caractères
    $('#input_quoi').keyup(function(){
        var long = $(this).val().length;
        $('#input_quoi_carac').val(long);
        

    })
    $('#input_quoi').mousedown(function(event){	
        var new_long = $('#input_quoi').val().length;
        $('#input_quoi_carac').val(new_long);
        
    })
        
//deconnexion
    $("#logout").click(function (event) {
        event.preventDefault();
         deconnexion();   
    });

    function deconnexion(){
        var data = {logout: 'logout'};
        $.ajax({ 
            type: 'post',
            url: '../controleur/controleur_accueil.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
            data: data
        })
        .done(function (response){
            if(response == 'logout'){
                window.location = '../index.php';}
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert("Echec de deconnexion..."+
            "Une erreur est survenue !");
        });
    }

    //ajouter un commentaire
    $(document).on('click','.logo_comm' ,function(){
        let cible = $(this).parent().parent().parent().parent().parent();
        $('textarea').remove('#textarea');
        $('input').remove('#commentaire');
        $('input').remove('#hidden_comm');
        let current_id_tweet = $(this).next().val();
        let text = cible.append($('<div class="row textarea">\
        <form class="media-body">\
          <div class="form-group basic-textarea rounded-corners">\
            <textarea class="form-control z-depth-1" id="textarea" rows="3" placeholder="Ecrivez votre commentaire..."></textarea>\
            <input type="submit" class="btn btn-primary" id="commentaire" value="Envoyer">\
            <input type="hidden" class="hidden_id" id="hidden_comm" value="'+current_id_tweet+'">\
            </div>\
        </form>\
      </div>'));
       $('#textarea').focus();
     })
     
    $(document).on('click','#commentaire' ,function(event){
       event.preventDefault(); 
       var content = $(this).prev().val();
       let id_tweet = $(this).next().val();
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_profil.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {'comm': content, 'id_tweet': id_tweet}
        })
        .done(function(response) {
        $('textarea').remove('#textarea');
        $('input').remove('#commentaire');
        $('input').remove('#hidden_comm');
        }); 
    })
    //retweet
    $(document).on('click','.logo_retweet' ,function(event){
        event.preventDefault();
        var datas = $(this).next().val();
         $.ajax({ 
             type: 'POST',
             url: '../controleur/controleur_accueil.php',
             contentType: "application/x-www-form-urlencoded; charset=UTF-8",
             data: {'retweet': datas}
         })
         .done(function(response) {
             if(response == 'ajout reussi!'){
                window.location = './accueil.php';;
             }
         
         }); 
     })
     //like
     $(document).on('click','.logo_like' ,function(event){
        event.preventDefault();
        var datas = $(this).next().val();
         $.ajax({ 
             type: 'POST',
             url: '../controleur/controleur_accueil.php',
             contentType: "application/x-www-form-urlencoded; charset=UTF-8",
             data: {'like': datas}
         })
         .done(function(response) {
             $(".show_messages").append(response);
         
         }); 
     })
    
     //image
     /*$('#btn_upload').click(function(event){
        event.preventDefault();
        var formdata = new FormData();
        var files = $('#image')[0].files[0];
        formdata.append('image',files);
        
        
    alert(files);
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_accueil.php',
            enctype: 'multipart/form-data', 
            data: formdata,
            processData: false,
            contentType: false,
            cache: false
        })
        .done(function(response) {
           alert(response);
           if(response == 'reussi'){
               alert('upload réussi');
           }
           if(response == 'echec'){
            alert('upload interrompu');
        }      
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert('fail');
        });
        
    })*/

    //supprimer un follow
    $(document).on('click', '.button_desabonne',function(e){
        e.preventDefault();
        var id = $(this).next().val();
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_accueil.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {'id': id}
        })
        .done(function(response) {
            alert('Vous venez de vous désabonner de '+response);
            window.location ='./accueil.php';
        }); 
    })
    //s abonner a un tag
    $(document).on('submit', '#form_abo', function(e){
        e.preventDefault();
        let datas = $('#abo').next().val();
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_accueil.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: 'abo='+datas
        })
        .done(function(response) {
            if(typeof response === 'string'){
                alert('Vous venez de vous abonner à '+response);
                window.location ='./accueil.php';
            }
            else{
                alert('Vous êtes déjà abonné à ce membre');
            }
        }); 
    })
    $(document).on('click', '.abo', function(e){
        e.preventDefault();
        let datas = $('.abo').next().val();
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_accueil.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: 'abo='+datas
        })
        .done(function(response) {
            if(typeof response === 'string'){
                alert('Vous venez de vous abonner à '+response);
                window.location ='./accueil.php';
            }
            else{
                alert('Vous êtes déjà abonné à ce membre');
            }
        }); 
    })
    //MP un tag
    $(document).on('submit', '.mp', function(e){
        e.preventDefault();
        let id = $('#mp').next().val();
        let mess = $('#textarea_tag').val();
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_accueil.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {'mp':id, 'mess':mess}
        })
        .done(function(response) {
            alert('Votre message a bien été posté à ce membre');
        
        }); 
    })
});
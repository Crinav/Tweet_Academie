$(document).ready(function () {
    $.ajax({ 
        type: 'POST',
        url: '../controleur/controleur_messagerie.php',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: 'affiche_messages=affiche'
    })
    .done(function(response) {
        $(".accueil_menu").append(response);
       
    }); 

    $(document).on('click','.logo_user' ,function(){
        $(".show_messages").text("");
        var id = $(this).prev().val();
       var sender = $(this).next().next().val();
       var receiver = $(this).next().val();
       $(".show_messages").append($('<div class="row textarea">\
            <form class="media-body">\
              <div class="form-group basic-textarea rounded-corners">\
                <textarea class="form-control z-depth-1" id="textarea" rows="3" placeholder="Ecrivez votre message privé..."></textarea>\
                <input type="submit" class="btn btn-primary" id="message" value="Envoyer">\
                <input type="hidden" class="hidden_id" id="hidden_mess" value="'+id+'">\
                </div>\
            </form>\
          </div>'));
          $('#textarea').focus();
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_messagerie.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: {'sender': sender, 'receiver': receiver}
        })
        .done(function(response) {
            $(".show_messages").append(response);
        });
         
    })
     
    //recherche
    let phrase = "";
    $('#search').keyup(function(event){
        let  a = event.key;
        phrase += a;
        if(phrase.substring(0,1) == "#" || phrase.substring(0,1) == "@"){
            $(this).css("color","blue");
            
            
        }
        if(a == "Delete" || a == "Backspace"){
            $(this).css("color","black");
            phrase = "";
        }
        
     return phrase;   
    })
    $('.logo_research').click(function(){
        var datas = $('#search').val();
        $.ajax({ 
            type: 'GET',
            url: '../controleur/controleur_accueil.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            data: "research="+datas
        })
        .done(function(response) {
            if(phrase.substring(0,1) == "#"){
                // action pour les #
            }
            if(phrase.substring(0,1) == "@"){alert(response);
            //window.location= "profil.php?pseudo="+response;
           }
        });
    })

    $(document).on('click','#message',function(event){
        event.preventDefault();
        let id = $('#hidden_mess').val();
        let datas = $('textarea').val();
        
        $.ajax({
            type: 'POST',
            url: '../controleur/controleur_messagerie.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
            data: {'mess':datas, 'id_mess':id }
            
        })
        .done(function(response){
            $(".show_messages").text("");
            alert(response);
            
        }) 
    })     
})
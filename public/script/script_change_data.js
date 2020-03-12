$(document).ready(function () {
    //editer son profil
    $('#form_edition').submit(function(e){
        e.preventDefault();
        let datas = $(this).serialize();
        $.ajax({ 
            type: 'POST',
            url: '../controleur/controleur_change_data.php',
            contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
            data: datas
        })
        .done(function (response){
            if(response == 'réussi' ){
                    window.location = './accueil.php';
                }
            else if(response == 'erreur_pseudo'){
                alert("Echec de l'enregistrement...Ce pseudo est déjà pris.");
            }
            else if(response == 'erreur_email'){
                alert("Echec de l'enregistrement...Cet email est déjà pris.");
            }
            else{alert('passé ds le else')}
        })
        .fail(function () {
                alert("Echec de l'enregistrement..."+
                "Une erreur est survenue !");alert()
        });
    });
})
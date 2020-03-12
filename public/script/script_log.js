$(document).ready(function () {

	$("#log").click(function (event) {
		event.preventDefault();
		log();   
	});

	$("#form_inscription").submit(function (event) {
		event.preventDefault();
		inscription();   
	});
});

function log(){
	var data = $('#form_log').serialize();
	if(data.length > 18){
		$.ajax({ 
				type: 'post',
				url: './controleur/controleur_log.php',
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",  
				data: data
		})
		.done(function (response){
			if(response == $('#email').val()){
					window.location = './view/accueil.php';}
				if(response== 'erreur'){
					alert("Echec de l'authentification...Verifiez votre mail et votre mot de passe");
				}
		})
		.fail(function () {
				$("#reponse_log").html("Echec de l'authentification..."+
				"Une erreur est survenue !");
		});
	}
	else{
		alert("Veuillez compléter tous les champs s'il vous plait");
		
	}
}

function inscription(){
	
	var data = $('#form_inscription').serialize();
	console.log(data);
	if ($('#check_age').is(':checked')) { 
		$.ajax({ 
				type: 'post',
				url: '../controleur/controleur_inscription.php',
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				dataType: "json",  
				data: data
		})
		.done(function (response){
			if(typeof response == 'number' ){
					window.location = './accueil.php';
				}
			if(response == 'erreur_pseudo'){
				alert("Echec de l'inscription...Ce pseudo est déjà pris.");
			}
			if(response == 'erreur_email'){
				alert("Echec de l'inscription...Cet email est déjà pris.");
			}
		})
		.fail(function () {
				alert("Echec de l'inscription..."+
				"Une erreur est survenue !");
		});
	}
	else{
		alert('Si vous avez plus de 16 ans , veuillez cocher la case ci dessous');
	}
}
    
    
        
    
    


    

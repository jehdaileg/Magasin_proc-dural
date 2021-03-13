
$(document).ready(function () {

    //afficher l'ancien mot de passe 

	var inputOldPassword=$('.ancienMotDePasse');

	$('.voirAncienMotDePasse').hover(

		 function () {
			inputOldPassword.attr(name:'type', value:'text');
		},

		 function () {
			inputOldPassword.attr(name:'type', value:'password');
		}
	
		)

	//afficher le nouveau mot de passe 

	var inputNewPassword=$('.nouveauMotDePasse');

	$('.voirNouveauMotDePasse').hover(

		 function () {
			inputNewPassword.attr(name:'type', value:'text');
		},

		 function () {
			inputNewPassword.attr(name:'type', value:'password');
		}

		)

});
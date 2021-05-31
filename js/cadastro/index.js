$(document).ready(function(){
	$("#bCadastrar").click(function(){

		var u = document.forms["form-cadastro"]["usuario"].value;
		var e = document.forms["form-cadastro"]["email"].value;
		var c = document.forms["form-cadastro"]["cpf"].value;
		var s = document.forms["form-cadastro"]["senha"].value;

		if (u == "" || e == "" || c == "" || s == "") {
	  	alert("Campos não foram preenchidos!");
		}
			if(verificaSenha() != false){
				var sha256 = sjcl.hash.sha256.hash($('#senha').val());
				var sha256_hexa = sjcl.codec.hex.fromBits(sha256);
		
				$("#senha_hash").val(sha256_hexa);
		
				fLocalComunicaServidor('form-cadastro', 'cadastro');
		
				return false;
			}
	});

});

function fLocalComunicaServidor(formulario, arquivo){

	var dados = $("#"+formulario).serialize();

	$.ajax({
		type:"POST",
		dataType: "json",
		url: "/Project/php/"+arquivo+".php",
		data: dados,
	 	// beforeSend : function(){
		// 	$("#bAcessar").html('Aguarde');
	    // },
		success: function(retorno){
			if(retorno.funcao == "cadastro")
			{
				if(retorno.status == "s")
				{
					alert("Usuário cadastrado!");
					window.location.href = "https://gabrielproject/Project/php/envia-email.php";
				} 
				else 
				{
				alert("erro");
				}
			}
		},
		error: function(){
			alert("Ocorreu um erro");
		}
		
	});
}

function verificaSenha() {
	var senha = document.getElementById("senha").value;
	if(senha.length < 8) {
	   alert("Senha muito curta!");
	   return false;
	}
}







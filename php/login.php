<?php

 session_start();
 
 require "config.php";

 
	$usuario = $_POST["usuario"] ?? "";
	$senha = $_POST["senha_hash"] ?? "";

	$query = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";

	$resultado = mysqli_query($conexao, $query);

	$retorno["status"] = "n";
	$retorno["mensagem"] = "usuario não cadastrado";
	$retorno["funcao"] = "login";
	
	//$count = mysqli_num_rows($resultado);

	if(mysqli_num_rows($resultado) > 0) 
	{
		$registro = mysqli_fetch_assoc($resultado);

		$_SESSION["usuario"] = $registro["usuario"];
		$_SESSION["inicio"] = time();
		$_SESSION["tempolimite"] = 15; // 15 segundos
		$_SESSION["id"] = session_id();

		$retorno["status"] = "s";
		$retorno["mensagem"] = $_POST['usuario'].", confirme o seu código!";
		//$retorno["unico"] = "ok";
	}
	// print_r($_SESSION);

	// echo json_encode($retorno);
	
	if($resultado == false) {
		die($mysqli -> error);
	}

		$expirar = 60;

	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($expirar * 60))) {

		session_unset(); 
		session_destroy();
	}
	//}


	//print_r($_SESSION);
	echo json_encode($retorno);

?>
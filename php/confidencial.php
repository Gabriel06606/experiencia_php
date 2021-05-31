<?php

session_start();
require "config.php";

	//$usuario = $_POST["usuario"] ?? "";
	$codigo = $_POST["codigo"] ?? "";

    $query = "SELECT codigo FROM usuario WHERE codigo = '$codigo'";

	$resultado = mysqli_query($conexao, $query);

	$registro = mysqli_fetch_assoc($resultado);

	if($_SESSION["codigo"] = $registro["codigo"]){
		$retorno["status"] = "1";
		

	}

	echo json_encode($retorno);

	if($resultado == false) {
		die($mysqli -> error);
	}

		$expirar = 60;

	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($expirar * 60))) {

		session_unset(); 
		session_destroy();
	}


?>
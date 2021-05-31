<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();

require "config.php";

$geraCodigo = $_SESSION['codigo'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require "C:/xampp/htdocs/Project/PHPMailer/vendor/autoload.php";

$mail = new PHPMailer();

$mail->IsSMTP();

$mail-> SMTPOptions = array ( //Código para solucionar o erro de versão
    'ssl' => array (
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);


try {
    
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPDebug = 0;
    $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->Username = "GLPucpr@gmail.com";
    $mail->Password = "GLP12345";
    $mail->AddAddress('GLPucpr@gmail.com', 'voce');
    $mail->SetFrom('GLPucpr@gmail.com');
    $mail->Subject = 'Código de Verificação';
    $mail->CharSet = 'UTF-8';
    $body = "";
    $mail->MsgHTML(nl2br( "Seu código é: " . $geraCodigo . "\nGuarde e não compartilhe com ninguém"));
    $mail->Send();
    echo "Por favor, verifique seu e-mail.</p>\n";
} catch ( phpmailerException $e ) {
    echo $e->errorMessage();
} catch ( Exception $e ) {
    echo $e->getMessage();
}
?>

<button onclick="window.location.href='../paginas/index.html'" class="btn btn-primary btn-block py-2 mt-0">Voltar</button>
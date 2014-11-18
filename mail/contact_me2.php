<?php
// Check for empty fields
if(empty($_POST['name1'])  		||
   empty($_POST['endereco']) 		||
   empty($_POST['curso']) 		   ||
   empty($_POST['equipe']))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name1 = $_POST['name1'];
$endereco = $_POST['endereco'];
$curso = $_POST['curso'];
$equipe = $_POST['equipe'];
	
// Create the email and send the message
$to = 'romero_claudino@hotmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Formulario de contato do site:  $name1";
$email_body = "Voce recebeu uma noa mensagem do seu formulario de contato do site\n\n"."Aqui estao os detalhes:\n\nNome: $name1\n\nEndereco: $endereco\n\nCurso: $curso\n\nEquipe:\n$equipe";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $name1";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>

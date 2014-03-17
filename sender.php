<?php 
$caiacsa = $_POST["caiaca"];

$destinatario = "adp.alex@gmail.com"; 
$asunto = "Reserva web de "; 
$cuerpo = ' 
<html> 
<head> 
   <title>Nova reserva</title> 
</head> 
<body> 
<h1>Nova reserva <script> document.write(localStorage.getItem("nom"));</script> </h1> 
<p> 
<b>Bienvenidos a mi correo electrónico de prueba</b>. Estoy encantado de tener tantos lectores. Este cuerpo del mensaje es del artículo de envío de mails por PHP. Habría que cambiarlo para poner tu propio cuerpo. Por cierto, cambia también las cabeceras del mensaje. 
</p> 
</body> 
</html> 
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Miguel Angel Alvarez <pepito@desarrolloweb.com>\r\n"; 

mail($destinatario,$asunto,$cuerpo,$headers) 
?>
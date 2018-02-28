<?php
//Comprobamos que se haya presionado el boton enviar
if(isset($_POST['enviar'])){
//Guardamos en variables los datos enviados
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_NUMBER_INT);
$asunto = filter_input(INPUT_POST, 'asunto', FILTER_SANITIZE_SPECIAL_CHARS);
$mensaje = filter_input(INPUT_POST, 'asunto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

 
///Validamos del lado del servidor que el nombre y el email no estén vacios
if($nombre == ''){
echo "Debe ingresar su nombre";
}
else if($email == ''){
echo "Debe ingresar su email";
}else{
$para = "struendo14@hotmail.com";//Email al que se enviará
$asunto .= " desde Street Style";//Puedes cambiar el asunto del mensaje desde aqui
//Este sería el cuerpo del mensaje
$mensaje = "
Nombre: $nombre <br>
E-mail: $email <br>
Teléfono: $telefono<br>
Asunto: $asunto<br>
Mensaje: $mensaje<br>";
 
//Cabeceras del correo
$headers = "From: $nombre <$email>\r\n"; //Quien envia?
$headers .= "X-Mailer: PHP5\n";
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; //
 
//Comprobamos que los datos enviados a la función MAIL de PHP estén bien y si es correcto enviamos
if(mail($para, $asunto, $mensaje, $headers)){
header('Location: http://18.195.43.68/cms/public/index.php');
echo "Su mensaje se ha enviado correctamente";
echo "<br />";
echo '<a href="../formulario_contacto.html">Volver</a>';
}else{
echo "Hubo un error en el envío inténtelo más tarde";
}
}
}
?>

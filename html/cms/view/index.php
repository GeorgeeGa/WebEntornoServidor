<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h3>Id es: <?php echo $datos->id ?> </h3>
<h3>Usuario es: <?php echo $datos->usuario ?> </h3>
<h3>Clave es: <?php echo $datos->clave ?> </h3>
<h3>Fecha de Acceso es: <?php echo $datos->fecha_acceso ?> </h3>
<h3>Activo: <?php echo $datos->activo ?> </h3>
<h3>Usuarios: <?php echo $datos->usuarios ?> </h3>
</body>
</html>

<?php

    if(hash_equals($datos->clave, crypt('1', $datos->clave))){
        echo "¡Contraseña verificada!";
    }

?>
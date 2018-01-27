
<div>
<p>Id es: <?php echo $datos->id ?> </p>
<p>Usuario es: <?php echo $datos->usuario ?> </p>
<p>Clave es: <?php echo $datos->clave ?> </p>
<p>Fecha de Acceso es: <?php echo $datos->fecha_acceso ?> </p>
<p>Activo: <?php echo $datos->activo ?> </p>
<p>Usuarios: <?php echo $datos->usuarios ?> </p>
</div>
<?php

    if(hash_equals($datos->clave, crypt('1', $datos->clave))){
        echo "¡Contraseña verificada!";
    }

?>

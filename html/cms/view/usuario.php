
<?php
// Muestro el navegador del panel

require("../view/partials/navegadorPanel.php");

?>
<div class="contenido_panel">
        <ul class="panel_titulo">
            <li class="panel_datosIzq"><h5>Editar usuario</h5></li>
        </ul>       
    <div class="panel_usuario_editar">
        <div class="contenedor"
            <p> Edita los datos de usuario que desees.</p>
            <form class="panel_usuarios panel_datosIzq" method="POST" action="">
                <div><p class="enLinea">Usuario:</p><input class="usuario"type="text" name="usuario" value="<?php echo $datos->usuario ?> " autocomplete="off"></div>
                <div><p class="enLinea"> Marca para cambiar la clave.</p><input id="checkClave" name="checkClave" class="permisos" type="checkbox"></div>
                <div id="clave" class="displayOff"><p class="enLineaEspecial">Clave:</p><input class="clave" type="password" name="clave" value=""></div>
                <div><p>Permisos:</p></div>
                <?php $usuarios = ($datos->usuarios ==1) ? 'checked' : '' ?>
                Usuarios <input class="permisos" type="checkbox" name="usuarios" <?php echo $usuarios ?> >
                <?php $noticias = ($datos->noticias ==1) ? 'checked' : '' ?>
                Noticias <input class="permisos" type="checkbox" name="noticias" <?php echo $noticias ?>><br>
                <div class="marginTop"><a href="<?php echo $_SESSION['home'] ?>panel/usuarios"><input  class="guardar" type="button" name="volver" value="Volver"></a>
                <input class="guardar" type="submit" name="guardar" value="Guardar"></div>
            </form>  
        </div>
    </div>
</div>
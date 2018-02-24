<?php
// Muestro el navegador del panel

require("../view/partials/navegadorPanel.php");

?>
<div class="contenido_panel">
        <ul class="panel_titulo">
            <li class="panel_datosIzq"><h5>Editar noticia</h5></li>
        </ul>       
    <div class="panel_noticia_editar">
        <div class="contenedor">
            <p> Edita los datos de la noticia que desees.</p>
            <form enctype="multipart/form-data" class="panel_usuarios panel_datosIzq" method="POST" action="">
                <div class="columnaNoticias">
                <div><p class="enLinea">Título:</p><input class="noticia" type="text" name="titulo" value="<?php echo $datos->titulo ?> " autocomplete="off"></div>
                <div><p class="enLinea">Autor:</p><input class="entradilla"type="text" name="autor" value="<?php echo $datos->autor ?> "></div>
                <!-- <div><p class="enLinea">Entradilla:</p><input class="entradilla"type="text" name="entradilla" value="<?php// echo $datos->entradilla ?> "></div> -->
                <div><p class="">Entradilla:</p><textarea type="text" name="entradilla" rows="2" cols="100"><?php echo $datos->entradilla ?></textarea> </div>
                
                <div><p class="marginTop">Texto:</p><textarea type="text" name="texto" rows="5" cols="100"><?php echo $datos->texto ?></textarea> </div>
                <div><p class="enLinea marginTop marginBottom0"> Marca para cambiar o subir una foto.</p><input id="checkImagen" name="checkImagen" value="ok" class="permisos" type="checkbox"></div>
                <div class="displayOff" id="imagen" ><input type="file" name="archivo"/></div>
                <div><p class="marginTop">Permisos:</p></div>
                   <?php $home = ($datos->home ==1) ? 'checked' : '' ?>
                   Home <input class="permisos" type="checkbox" name="home" <?php echo $home ?>>
                <div class="marginTop"><a href="<?php echo $_SESSION['home'] ?>panel/noticias"><input  class="guardar" type="button" name="volver" value="Volver"></a>
                   <input class="guardar" type="submit" name="guardar" value="Guardar"></div>
                </div>
            </form>  
        </div>
    </div>
</div>
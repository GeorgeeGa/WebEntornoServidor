<?php
// Muestro el navegador del panel

require("../view/partials/navegadorHome.php");

?>
    
<div class="contenido_home">
    <div class="info">
        <div class="texto_estatico">
            <div><h2>Feel</h2></div>
            <div><h2>Fashion</h2></div>
            <p>Feel fashion es un blog de moda que tiene como objetivo informar 
            y trasmitir todo lo que sucede en los eventos de moda más importantes
            del planeta.</p>
        </div>
    </div>
    <div class="noticias_home">
        <h2>Eventos destacados</h2>
        <?php foreach ($datos as $dato){ ?>
        <?php $ruta = $_SESSION['home'] . "noticiaHome/" . $dato->slug ?>
        <div class="noticias_home_individual">
            <div class="texto_noticia">
                <a href="<?php echo $ruta ?>"><h4><?php echo $dato->titulo ?></h4></a>
                <p>by <span><?php echo $dato->autor ?></span></p>
                <p class="texto_padding"><?php echo $dato->entradilla ?></p>
            </div>
            <div class="foto_noticia">
                <img src="<?php echo $dato->imagenURL ?>">
            </div>
        </div>
        <?php } ?> 
    </div>
</div>
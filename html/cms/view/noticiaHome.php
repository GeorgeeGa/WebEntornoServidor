<?php
// Muestro el navegador del panel

require("../view/partials/navegadorHome.php");

?>

<div class="noticias_home_una">
        <?php foreach ($datos as $dato){ ?>
        <?php $ruta = $_SESSION['home'] . "noticiasHome" ?>
        <div class="noticias_home_individual">
            <div class="texto_noticia">
                <h4><?php echo $dato->titulo ?></h4>
                <p>by <span><?php echo $dato->autor ?></span></p>
                <p><?php echo $dato->texto ?></p>
            </div>
            <div class="foto_noticia">
                <img src="<?php echo $dato->imagenURL ?>">
            </div>
        </div>
    <?php } ?>
    <a href="<?php echo $ruta ?>">Ver todas las noticias</a>
    </div>
<?php
// Muestro el navegador del panel

require("../view/partials/navegadorHome.php");

?>
    <div class="foto_noticias_principal"></div>
    <div class="noticias_home_todas">
        <?php foreach ($datos as $dato){ ?>
        <?php $ruta = $_SESSION['home'] . "noticiaHome/" . $dato->slug ?>
        <div class="noticias_home_individual">
            <div class="texto_noticia">
                <a href="<?php echo $ruta ?>"><h4><?php echo $dato->titulo ?></h4></a>
                <p>by <span><?php echo $dato->autor ?></span></p>
                <p class="texto_padding" ><?php echo $dato->entradilla ?></p>
                <a href="<?php echo $ruta ?>">Ver evento completo</a>
            </div>
            <div class="foto_noticia">
                <img src="<?php echo $dato->imagenURL ?>">
            </div>
        </div>
        <?php } ?>
    </div>
</div>

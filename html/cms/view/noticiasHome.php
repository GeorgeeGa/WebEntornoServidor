<?php
// Muestro el navegador del panel

require("../view/partials/navegadorHome.php");

?>
    
    <div class="noticias_home">
        <?php foreach ($datos as $dato){ ?>
        <div class="noticias_home_individual">
            <div class="foto_noticia">

            </div>
            <div class="texto_noticia">
                <h3><?php echo $dato->titulo ?></h3><h5><?php echo $dato->autor ?></h5>
                <p><?php echo $dato->entradilla ?></p>
                <?php $ruta = $_SESSION['home'] . "noticiaHome/" . $dato->id ?>
                <a href="<?php echo $ruta ?>"><i class="far fa-edit"></i></a>
            </div>
        </div>
            <?php } ?>
        <div class="boton_home">
            <button>Todas las noticias</button>
        </div>
    </div>
</div>

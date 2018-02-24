
<?php
// Muestro el navegador del panel

require("../view/partials/navegadorPanel.php");

?>
    <div class="contenido_panel">
        <ul class="panel_titulo">
            <li class="panel_datosIzq"><h5>Usuarios</h5> <a href="<?php echo $_SESSION['home'] ?>panel/usuarios/crear">Añadir Usuario</a></li>
            <li class="panel_datosIzq"></li>
            <li class="panel_datosDer"><h5>Acciones</h5></li>
        </ul>    
        <?php foreach ($datos as $dato){ ?>
        <ul class="panel_datos">
                <li class="panel_usuarios panel_datosIzq">
                    <?php $ruta = $_SESSION['home'] . "panel/usuarios/editar/" . $dato->id ?>
                    <a href="<?php echo $ruta ?>">
                        <?php echo $dato->usuario ?>
                    </a>    
                </li>
                <li class="panel_acciones panel_datosDer">
                    <?php $ruta = $_SESSION['home'] . "panel/usuarios/editar/" . $dato->id ?>
                    <a href="<?php echo $ruta ?>"><i class="far fa-edit"></i></a>
                    <?php $color = ($dato->activo == 1) ? 'activo' : 'inactivo' ?>
                    <?php $texto = ($dato->activo == 1) ? 'desactivar' : 'activar' ?>
                    <?php $ruta = $_SESSION['home'] . "panel/usuarios/" . $texto . "/" . $dato->id ?>
                    <a class="<?php echo $color ?>" href="<?php echo $ruta ?>" title=" <?php echo $texto ?>" ><i class="far fa-smile"></i></a>
                    <?php $ruta = $_SESSION['home'] . "panel/usuarios/borrar/" . $dato->id ?>
                    <a href="<?php echo $ruta ?>"><i class="fas fa-times"></i></a>
                    <div class="borrarOculto" id="borrar-<?php echo $dato->id ?>"
                </li>
            </ul>    
        <?php } ?>
    </div>
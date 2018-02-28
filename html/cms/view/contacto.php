<?php
// Muestro el navegador del panel

require("../view/partials/navegadorHome.php");

?>
<div class="noticias_home_una">
        <?php $ruta = $_SESSION['home'] . "home" ?>
        <div class="noticias_home_individual">
            <div class="texto_noticia">
                <p>Correo electrónico:</p>
                <h4>hi@feelfashion.com</h4>
                <p></p>
            </div>
            <div class="foto_contacto">
                <div class="formulario">
                    <form method="post" action="contacto.php">
                        Nombre: <input type="text" name="nombre" /><br>
                        Teléfono: <input type="text" name="telefono" /><br>
                        E-mail: <input type="text" name="email" /><br>
                        Asunto: <input type="text" name="asunto" /><br>
                        Mensaje: <textarea type="text" rows="4" cols="31" name="mensaje"></textarea>
                        <input type="submit" value="Enviar" name="enviar">
                    </form>
                </div>
            </div>
        </div>
</div>



<div class="panel_acceso">
        <div class="contenedor_principal">
            <div class="panel">
                <div class="logo">
                    <h1> Cms Isep Ceu </h1>
                </div>
                <div class="acceso">
                    <h3><?php echo $datos->mensaje ?> <spam> Please login.</spam></h3>
                    <form method="POST" action="">
                        <input type="text" name="usuario" placeholder="Username">
                        <input type="password" name="clave" placeholder="Password"><br>
                        <input class="boton" type="submit" name="acceder" value="Sing in">
                    </form>
                </div>
                
            </div>
<div class="panel">
    <div class="contenedor_principal">
        <div class="titulo_panel">
            <div class="logo">
            
            </div>
            <div>
                <h1>Cms de <span><?php echo $_SESSION['usuario'] ?></span></h1>
            </div>
        </div>
        <div class="navegador_vertical"
            <nav>
                <ul>
                    <a href="<?php echo $_SESSION['home'] ?>panel"><li>Inicio</li></a>
                </ul>
                <ul>
                    <a href=""><li>Noticias</li></a>
                </ul>
                <ul>
                    <a href="<?php echo $_SESSION['home'] ?>panel/usuarios"><li>Usuarios</li></a>
                </ul>
                <ul>
                    <a href="<?php echo $_SESSION['home'] ?>panel/salir"><li>Salir</li></a>
                </ul>
            </nav>
        </div>

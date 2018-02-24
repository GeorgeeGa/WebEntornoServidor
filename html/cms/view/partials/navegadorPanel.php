<div class="panel">
    <div class="contenedor_principal">
        <div class="titulo_panel">
            <div>
                <h1><span>Feel Fashion</span></h1>
            </div>
        </div>
        <div class="navegador_vertical"
            <nav>
                <ul>
                    <a href="<?php echo $_SESSION['home'] ?>panel"><li>Inicio</li></a>
                </ul>
                <ul>
                    <a href="<?php echo $_SESSION['home'] ?>panel/noticias"><li>Eventos</li></a>
                </ul>
                <!-- Mostrar usuarios o no... -->
                <ul class="<?php echo ($_SESSION['usuarios']) ? '' : 'displayOff' ?>">
                    <a href="<?php echo $_SESSION['home'] ?>panel/usuarios"><li>Usuarios</li></a>
                </ul>
                <ul>
                    <a href="<?php echo $_SESSION['home'] ?>panel/salir"><li>Salir</li></a>
                </ul>
            </nav>
        </div>

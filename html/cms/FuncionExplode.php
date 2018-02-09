<?php

function enrutamientos($ruta){
    $enrutamientos = explode("/", $ruta);
    if($enrutamientos[0] == panel){
        echo "El controlador es: UsuarioController";
        
        if($enrutamientos[1] == ""){
            echo 'Controler: acceso()';
        }elseif ($enrutamientos[1] == "salir") {
            echo 'Controler: salir()';
        }elseif ($enrutamientos[1] == "usuarios" and $enrutamientos[2] == "" ){
            echo 'Controler: index()';
        }elseif ($enrutamientos[1] == "usuarios" and $enrutamientos[2] == "crear" ){
            echo 'Controler: crear()';
        }
    }
}


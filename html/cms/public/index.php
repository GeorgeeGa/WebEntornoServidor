<?php

namespace App;

session_start();

use App\Controller\AppController;
use App\Controller\UsuarioController;
use App\Controller\NoticiaController;


// Ruta de la carpeta public
$public='/cms/public/';

//Llamo a la cabecera
require("../view/partials/header.php");

//Llamo a los mensajes
require("../view/partials/mensajes.php");

// Ruta de la home
$home='/cms/public/index.php/';

//La guardo a la sesión.
$_SESSION['home'] = $home;


// Defino la funcion que autocargara las clases cuando se instancien
spl_autoload_register('App\autoload');


function autoload($clase, $dir = null)
{

    //Directorio raíz de mi proyecto (ruta absoluta)
    if (is_null($dir)) {
        $dirname = str_replace("/public",'',dirname(__FILE__));
        $dir = realpath($dirname);
    }

    //Escaneo en busca de la clase de forma recursiva
    foreach (scandir($dir) as $file) {
        //Si es un directorio (y no es de sistema), busco la clase dentro de él
        if (is_dir($dir . "/" . $file) AND substr($file, 0, 1) !== '.') {
            autoload($clase, $dir . "/" . $file);
        } //Si es archivo y el nombre coincide con la clase (quitando el namespace)
        else if (is_file($dir . "/" . $file) AND $file == substr(strrchr($clase, "\\"), 1) . ".php") {
            require($dir . "/" . $file);
        }
    }
}

//Compruebo que ruta me estan pidiendo
$ruta=str_replace($home,'',$_SERVER['REQUEST_URI']);

/*

// Array de la ruta.
$array_ruta= explode('/', $ruta);

switch (count($array_ruta)){
    
    case 1: ruta1($array_ruta);
        break;
    case 2: ruta2($array_ruta);
        break;
    case 3: echo 'panel/noticias/crear, panel/usuarios/crear';
        break;
    case 4: echo 'Estoy editando, activando, borrando en el panel';
        break;
    default: echo 'Pagina incorrecta redirijo a la home';
}

//Saco el controlador
function ruta1($array_ruta){
    
    switch ($array_ruta[0]){
        
        case "": return "";
        case "panel": return "UsuarioController";
        case "noticias": return "NoticiaController";
        default: return "Error";
    }
}

//Saco la accion
function ruta2($array_ruta){
    
    $controlador = ruta1($array_ruta);
    
    switch ($controlador){
        
        case "UsuarioController": return $array_ruta[1];
        case "NoticiaController": return $array_ruta[1];    
    }
    
    switch ($array_ruta[1]){
        
        case "": return;
        case "panel": return "UsuarioController";
        case "noticias": return "NoticiaController";
        default: return "Error";
    }
}


*/

// Array de la ruta.
$array_ruta= explode('/', $ruta);

if (count($array_ruta) == 2 AND $array_ruta[0] == "noticiaHome"){    
            //Instancio el controlador
                $controller= new AppController;
            //Inicializo el id para mostrar la noticia que queremos
                $id = $array_ruta[1];
            //Le mando al método salir
                $controller->noticiaHome($id);     
}else if (count($array_ruta) == 4){
    
    if($array_ruta[0].$array_ruta[1] == "panelusuarios"){
        if($array_ruta[2] == "editar" OR
           $array_ruta[2] == "borrar" OR
           $array_ruta[2] == "activar" OR
           $array_ruta[2] == "desactivar"){
                $controller= new UsuarioController;
                $accion = $array_ruta[2];
                $id = $array_ruta[3];
                //Llamo a la accion
                $controller->$accion($id);
           }else{ 
                $controller= new AppController; //Hay que cambiarlo a AppController
                $controller->index();    
           }
       
        
    } elseif ($array_ruta[0].$array_ruta[1] == "panelnoticias") {
        if($array_ruta[2] == "editar" OR
           $array_ruta[2] == "borrar" OR
           $array_ruta[2] == "activar" OR
           $array_ruta[2] == "desactivar"){
                $controller= new NoticiaController;
                $accion = $array_ruta[2];
                $id = $array_ruta[3];
                //Llamo a la accion
                $controller->$accion($id);
           }else{ 
                $controller= new AppController; //Hay que cambiarlo a AppController
                $controller->index();    
           }
    
    }else{
        //Instancio el controlador
           $controller= new AppController; ///Hay que cambiarlo a AppController
        //Le mando el panel de acceso
           $controller->index();
    }
    
     
} else{

    //Enrutaminetos
    switch ($ruta){

        //Panel
        case 'panel':
            //Instancio el controlador
                $controller= new UsuarioController;
            //Le mando el panel de acceso
                $controller->acceso();
                break;

        case 'panel/salir':
            //Instancio el controlador
                $controller= new UsuarioController;
            //Le mando al método salir
                $controller->salir();
                break;

        case 'panel/usuarios':
            //Instancio el controlador
                $controller= new UsuarioController;
            //Le mando al método salir
                $controller->index();
                break;

        case 'panel/usuarios/crear':
            //Instancio el controlador
                $controller= new UsuarioController;
            //Le mando al método salir
                $controller->crear();
                break;

        case 'panel/noticias':
            //Instancio el controlador
                $controller= new NoticiaController;
            //Le mando al método salir
                $controller->index();
                break;
        case 'panel/noticias/crear':
            //Instancio el controlador
                $controller= new NoticiaController;
            //Le mando al método salir
                $controller->crear();
                break;
        case 'noticiasHome':
            //Instancio el controlador
                $controller= new AppController;
            //Le mando al método salir
                $controller->noticiasHome();
                break;
        case 'contacto':
            //Instancio el controlador
                $controller= new AppController;
            //Le mando al método salir
                $controller->contacto();
                break;
        default : //Instancio el controlador
            $controller= new AppController;
            //Le mando al método salir
            $controller->index();
    }
}


//Llamo a la cabecera
require("../view/partials/footerPanel.php");

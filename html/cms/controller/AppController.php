<?php

//App sería el nombre del proyecto y Controller la carpeta que lo tiene
namespace App\Controller;

use App\Model\Noticia;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;

class AppController {

    var $db;
    var $view;

    function __construct() {

        //Inicializo la conexion

        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;

        //Instancio el view helper
        
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }
 
    public function index() {

        //Select con OBJ
        $resultado = $this->db->query("SELECT * FROM noticias WHERE home='1' AND activo='1' LIMIT 5");

        // Inicializamos $noticias a 0 para que no de error si no hay noticias en la home.
        $noticias=[];
        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {
            
            //Paso esa variable al constructor de usuario
            $noticias [] = new Noticia ($data);
        }
        
        // Le paso el view
        $this->view->vista('home', $noticias);
    }
    
    public function noticiasHome() {

        //Select con OBJ
        $resultado = $this->db->query(" SELECT * FROM noticias WHERE activo='1' ");

        $noticias=[];
        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {

            //Paso esa variable al constructor de usuario
            $noticias [] = new Noticia ($data);
        }
        // Le paso el view
        $this->view->vista('noticiasHome', $noticias);
    }
    
    public function noticiaHome($slug) {

        //Select con OBJ
        $resultado = $this->db->query("SELECT * FROM noticias WHERE slug='" . $slug . "' LIMIT 1");

        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {

            //Paso esa variable al constructor de usuario
            $noticias [] = new Noticia ($data);
        }
        // Le paso el view
        $this->view->vista('noticiaHome', $noticias);
    }

    public function contacto() {

        //Select con OBJ
        $resultado = $this->db->query('SELECT * FROM noticias');

        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {

            //Paso esa variable al constructor de usuario
            $noticias [] = new Noticia ($data);
        }
        // Le paso el view
        $this->view->vista('contacto', $noticias);
    }

}


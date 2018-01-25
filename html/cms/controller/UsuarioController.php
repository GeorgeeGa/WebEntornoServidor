<?php
namespace App\Controller; //App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Usuario;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;

class UsuarioController
{
    
    var $db;
    
    function __construct() {
        
        //Inicializo la conexion
        
        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;
        
    }


    public function index()
    {
        
        //Select con OBJ
        $resultado = $this->db->query('SELECT * FROM usuarios WHERE id=1');
        
        //Asigno la consulta a una variable
        $data = $resultado->fetch(\PDO::FETCH_OBJ);
        
        //Paso esa variable al constructor de usuario
        $usuario = new Usuario($data);

        //Instancio el ViewHelper

        $view = new ViewHelper();

        $view->vista("index",$usuario);
    }


}

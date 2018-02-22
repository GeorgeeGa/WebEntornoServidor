<?php
namespace App\Model;  //App sería el nombre del proyecto y Model la carpeta que lo tiene

class Noticia
{
    // Variables o atributos
    var $id;
    var $slug;
    var $titulo;
    var $entradilla;
    var $texto;
    var $fecha_alta;
    var $fecha_mod;
    var $fecha_pub;
    var $activo;
    var $autor;
    var $borrado;
    var $home;

    //Metodo constructor nuevo
    function __construct($data)
    {
        $this->id = $data->id;
        $this->slug = $data->slug;
        $this->titulo = $data->titulo;
        $this->entradilla = $data->entradilla;
        $this->texto = $data->texto;
        $this->fecha_alta = $data->fecha_alta;
        $this->fecha_mod = $data->fecha_mod;
        $this->fecha_pub = $data->fecha_pub;
        $this->activo = $data->activo;
        $this->autor = $data->autor;
        $this->borrado = $data->borrado;
        $this->home = $data ->home; 
    }


}
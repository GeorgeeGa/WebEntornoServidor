<?php

//App sería el nombre del proyecto y Controller la carpeta que lo tiene
namespace App\Controller;

use App\Model\Noticia;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;

class NoticiaController {

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
        $resultado = $this->db->query('SELECT * FROM noticias');

        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {

            //Paso esa variable al constructor de usuario
            $noticias [] = new Noticia ($data);
        }
        // Le paso el view
        $this->view->vista('noticias', $noticias);
    }

    public function crear() {

        //Create elemento
        $titulo = "Nueva noticia" . rand(1, 1000);
        $registros = $this->db->exec('INSERT INTO noticias (titulo) VALUES ("' . $titulo . '")');
        if ($registros) {
            $mensaje [] = ['tipo' => 'success',
                'texto' => "La noticia: $titulo se ha añadido correctamente."
            ];
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al añadir la noticia."
            ];
        }
        // Añadir el mensaje a la sesion
        $_SESSION['mensajes'] = $mensaje;

        // Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");
    }

    function activar($id) {

        if ($id) {
            $registros = $this->db->exec("UPDATE noticias SET activo=1 WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
                $mensaje [] = ['tipo' => 'success',
                    'texto' => "La noticia se ha activado correctamente."
                ];
            } else {
                $mensaje [] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al activar la noticia."
                ];
            }
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al activar la noticia."
            ];
        }
        // Añadir el mensaje a la sesion
        $_SESSION['mensajes'] = $mensaje;

        // Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");
    }

    function desactivar($id) {

        if ($id) {
            $registros = $this->db->exec("UPDATE noticias SET activo=0 WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
                $mensaje [] = ['tipo' => 'success',
                    'texto' => "La noticia se ha desactivado correctamente."
                ];
            } else {
                $mensaje [] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al desactivar la noticia."
                ];
            }
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al desactivar la noticia."
            ];
        }
        // Añadir el mensaje a la sesion
        $_SESSION['mensajes'] = $mensaje;

        // Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");
    }

    function borrar($id) {

        if ($id) {
            $registros = $this->db->exec("DELETE from noticias WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
                $mensaje [] = ['tipo' => 'success',
                    'texto' => "La noticia se ha borrado correctamente."
                ];
            } else {
                $mensaje [] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al borrar la noticia."
                ];
            }
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al borrar la noticia."
            ];
        }
        // Añadir el mensaje a la sesion
        $_SESSION['mensajes'] = $mensaje;

        // Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");
    }

    
    //Falta cambiar datos a Noticia
    
    function editar($id) {

        if ($id) {
            
            if (isset($_POST['guardar']) AND $_POST['guardar'] == "Guardar") {

                $tabla = array(
                    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
                    'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                    'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
                    'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'S',
                    'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
                    'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
                    'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
                    'ÿ'=>'y', 'R'=>'R', 'r'=>'r', ','=>''
                );
                
                $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
                $autor = filter_input(INPUT_POST, 'autor', FILTER_SANITIZE_STRING);
                
                # Ponemos el titulo en minuscula
                $str = strtolower($titulo);
                # Reemplazamos lo antes establecido
                $str = strtr($str, $tabla);

                # Removemos caracteres especiales que no hayan sido sustituidos anteriormente
                $str = preg_replace('/[^a-zA-Z0-9]/i',' ', $str);

                # Removemos si existen espacios en blanco en los extremos 
                $str = trim($str);

                # Rellenamos espacios con guiones
                $str = preg_replace('/\s+/', ' ', $str);
                $slug = preg_replace('/\s+/', '-', $str);
                
                # Le añadimos la marca de tiempo
                $slug = $slug.date("i-s");
                
                //var_dump($slug);
                $entradilla = filter_input(INPUT_POST, 'entradilla', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $borrado = (filter_input(INPUT_POST, 'borrado', FILTER_SANITIZE_STRING)== 'on') ? 1 : 0;
                $home = (filter_input(INPUT_POST, 'home', FILTER_SANITIZE_STRING)== 'on') ? 1 : 0;
                
                //Guardo en la base de datos.
                $this->db->beginTransaction();
                $this->db->exec('UPDATE noticias SET titulo="'.$titulo.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticias SET autor="'.$autor.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticias SET slug="'.$slug.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticias SET entradilla="'.$entradilla.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticias SET texto="'.$texto.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticias SET borrado="'.$borrado.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE noticias SET home="'.$home.'" WHERE id='.$id.'');
                $this->db->commit();
                
                $mensaje [] = ['tipo' => 'success',
                    'texto' => "La Noticia $titulo se ha editado correctamente."
                        ];
                // Añadir el mensaje a la sesion    
                $_SESSION['mensajes'] = $mensaje;

                // Le redirijo al panel
                header("Location: " . $_SESSION['home'] . "panel/noticias");
                
            } else {
                $resultado = $this->db->query("SELECT * FROM noticias WHERE id=" . $id . " LIMIT 1");
                //Mensajes
                if ($resultado) {
                    //Asigno la consulta a una variable
                    $noticia = $resultado->fetch(\PDO::FETCH_OBJ);
                    //Le paso los datos de la vista.
                    $this->view->vista('noticia', $noticia);
                } else {
                    $mensaje [] = ['tipo' => 'danger',
                        'texto' => "Ha ocurrido un error al encontrar la noticia."
                    ];
                    // Añadir el mensaje a la sesion
                    $_SESSION['mensajes'] = $mensaje;

                    // Le redirijo al panel
                    header("Location: " . $_SESSION['home'] . "panel/noticias");
                }
            }
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al encontrar la noticia."
            ];
            // Añadir el mensaje a la sesion
            $_SESSION['mensajes'] = $mensaje;

            // Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel/noticias");
        }
    }

}

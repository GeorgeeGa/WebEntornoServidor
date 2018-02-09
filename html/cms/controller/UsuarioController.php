<?php

namespace App\Controller; //App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Usuario;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;

class UsuarioController {

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

    public function acceso() {
        //Inicializo mensaje.
        $datos = new \stdClass();

        //Compruebo que esta logueado
        if (isset($_SESSION['usuario']) AND $_SESSION['usuario']) {
            $datos->usuario = $_SESSION ['usuario'];
            $vista = "panel";
        } else {
            $vista = "acceso";
        }

        $datos->mensaje = "Welcome.";
        //Compruebo si ha rrellenado el formulario
        if (isset($_POST['acceder'])) {
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $clave = filter_input(INPUT_POST, 'clave', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // Filtrar 8 caracteres.
            if ($usuario AND $clave) {
                //Compruebo que existe el usuario.
                if ($this->comprueba_usuario($usuario, $clave)) {
                    //Entro al panel.
                    $datos->usuario = $_SESSION ['usuario'];
                    $vista = "panel";
                    //$datos->mensaje = "Welcome $usuario.";
                } else {
                    $datos->mensaje = "<span class='rojo'>Usuario o clave incorrectos.</span>";
                }
            }
        }
        //Le paso los datos de la vista.
        $this->view->vista($vista, $datos);
    }

    function comprueba_usuario($usuario, $clave) {

        //Select con OBJ
        $resultado = $this->db->query("SELECT * FROM usuarios WHERE usuario='" . $usuario . "'");

        //Asigno la consulta a una variable
        $data = $resultado->fetch(\PDO::FETCH_OBJ);
        //Compruebo contraseña

        if ($data AND hash_equals($data->clave, crypt($clave, $data->clave))) {
            // Añado el nombre de usuario a la sesión.
            $_SESSION['usuario'] = $data->usuario;
            return 1;
        } else {
            return 0;
        }

        // Ternaria.
        return ($data) ? 1 : 0;
    }

    public function index() {

        //Select con OBJ
        $resultado = $this->db->query('SELECT * FROM usuarios');

        //Asigno la consulta a una variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {

            //Paso esa variable al constructor de usuario
            $usuarios [] = new Usuario($data);
        }
        // Le paso el view
        $this->view->vista('usuarios', $usuarios);
    }

    public function salir() {

        //Borro el nombre de usuario a la sesión.
        $_SESSION['usuario'] = "";

        // Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel");
        $this->acceso();
    }

    public function crear() {

        //Create elemento
        $nombre = "Nuevo Usuario" . rand(1, 1000);
        $registros = $this->db->exec('INSERT INTO usuarios (usuario) VALUES ("' . $nombre . '")');
        if ($registros) {
            $mensaje [] = ['tipo' => 'success',
                'texto' => "El usuario: $nombre se ha añadido correctamente."
            ];
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al añadir el usuario."
            ];
        }
        // Añadir el mensaje a la sesion
        $_SESSION['mensajes'] = $mensaje;

        // Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");
    }

    function activar($id) {

        if ($id) {
            $registros = $this->db->exec("UPDATE usuarios SET activo=1 WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
                $mensaje [] = ['tipo' => 'success',
                    'texto' => "El usuario se ha activado correctamente."
                ];
            } else {
                $mensaje [] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al activar el usuario."
                ];
            }
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al activar el usuario."
            ];
        }
        // Añadir el mensaje a la sesion
        $_SESSION['mensajes'] = $mensaje;

        // Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");
    }

    function desactivar($id) {

        if ($id) {
            $registros = $this->db->exec("UPDATE usuarios SET activo=0 WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
                $mensaje [] = ['tipo' => 'success',
                    'texto' => "El usuario se ha desactivado correctamente."
                ];
            } else {
                $mensaje [] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al desactivar el usuario."
                ];
            }
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al desactivar el usuario."
            ];
        }
        // Añadir el mensaje a la sesion
        $_SESSION['mensajes'] = $mensaje;

        // Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");
    }

    function borrar($id) {

        if ($id) {
            $registros = $this->db->exec("DELETE from usuarios WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
                $mensaje [] = ['tipo' => 'success',
                    'texto' => "El usuario se ha borrado correctamente."
                ];
            } else {
                $mensaje [] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al borrar el usuario."
                ];
            }
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al borrar el usuario."
            ];
        }
        // Añadir el mensaje a la sesion
        $_SESSION['mensajes'] = $mensaje;

        // Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");
    }

    function editar($id) {

        if ($id) {
            if (isset($_POST['guardar']) AND $_POST['guardar'] == "Guardar") {

                $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $usuarios = (filter_input(INPUT_POST, 'usuarios', FILTER_SANITIZE_STRING)== 'on') ? 1 : 0;
                $noticias = (filter_input(INPUT_POST, 'noticias', FILTER_SANITIZE_STRING)== 'on') ? 1 : 0;
                
                //Guardo en la base de datos.
                $this->db->beginTransaction();
                $this->db->exec('UPDATE usuarios SET usuario="'.$usuario.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE usuarios SET usuarios="'.$usuarios.'" WHERE id='.$id.'');
                $this->db->exec('UPDATE usuarios SET noticias="'.$noticias.'" WHERE id='.$id.'');
                $this->db->commit();
                
                $mensaje [] = ['tipo' => 'success',
                    'texto' => "El usuario $usuario se ha editado correctamente."
                        ];
                // Añadir el mensaje a la sesion    
                $_SESSION['mensajes'] = $mensaje;

                // Le redirijo al panel
                header("Location: " . $_SESSION['home'] . "panel/usuarios");
                
            } else {
                $resultado = $this->db->query("SELECT * FROM usuarios WHERE id=" . $id . " LIMIT 1");
                //Mensajes
                if ($resultado) {
                    //Asigno la consulta a una variable
                    $usuario = $resultado->fetch(\PDO::FETCH_OBJ);
                    //Le paso los datos de la vista.
                    $this->view->vista('usuario', $usuario);
                } else {
                    $mensaje [] = ['tipo' => 'danger',
                        'texto' => "Ha ocurrido un error al encontrar el usuario."
                    ];
                    // Añadir el mensaje a la sesion
                    $_SESSION['mensajes'] = $mensaje;

                    // Le redirijo al panel
                    header("Location: " . $_SESSION['home'] . "panel/usuarios");
                }
            }
        } else {
            $mensaje [] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al encontrar el usuario."
            ];
            // Añadir el mensaje a la sesion
            $_SESSION['mensajes'] = $mensaje;

            // Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel/usuarios");
        }
    }

}

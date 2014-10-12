<?php

class SesionSingleton {

    private static $instancia;

    private function __construct($nombre="") {
        if ($nombre !== "") {
            session_name($nombre);
        }
        session_start();
    }

    public static function getSesion($nombre="") {
        if (is_null(self::$instancia)) {
            self::$instancia = new self($nombre);
        }
        return self::$instancia;
    }

    function cerrar() {
        session_unset();
        session_destroy();
    }
   
    function set($variable, $valor) {
        $_SESSION[$variable] = $valor;
    }
   
    function delete($variable=""){
        if($variable===""){
            unset($_SESSION);
        } else {
            unset($_SESSION[$variable]);
        }
    }

    function get($variable) {
        if (isset($_SESSION[$variable]))
            return $_SESSION[$variable];
        return null;
    }
   
    function getNombres(){
        $array = array();
        foreach ($_SESSION as $key => $value) {
            $array[] = $key;
        }
        return $array;
    }

    function isSesion(){
        return count($_SESSION)>0;
    }

    function isAutentificado(){
        return isset($_SESSION["__usuario"]);
    }

    function setUsuario($usuario){
        if($usuario instanceof Usuario){
            $this->set("__usuario",$usuario);
        }
    }
   
    function getUsuario(){
        if($this->get("__usuario")!=null)
            return $this->get("__usuario");
        return null;
    }
   
    private function redirigir($destino="index.php"){
        header("Location:".$destino);
        exit;
    }
}
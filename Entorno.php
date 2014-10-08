<?php

/**
 * Class Entorno
 *
 * @version 0.9
 * @author izv
 * @license http://...
 * @copyright izv by cv
 * 
 * 
 * Esta clase dispone de metodos estaticos que se utilizan para la lectura de 
 * parametros del Servidor
 */
class Entorno {

    private function __construct() {
        
    }

    static function getServidor() {
        return $_SERVER["SERVER_NAME"];
    }

    static function getPuerto() {
        return $_SERVER["SERVER_PORT"];
    }

    static function getRaiz() {
        return $_SERVER["DOCUMENT_ROOT"];
    }

    static function getMetodo() {
        return $_SERVER["REQUEST_METHOD"];
    }

    static function getParametros() {
        return $_SERVER["QUERY_STRING"];
    }

    /**
     * Devuelve la ruta completa del archivo
     * @access public
     * @return string Devuelve una cadena con la ruta completa del archivo
     */
    static function getScript() {
        return $_SERVER["SCRIPT_NAME"];
    }

    static function getPagina() {
        $script = self::getScript();
        $pos = strrpos($script, "/");
        return substr($script, $pos + 1);
    }

    static function getCarpetaServidor() {
        $script = self::getScript();
        $pos = strrpos($script, "/");
        return substr($script, 0, $pos + 1);
    }

    static function getPadreRaiz() {
        $script = self::getRaiz();
        $pos = strrpos($script, "/");
        return substr($script, 0, $pos + 1);
    }

    static function getArrayParametros() {
        $array = array();
        $parametros = self::getParametros();
        $partes = explode("&", $parametros);
        foreach ($partes as $indice => $valor) {
            $partesSub = explode("=", $valor);
            if (!isset($partesSub[1])) {
                $partesSub[1] = "";
            }
            if (isset($array[$partesSub[0]])) {
                if (is_array($array[$partesSub[0]])) {
                    $array[$partesSub[0]][] = $partesSub[1];
                } else {
                    $subArray = array();
                    $subArray[] = $array[$partesSub[0]];
                    $subArray[] = $partesSub[1];
                    $array[$partesSub[0]] = $subArray;
                }
            } else {
                $array[$partesSub[0]] = $partesSub[1];
            }
        }
        return $array;
    }

}

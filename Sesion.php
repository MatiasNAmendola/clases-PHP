<?php

class Sesion {

    /**
     * contructor ->nombre
     * metodos:
     *      set (nombre, valor)
     *      add(nombre, valor)
     *      get(nombre)
     *      getNombre()  -->  devuelve un array con los nombre de sesion, despues con el get(nombre) podremos sacar su valor
     *      delete(nombre)
     *      delete()  --> te borra todas las variables de sesion
     *      isSesion() --> saber si se ha iniciado la sesion
     *      isAutentificado()
     *      getUsuario()
     *      setUsuario
     *      
     * ---------------por implementar
     * isAdministrador()
     * isAvanzado()
     * isUsuario
     * getRol()
     */
    private $nombre = array(), $valor = array();

    function __construct($nombre = "") {
        if ($nombre != "")
            $this->nombre[] = $nombre;


        session_start();
    }

    public function set($nombre, $valor) {
        if (!is_array($nombre) && !is_array($valor)) {
            if (isset($_SESSION[$nombre])) {
                $_SESSION[$nombre] = $valor;
            } else {
                for ($i = 0; $i < count($this->nombre); $i++) {
                    if (isset($_SESSION[$this->nombre[i]])) {
                        $this->valor[i] = $valor;
                        $existe = true;
                        return $existe;
                    } else
                        $existe = false;
                }
                if (isset($exite)) {
                    if (!$existe) {
                        $this->nombre[] = $nombre;
                        $this->valor[] = $valor;
                    }
                } else {
                    $_SESSION[$nombre] = $valor;
                }
            }
        }
    }

    public function get($nombre) {
        if (isset($_SESSION[$nombre]))
            return $_SESSION[$nombre];
        else
            return NULL;
    }

    public function getNombre() {
        $array = array();
        foreach ($_SESSION as $nombre => $valor) {
            $array[] = $nombre;
        }
        return $array;
    }

    public function delete($nombre = "") {
        if ($nombre == "")
            unset($_SESSION);
        else {
            if (isset($_SESSION[$nombre]))
                unset($_SESSION[$nombre]);
        }
    }

    public function deleteAll() {
        foreach ($_SESSION as $nombre => $valor) {
            $_SESSION[$nombre] = "";
        }

        //unset($_SESSION);
        //session_destroy();
    }

    public function destroy() {
        session_destroy();
    }

    public function isSesion() {
        if (count($_SESSION) > 0)
            return true;

        return false;
    }

    public function isAutentificado() {
        return isset($_SESSION["usuario"]);
    }

    public function getUsuario() {
        return $_SESSION["usuario"];
    }

    public function setUsuario($valor) {
        $_SESSION["usuario"] = $valor;
    }

}
?>



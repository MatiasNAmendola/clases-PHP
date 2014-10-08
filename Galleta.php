<?php

/*CLASE PARA COOKIES
 */
class Galleta {
    
    
    public static function add($nombre, $valor, $tiempo=3600){
        setcookie($nombre, $valor, $tiempo);
    }
    
    public static function get($nombre){
        if(isset($_COOKIE[$nombre]))
            return $_COOKIE[$nombre];
        else
            return "";
    }
    
    public static function delete($nombre){
        setcookie($nombre, "", time()-3600);
    }
    
    
    
    
    
    
    
}

?>

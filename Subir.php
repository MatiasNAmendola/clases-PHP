<?php


class Subir {
    /**
     * Clase que nos permita usar las subidas de archivos de forma mas sencilla
     * 
     * Metodos:
     * __construct(nombre,)
     * setDestino(...)   string ruta relativa
     * setNombre()  string  parte del nombre
     * setAccion() Sobreescribir, Reemplazar, Ignorar
     * setMaximo()  entero positivo
     * addExtension() string,array
     * addTipo()  image/__    text/__
     * getError()
     * getMensajeError()
     * subir()
     * 
     * 
     * Extensiones y Tipos --> si hay los 2 se tienen q cumplir los 2 (&&), si no que se cumpla la q este.
     */
    
    private $destino="./";
    private $nombre="";
   
      const REEMPLAZAR=0,      //si existe lo reemplaza
          RENOMBRAR=1,          //si existe lo renombra
          IGNORAR=2;            //exista o no lo sube tal cual se lo damos
      
    private $accion=self::IGNORAR;
    private $maximo;
    private $extension;
    private $tipo;
    private $error;
    private $mensaje_error;
         
    function __construct($name) {
        $n= pathinfo($_FILES[$name]["name"]);
        $this->destino = $n["dirname"];
        $this->nombre = $n["filename"];
        $this->extension = $n["extension"];
        $this->accion=self::IGNORAR;
    }
    
       function __construct2($destino, $nombre, $extension) {
        $this->destino = $destino;
        $this->nombre = $nombre;
        $this->accion = self::REEMPLAZAR;
        $this->maximo = 10240;
        $this->extension = $extension;
        $this->tipo = "";
        $this->error = 0;
        $this->mensaje_error = "";
        
    }
    
    function __construct3() {
        $this->destino = "./";
        $this->nombre = "SinTitulo";
        $this->accion = self::IGNORAR;
        $this->maximo = 10240;
        $this->extension = ".txt";
        $this->tipo = "text/plain";
        $this->error = UPLOAD_ERR_OK;
        $this->mensaje_error = "";
        
    }
    
    public function getDestino() {
        return $this->destino;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getAccion() {
        return $this->accion;
    }

    public function getMaximo() {
        return $this->maximo;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getError() {
        return $this->error;
    }

    public function getMensaje_error() {
        return $this->mensaje_error;
    }

    
//SETTER
    public function setDestino($destino) {
       if(file_exists($destino))
             $this->destino = $destino;
       else
           $this->error = UPLOAD_ERR_CANT_WRITE;
    }

    public function setNombre($nombre) {
        if($nombre!="")
           $this->nombre = $nombre;
    }

    public function setAccion($accion) {
        if($accion==  self::REEMPLAZAR || $accion==self::RENOMBRAR || $accion==self::IGNORAR)
            $this->accion = $accion;
        else
           $this->accion = self::IGNORAR;
    }

    public function setMaximo($maximo) {
        if($maximo >= 0)
            $this->maximo = $maximo;
    }

    public function setExtension($extension) {
       if($extension[0]==".") 
        $this->extension = $extension;
       else
        $this->extension = ".".$extension;   
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setError($error) {
        $this->error = $error;
    }

    public function setMensaje_error($mensaje_error) {
        switch($mensaje_error){
            case UPLOAD_ERR_OK:
                $this->mensaje_error = "Archivo Subido Correctamente";
                break;
            case UPLOAD_ERR_INI_SIZE:
                $this->mensaje_error = "Error de tamaño ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $this->mensaje_error = "Error de tamaño del formulario";
                break;
            case UPLOAD_ERR_PARTIAL:
                $this->mensaje_error = "Error Parcial";
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->mensaje_error = "Error. No hay archivo";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $this->mensaje_error = "Error en arvhivo temporal";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $this->mensaje_error = "Error escritura";
                break;
            case UPLOAD_ERR_EXTENSION:
                $this->mensaje_error = "Error de extension";
                break;
            default:
        }
        
    }



    public function subir($file) {

//compruebo todos para saber si uso el original o el nuevo dado  
$n=  pathinfo($_FILES[$file]["name"]);
   //nombre
    if($this->nombre=="")
       $this->nombre =$n["filename"];
   //destino 
    if($this->destino=="")
       $this->destino = $n["dirname"];
    //accion comprobado en el set, si no es ignorar
    //maximo
    if($this->maximo!=0)
        
    
    
    if(!file_exists($_FILES[$file][$name]))
        ;
        else{
          if($accion==self::RENOMBRAR){  
              $existe=true;
              $i=1;
              while(!$existe){
                if(file_exists($destino."/".$nombre."_".$i))
                    $i++;
                else
                    $existe=false;
            }
          }
       }
       
       if(move_uploaded_file($_FILES[$file]["tmp_name"], $this->getDestino()."/".$this->getNombre().".".$this->getExtension()))
               return true;
       else
            return false;
    } 
}

?>

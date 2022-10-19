<?php
    // Clase producto
    class Producto{
        // ATRIBUTOS
        private $codigo;
        private $nombre;
        private $precio;
        private $cantidad;
        private $sucursal;

        // CONSTRUCTOR
        public function __construct($_codigo,$_nombre,$_precio,$_cantidad,$_sucursal){
            $this->codigo = $_codigo;
            $this->nombre = $_nombre;
            $this->precio = $_precio;
            $this->cantidad = $_cantidad;
            $this->sucursal = $_sucursal;
        }

        //____________________METODO SET____________________
        
        public function setCodigo($_codigo){
            $this->codigo = $_codigo;
        }
        
        public function setNombre($_nombre){
            $this->nombre = $_nombre;
        }

        public function setPrecio($_precio){
            $this->precio = $_precio;
        }

        public function setCantidad($_cantidad){
            $this->cantidad = $_cantidad;
        }

        public function setSucursal($_sucursal){
            $this->sucursal = $_sucursal;
        }

        //____________________METODO GET____________________

        public function getCodigo(){
            return $this->codigo;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getPrecio(){
            return $this->precio;
        }

        public function getCantidad(){
            return $this->cantidad;
        }

        public function getSucursal(){
            return $this->sucursal;
        }
    }
?>
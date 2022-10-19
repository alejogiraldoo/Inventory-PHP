<?php
    // Clase Trabajador
    class Trabajador{
        // ATRIBUTOS
        private $id;
        private $nombre;
        private $usuario;
        private $contrasena;
        private $rol;

        // CONSTRUCTOR
        public function __construct($_id,$_nombre,$_usuario,$_contrasena,$_rol){
            $this->id = $_id;
            $this->nombre = $_nombre;
            $this->usuario = $_usuario;
            $this->contrasena = $_contrasena;
            $this->rol = $_rol;
        }

        //____________________METODO SET____________________

        public function setId($_id){
            $this->id = $_id;
        }

        public function setNombre($_nombre){
            $this->nombre = $_nombre;
        }

        public function setUsuario($_usuario){
            $this->usuario = $_usuario;
        }

        public function setContrasena($_contrasena){
            $this->contrasena = $_contrasena;
        }

        public function setRol($_rol){
            $this->rol = $_rol;
        }

        //____________________METODO GET____________________

        public function getId(){
           return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function getContrasena(){
            return $this->contrasena;
        }

        public function getRol(){
            return $this->rol;
        }
    }
?>
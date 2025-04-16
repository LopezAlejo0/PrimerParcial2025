<?php
    class Persona {
        private $nombre;
        private $apellido;
        private $direccion;
        private $mail;
        private $telefono;

        // Constructor
        public function __construct ($nombre, $apellido, $direccion, $mail, $telefono) {
            $this -> nombre = $nombre;
            $this -> apellido = $apellido;
            $this -> direccion = $direccion;
            $this -> mail = $mail;
            $this -> telefono = $telefono;
        }

        // Getters
        public function getNombre () {
            return $this -> nombre;
        }

        public function getApellido () {
            return $this -> apellido;
        }

        public function getDireccion () {
            return $this -> direccion;
        }

        public function getMail () {
            return $this -> mail;
        }

        public function getTelefono () {
            return $this -> telefono;
        }

        // Setters
        public function setNombre ($unNombre) {
            $this -> nombre = $unNombre;
        }

        public function setApellido ($unApellido) {
            $this -> apellido = $unApellido;
        }

        public function setDireccion ($unaDireccion) {
            $this -> direccion = $unaDireccion;
        }

        public function setMail ($unMail) {
            $this -> mail = $unMail;
        }

        public function setTelefono ($unTelefono) {
            $this -> telefono = $unTelefono;
        }

        // A String
        public function __toString () {
            return "Nombre: " . $this -> getNombre () . 
                   "\nApellido: " . $this -> getApellido () . 
                   "\nDirección: " . $this -> getDireccion () . 
                   "\nMail: " . $this -> getMail () . 
                   "\nTeléfono: " . $this -> getTelefono ();
        }
    }
?>
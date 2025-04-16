<?php
    class Vuelo {
        private $nro;
        private $importe;
        private $fecha;
        private $destino;
        private $horaArribo;
        private $horaPartida;
        private $cantAsientos;
        private $asientosDisponibles;
        private $objPersona;

        // Constructor
        public function __construct ($nro, $importe, $fecha, $destino, $horaArribo, $horaPartida, $cantAsientos, $asientosDisponibles, $objPersona) {
            $this -> nro = $nro;
            $this -> importe = $importe;
            $this -> fecha = $fecha;
            $this -> destino = $destino;
            $this -> horaArribo = $horaArribo;
            $this -> horaPartida = $horaPartida;
            $this -> cantAsientos = $cantAsientos;
            $this -> asientosDisponibles = $asientosDisponibles;
            $this -> objPersona = $objPersona;
        }

        // Getters
        public function getNro () {
            return $this -> nro;
        }

        public function getImporte () {
            return $this -> importe;
        }

        public function getFecha () {
            return $this -> fecha;
        }

        public function getDestino () {
            return $this -> destino;
        }

        public function getHoraArribo () {
            return $this -> horaArribo;
        }

        public function getHoraPartida () {
            return $this -> horaPartida;
        }

        public function getCantAsientos () {
            return $this -> cantAsientos;
        }

        public function getAsientosDisponibles () {
            return $this -> asientosDisponibles;
        }

        public function getObjPersona () {
            return $this -> objPersona;
        }

        // Setters
        public function setNro ($unNro) {
            $this -> nro = $unNro;
        }

        public function setImporte ($unImporte) {
            $this -> importe = $unImporte;
        }

        public function setFecha ($unaFecha) {
            $this -> fecha = $unaFecha;
        }

        public function setDestino ($unDestino) {
            $this -> destino = $unDestino;
        }

        public function setHoraArribo ($unaHora) {
            $this -> horaArribo = $unaHora;
        }

        public function setHoraPartida ($unaHora) {
            $this -> horaPartida = $unaHora;
        }

        public function setCantAsientos ($asientos) {
            $this -> cantAsientos = $asientos;
        }

        public function setAsientosDisponibles ($asientos) {
            $this -> asientosDisponibles = $asientos;
        }

        public function setObjPersona ($unaPersona) {
            $this -> objPersona = $unaPersona;
        }

        // A String
        public function __toString () {
            return "Número de vuelo: " . $this -> getNro () . 
                   "\nImporte: $" . $this -> getImporte () . 
                   "\nFecha: " . $this -> getFecha () . 
                   "\nDestino " . $this -> getDestino () . 
                   "\nHora de arribo: " . $this -> getHoraArribo () . 
                   " hs\nHora de partida: " . $this -> getHoraPartida () . 
                   " hs\nCantidad de asientos: " . $this -> getCantAsientos () . 
                   "\nCantidad de asientos disponibles: " . $this -> getAsientosDisponibles ();
                   "\nDatos del responsable del vuelo:\n" . $this -> getObjPersona ();
        }

        // Propias de la clase

        /**
         * Recibe la cantidad de asientos que se quieren ocupar. Retorna true o false, dependiendo de si es posible asignar los asientos
         * @param int $cantPasajeros
         * @return boolean
         */
        public function asignarAsientosDisponibles ($cantPasajeros) {
            $asignacion = false;
            $cantDisponible = $this -> getAsientosDisponibles ();
            if ($cantPasajeros <= $cantDisponible) {
                $asignacion = true;
                $this -> setAsientosDisponibles ($cantDisponible - $cantPasajeros);
            }
            return $asignacion;
        }
    }
?>
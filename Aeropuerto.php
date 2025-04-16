<?php
    class Aeropuerto {
        private $denominacion;
        private $direccion;
        private $coleccionAerolineas;

        // Constructor
        public function __construct ($denominacion, $direccion, $coleccionAerolineas) {
            $this -> denominacion = $denominacion;
            $this -> direccion = $direccion;
            $this -> coleccionAerolineas = $coleccionAerolineas;
        }

        // Getters
        public function getDenominacion () {
            return $this -> denominacion;
        }

        public function getDireccion () {
            return $this -> direccion;
        }

        public function getColeccionAerolineas () {
            return $this -> coleccionAerolineas;
        }

        // Setters
        public function setDenominacion ($unaDenominacion) {
            $this -> denominacion = $unaDenominacion;
        }

        public function setDireccion ($unaDireccion) {
            $this -> direccion = $unaDireccion;
        }

        public function setColeccionAerolineas ($unaColeccion) {
            $this -> coleccionAerolineas = $unaColeccion;
        }

        // A String
        public function __toString () {
            $mensaje = "Lista de aerolíneas\n";
            $mensaje .= "------------\n";
            $i = 1;
            foreach ($this -> getColeccionAerolineas () as $aerolinea) {
                $mensaje .= "- " . $i . " " . $aerolinea . "\n";
                $i ++;
            }
            return "Denominación: " . $this -> getDenominacion () . 
                   "\nDirección: " . $this -> getDireccion () . 
                   "\n" . $mensaje;
        }

        // Propias de la clase

        /**
         * Recibe una aerolínea y retorna la colección de vuelos asociados a dicha aerolínea
         * @param Aerolinea
         * @return array|null
         */
        public function retornarVuelosAerolinea ($unaAerolinea) {
            return $unaAerolinea ->  getColeccionVuelos ();
        }

        /**
         * Permite vender un vuelo automaticamente dada una fecha, un destino y una cantidad de asientos
         * @param int $cantAsientos
         * @param String $fecha
         * @param String $destino
         * @return boolean
         */
        public function ventaAutomatica ($cantAsientos, $fecha, $destino) {
            $colAerolineas = $this -> getColeccionAerolineas ();
            $i = 0;
            $vendido = false;
            do {
                $aerolinea = $colAerolineas [$i];
                $colVuelos = $aerolinea -> getColeccionVuelos ();
                $j = 0;
                $i ++;
                do {
                    $vuelo = $colVuelos [$j];
                    if ($aerolinea -> incorporarVuelo ($vuelo)) {
                        $vueloVendido = $aerolinea -> venderVueloADestino ($cantAsientos, $fecha, $destino);
                        if ($vueloVendido != null) {
                            $vendido = true;
                        }
                    }
                    $j ++;
                } while (!$vendido);
            } while (!$vendido);
            return $vendido;
        }

        /**
         * Recibe el id de una aerolínea para retornar su promedio recaudado en el aeropuerto
         * @param String $idAerolinea
         * @return float
         */
        public function promedioRecaudadoXAerolinea ($idAerolinea) {
            $colAerolineas = $this -> getColeccionAerolineas ();
            $i = 0;
            $promedio = -1;
            $cantAerolineas = count ($colAerolineas);
            do {
                $aerolinea = $colAerolineas [$i];
                $identificacionAerolinea = $aerolinea -> getIdentificacion ();
                if ($identificacionAerolinea == $idAerolinea) {
                    $promedio = $aerolinea -> montoPromedioRecaudado ();
                }
                $i ++;
            } while ($i < $cantAerolineas && $promedio == -1);
            return $promedio;
        }
    }
?>
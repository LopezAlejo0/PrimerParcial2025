<?php
    class Aerolinea {
        private $identificacion;
        private $nombre;
        private $coleccionVuelos;

        // Constructor
        public function __construct ($identificacion, $nombre) {
            $this -> identificacion = $identificacion;
            $this -> nombre = $nombre;
            $this -> coleccionVuelos = [];
        }

        // Getters
        public function getIdentificacion () {
            return $this -> identificacion;
        }

        public function getNombre () {
            return $this -> nombre;
        }

        public function getColeccionVuelos () {
            return $this -> coleccionVuelos;
        }

        // Setters
        public function setIdentificacion ($unaIdentificacion) {
            $this -> identificacion = $unaIdentificacion;
        }

        public function setNombre ($unNombre) {
            $this -> nombre = $unNombre;
        }

        public function setColeccionVuelos ($unaColeccion) {
            $this -> coleccionVuelos = $unaColeccion;
        }

        // A String
        public function __toString () {
            $mensaje = "Lista de vuelos\n";
            $mensaje .= "------------\n";
            $i = 1;
            foreach ($this -> getColeccionVuelos () as $vuelo) {
                $mensaje .= "- " . $i . " " . $vuelo . "\n";
                $i ++;
            }
            return "Identificación: " . $this -> getIdentificacion () . 
                   "\nNombre: " . $this -> getNombre () . 
                   "\n" . $mensaje;
        }

        // Propias de la clase

        /**
         * Recibe el destino del vuelo y la cantidad de asientos libres. Retorna la colección de vuelos que cumplen con los requerimientos
         * @param String $destino
         * @param int $cantAsientos
         * @return array
         */
        public function darVueloADestino ($destino, $cantAsientos) {
            $colVuelos = [];
            $vuelos = $this -> getColeccionVuelos ();
            foreach ($vuelos as $vuelo) {
                $destinoVuelo = $vuelo -> getDestino ();
                if ($destinoVuelo = $destino && $vuelo -> asignarAsientosDisponibles ($cantAsientos)) {
                    $colVuelos [] = $vuelo;
                }
            }
            return $colVuelos;
        }

        /**
         * Recibe un vuelo para verificar que no haya registrado otro vuelo con la mismo destino, fecha y hora de partida. Si se cumple esa condición, 
         * se agrega a la colección
         * @param Vuelo
         * @return boolean
         */
        public function incorporarVuelo ($objVuelo) {
            // $destinoVuelo, $fechaVuelo, $horarioPartidaVuelo; son datos del vuelo recibido por parámetro
            $destinoVuelo = $objVuelo -> getDestino ();
            $fechaVuelo = $objVuelo -> getFecha ();
            $horarioPartidaVuelo = $objVuelo -> getHorarioPartida ();
            $vuelos = $this -> getColeccionVuelos ();
            $cantVuelos = count ($vuelos);
            $incorporacion = false;
            $i = 0;
            do {
                $vuelo = $vuelos [$i];
                // $destino, $fecha, $horario; son datos del vuelo de la colección
                $destino = $vuelo -> getDestino ();
                $fecha = $vuelo -> getFecha ();
                $horarioPartida = $vuelo -> getHorarioPartida ();
                if ($destinoVuelo != $destino && $fechaVuelo != $fecha && $horarioPartidaVuelo != $horarioPartida) {
                    $vuelos [] = $vuelo;
                    $this -> setColeccionVuelos ($vuelos);
                    $incorporacion = true;
                }
                $i ++;
            } while (!$incorporacion && $i < $cantVuelos);
            return $incorporacion;
        }

        /**
         * Recibe un destino, una fecha y una cantidad de asientos necesarios para verificar si es posible vender un vuelo con esos requerimientos
         * @param int $cantAsientos
         * @param String $destino
         * @param String $fecha
         * @return Vuelo|null
         */
        public function venderVueloADestino ($cantAsientos, $destino, $fecha) {
            $vueloVendido = null;
            $vuelos = $this -> getColeccionVuelos ();
            $cantVuelos = count ($vuelos);
            $i = 0;
            do {
                $vuelo = $vuelos [$i];
                $destinoVuelo = $vuelo -> getDestino ();
                $fechaVuelo = $vuelo -> getFecha ();
                if ($destinoVuelo == $destino && $fechaVuelo == $fecha && $vuelo -> asignarAsientosDisponibles ($cantAsientos)) {
                    $vueloVendido = $vuelo;
                }
                $i ++;
            } while ($vueloVendido == null && $i < $cantVuelos);
            return $vueloVendido;
        }

        /**
         * 
         */
        public function montoPromedioRecaudado () {
            $promedio = 0;
            $vuelos = $this -> getColeccionVuelos ();
            $cantVuelos = count ($vuelos);
            if ($cantVuelos > 0) {
                $recaudadoTotal = 0;
                foreach ($vuelos as $vuelo) {
                    $vueloImporte = $vuelo -> getImporte ();
                    $vueloAsientosVendidos = $vuelo -> getCantAsientos () - $vuelo -> getAsientosDisponibles ();
                    $vueloImporteRecaudado = $vueloImporte + $vueloAsientosVendidos;
                    $recaudadoTotal += $vueloImporteRecaudado;
                }
                $promedio = round ($recaudadoTotal / $cantVuelos, 2);
            }
            return $promedio;
        }
    }
?>
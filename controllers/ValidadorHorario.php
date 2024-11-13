<?php


class ValidadorHorario {
   
    private static $horaInicioPermitida = '08:00:00';
    private static $horaFinPermitida = '18:00:00';

    
    public static function esDiaPermitido() {
        $diaActual = date('l'); 
        return $diaActual !== 'Sunday';
    }

    
    public static function esHoraPermitida() {
        $horaActual = date('H:i:s'); // Hora actual en formato 24h
        return $horaActual >= self::$horaInicioPermitida && $horaActual <= self::$horaFinPermitida;
    }
}
?>

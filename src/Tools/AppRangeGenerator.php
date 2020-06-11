<?php

declare(strict_types = 1);

namespace App\Tools;
use App\Tools\AppLogServices;

/**
 * Genera un Arreglo a partir de una matriz
 * @example AppRangeGenerator::makeRange(array(A,AB));
 * @author  Carlos Guillen <code_dev@zoho.com>
 * @version Revision: 1.1.2
 * @access public
 * @since 7.3.5
 * 
 * @method array makeRange(array)
 * @method int alpha2num(string $a) 
 * @method string num2alpha(int $n)
 * @method array getRange(string $start_column, string $end_column)
 * @method bool checkRange(array)
 */
class AppRangeGenerator
{

    /**
     * Crea un arreglo con rango alfabetico a partir de un arreglo [AA,XX]
     * @Throwable
     * @test
     * @access public
     * @param array $array
     * @return mixed
     * @since 7.3.5
     */
    public function makeRange(array $a): ?array
    {
        $arrayFinal = null;
        //generamos atributos las partes del arreglo
        foreach ($a as $attrib) {
            $array[] = self::stringToArray($attrib);
        }
        
        try {
            self::checkRange($array);
            
            $array = self::getRange($array[0]['raw'], $array[1]['raw']);

        } catch (\Exception $e) {
            AppLogServices::servicesLog($e->getCode(),$e->getMessage(),["Class"=>__METHOD__,"Method"=>__FUNCTION__]);
        }
        
        return $array;
    }


    /**
     * convierte cadenas a numeros
     * Posted by https://stackoverflow.com/users/2388004/zan-asmon
     * @access public
     * @param string $a
     * @return int
     * @since 7.3.5
     */
    public static function alpha2num(string $a): int
    {
        $l = strlen($a);
        $n = 0;
        for($i = 0; $i < $l; $i++)
            $n = $n*26 + ord($a[$i]) - 0x40;

        return $n-1;
    }

    /**
     * convierte cadenas a numeros
     * Posted by https://stackoverflow.com/users/2388004/zan-asmon
     * @access public
     * @param int $n
     * @return string
     * @since 7.3.5
     */
    public static function num2alpha(int $n): string
    {
        for($r = ""; $n >= 0; $n = intval($n / 26) - 1)
        $r = chr($n%26 + 0x41) . $r;
        return $r;
    }

    /**
     * obtiene un arreglo dado desde $start_column hasta $end_column
     * Posted by https://stackoverflow.com/users/2388004/zan-asmon
     * @access public
     * @param string $start_column
     * @param string $end_column
     * @return array
     * @since 7.3.5
     */
    public static function getRange($start_column, $end_column): array
    {
        $s = self::alpha2num($start_column); // get start number
        $e = self::alpha2num($end_column); // get end num

        $columns = array();

        // loop from start to end and change back the number to alpha to be stored in array
        for($i=$s; $i<=$e; $i++)
            $columns[] = self::num2alpha($i);

        return $columns;
    }


    /**
     * Toma una cadena y la transforma en un arreglo
     * con propiedades: strength[int], raw[str], split[arr], count[int] 
     * @test
     * @access public
     * @param string $string
     * @return array
     * @since 7.3.5 
     */
    public static function stringToArray(string $string): array
    {
        $array = str_split($string);
        $count = count($array);
        foreach ($array as $value) {
            $n_assci[] = ord($value) - 65;
        }
            
        $array = [
            "strength"      => (int) array_sum($n_assci),
            "raw"           => $string,
            "split"         => $array,
            "count"         => $count
        ];

        return $array;
    }

    /**
     * Genera un arreglo del tipo X->Z a partir de la 
     * cadena X expresada en $string
     * @test
     * @access public
     * @param string $string
     * @return mixed
     * @since 7.3.5
     */
    public static function setRange(string $string)
    {

        $patron = "/^[0-9]+$/";

        if (preg_match($patron, $string)) {
            $salida = false;

        }elseif(strlen($string) > 1){
            $salida = false;

        }else{

            $string = strtoupper($string);
            $salida = range($string, 'Z');

        }

        

        return $salida;
    }

    /**
     * Verifica que no exita flujo inverso en un arreglo [X,Y]-[Y,Z]
     * Establece una Politica de EDP al negar la lectura de mas de 3 niveles [XYZ]
     * @test
     * @access public
     * @param array $array
     * @return bool
     * @since 7.3.5
     * @Trowable
     */
    public static function checkRange(array $array): bool
    {
        //
        
        $salida = true;
        if ($array[0]["strength"] >= $array[1]["strength"]) {
           
            throw new \Exception("Error, se genera un flujo inverso", 400);
            $salida = false;

        }

        if ($array[0]["count"] >= 4 or $array[1]["count"] >= 4) {
            
            throw new \Exception("Se alcanzo la Politica Prevencion de Ejecucion de Datos", 300);
            $salida = false;

        }

        return $salida;
    }
}
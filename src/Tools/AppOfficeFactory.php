<?php declare(strict_types = 1);

namespace App\Tools;

use App\Tools\AppLogServices;
use App\Tools\AppRangeGenerator;
use Exception;

class AppOfficeFactory
{
    public $readRange = array();
    /**
     * crea una array apartir de multiples arrays
     * 
     * @param array $array                      Contiene la informacion para la creacion del modelo de lectura.
     *                                          $array[0] = Elemento a leer, Debe ser un archivo spreadsheet.
     *                                          $array[1] = Tipo de archivo para IOFactory::createReader($array[1]).
     *                                          $array[n] = Rangos validos de lecturas. Ver \AppRangeGenerator::checkRange().
     * @return null|array
     */
    public function multiRangeFactory(array $array = null): ?array
    {
        try {
            if($array == null){
                throw new Exception("El contenedor de Datos es nulo", 400);
            }

            #Validamos que el recurso exista
            if(!file_exists($array[0])){
                throw new Exception("El archivo no existe", 400);
                
            }

            #Validamos que el tipo de recurso este registrado
            $checkFilterType = self::registerType($array[1]);
            if ($checkFilterType == null) {
                throw new Exception("El tipo de archivo declarado no es valido", 400);
            }

            #Pasadas la validaciones verificamos que los elementos restantes sean arreglos
            $range = new AppRangeGenerator();

            foreach ($array as $key => $value) {
                if ($key >= 2) {
                    $this->readRange[] = $range->makeRange($value);
                }
            }

            $array = $this->readRange;

        } catch (\Throwable $th) {
            $array = null;
            AppLogServices::servicesLog($th->getCode(), $th->getMessage(),[
                "Class"     => __METHOD__,
                "Method"    => __FUNCTION__,
                "Trace"     => $th->getTraceAsString()
                ]);
        }

        return $array;
    }

    private static function registerType(string $string = null): ?string
    {
        switch ($string) {
            case 'xlsx':
                $string = 'Xlsx';
                break;
            case 'txt';
                $string = 'Txt';
                break;
            
            default:
                $string = null;
                break;
        }
        return $string;
    }
}
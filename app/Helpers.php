<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Helpers {
    /**
     * Add files to storage.
     *
     * @param $request -> file  $file
     * @param $directorio  $directorio
     * @return $ruta
     */
    public static function addFileStorage($file, $directorio) {
        $ruta = $file -> store($directorio);
        $exploded = explode('/', $ruta);
        $exploded[0] = 'storage';
        $ruta = implode('/', $exploded);

        return $ruta;
    }

    /**
     * Delete files from storage
     *
     * @param string Name table database $table
     * @param string name column to database table  $name
     * @param string Id of row  $id
     */
    public static function deleteFileStorage(String $table, String $name, Int $id){
        $file  = DB::table($table) -> select($name) -> where('id', $id) -> first();

        if(File::exists($file -> $name)) {
            File::delete($file -> $name);
        }
    }

    /**
     * Change status to show - hidden
     *
     * @param string Name table database $table
     * @param string Id of row  $id
     * @param string New status  $status
     */
    public static function changeStatus($table, $id, $status)
    {
        DB::table($table) -> where('id', $id) -> update(['status' => $status]);
    }

    /**
     * Change destacar to show - hidden
     *
     * @param string Name table database $table
     * @param string Id of row  $id
     * @param string New status  $status
     */
    public static function changeDestacar($table, $id, $status)
    {
        DB::table($table) -> where('id', $id) -> update(['destacar' => $status]);
    }

    /**
     * Return fecha en español - 01 de Marzo del 2021
     * @param string Required date  $fecha
     * @return string New Date
     */
    public static function dateSpanishComplete($fecha){
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . ' de ' . $mes . ' del ' . $fecha->format('Y') ;
    }

    /**
     * Return fecha en español corto - 01/Mar/2021
     * @param string Required date  $fecha
     * @return string New Date
     */
    public static function dateSpanishShort($fecha){
        $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

        $fecha = Carbon::parse($fecha);
        $mes = $meses[($fecha->format('n')) - 1];
        return $fecha->format('d') . '/' . $mes . '/' . $fecha->format('Y') ;
    }

    /**
     * Return si la fecha es mayor o igual al dia de hoy
     * @param string Required date  $date
     * @return string Bool
     */
    public static function inTime($date) {
        $now =Carbon::now() -> format('Y-m-d');
        $date1 = Carbon::createFromFormat('Y-m-d', $now);
        $date2 = Carbon::createFromFormat('Y-m-d', $date);

        $result = $date1->gte($date2);
        return $result;
    }
}

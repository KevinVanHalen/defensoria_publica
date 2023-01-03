<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tramite;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TramiteController extends Controller
{
    public function getTramites()
    {
        try {
            $tramites = Tramite::all();

            $arrayTramites = array();
            foreach($tramites as $tramite)
            {
                foreach($tramites as $tramite)
                {
                    $objectTramite = new \stdClass();
                    $objectTramite->id = $tramite->id;
                    $objectTramite->nombre = $tramite->nombre;
                    $objectTramite->descripcion = $tramite->descripcion;
                    $objectTramite->url_informacion = $tramite->url_informacion;
                    $objectTramite->tipo_tramite_id = $tramite->tipo_tramite_id;

                    array_push($arrayTramites,$objectTramite);
                }
            }

            return response()->json([
                "status" => "ok",
                "message" => "Tramites obtenidos con exito",
                "tramites" => $arrayTramites
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                "message" => "Ocurrió un error al obtener el catalogo de tramites",
                "error" => $th->getMessage(),
                "location" => $th->getFile(),
                "line" => $th->getLine(),
            ], 200);
        }
    }

    public function getTramitesCitas()
    {
        try {
            $tramites1 = Tramite::where('tipo_tramite_id', 1)->get();
            $tramites_tipo_1 = array();
            foreach ($tramites1 as $tramite) {
                $object = new \stdClass();
                $object->id = $tramite->id;
                $object->nombre = $tramite->nombre;
                $object->descripcion = $tramite->descripcion;
                
                $requisitos = array();
                foreach ($tramite->requisitos as $requisito) {
                    $object2 = new \stdClass();
                    $object2->id = $requisito->id;
                    $object2->nombre = $requisito->nombre;
                    $object2->obligatorio = $requisito->pivot->obligatorio;
                    $object2->checked = '0';
                    array_push($requisitos, $object2);
                }

                $object->requisitos = $requisitos;

                $centros_atencion = array();
                foreach ($tramite->centrosAtencion->where('status', 1) as $centro) {
                    $object3 = new \stdClass();
                    $object3->id = $centro->id;
                    $object3->nombre = $centro->nombre;
                    array_push($centros_atencion, $object3);
                }

                $object->centrosAtencion = $centros_atencion;

                array_push($tramites_tipo_1, $object);
            }

            $tramites2 = Tramite::where('tipo_tramite_id', 2)->get();
            $tramites_tipo_2 = array();
            foreach ($tramites2 as $tramite) {
                $object = new \stdClass();
                $object->id = $tramite->id;
                $object->nombre = $tramite->nombre;
                $object->descripcion = $tramite->descripcion;
                
                $requisitos = array();
                foreach ($tramite->requisitos as $requisito) {
                    $object2 = new \stdClass();
                    $object2->id = $requisito->id;
                    $object2->nombre = $requisito->nombre;
                    $object2->obligatorio = $requisito->pivot->obligatorio;
                    $object2->checked = '0';
                    array_push($requisitos, $object2);
                }

                $object->requisitos = $requisitos;

                array_push($tramites_tipo_2, $object);
            }

            $tramites3 = Tramite::where('tipo_tramite_id', 3)->get();
            $tramites_tipo_3 = array();
            foreach ($tramites3 as $tramite) {
                $object = new \stdClass();
                $object->id = $tramite->id;
                $object->nombre = $tramite->nombre;
                $object->descripcion = $tramite->descripcion;
                
                $requisitos = array();
                foreach ($tramite->requisitos as $requisito) {
                    $object2 = new \stdClass();
                    $object2->id = $requisito->id;
                    $object2->nombre = $requisito->nombre;
                    $object2->obligatorio = $requisito->pivot->obligatorio;
                    $object2->checked = '0';
                    array_push($requisitos, $object2);
                }

                $object->requisitos = $requisitos;

                array_push($tramites_tipo_3, $object);
            }

            $tramites4 = Tramite::where('tipo_tramite_id', 4)->get();
            $tramites_tipo_4 = array();
            foreach ($tramites4 as $tramite) {
                $object = new \stdClass();
                $object->id = $tramite->id;
                $object->nombre = $tramite->nombre;
                $object->descripcion = $tramite->descripcion;
                
                $requisitos = array();
                foreach ($tramite->requisitos as $requisito) {
                    $object2 = new \stdClass();
                    $object2->id = $requisito->id;
                    $object2->nombre = $requisito->nombre;
                    $object2->obligatorio = $requisito->pivot->obligatorio;
                    $object2->checked = '0';
                    array_push($requisitos, $object2);
                }

                $object->requisitos = $requisitos;

                array_push($tramites_tipo_4, $object);
            }

            return response()->json([
                "status" => "ok",
                "message" => "Catalogo de tramites para agendar citas obtenido con exito.",
                "tramites_tipo_1" => $tramites_tipo_1,
                "tramites_tipo_2" => $tramites_tipo_2,
                "tramites_tipo_3" => $tramites_tipo_3,
                "tramites_tipo_4" => $tramites_tipo_4,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                "message" => "Ocurrió un error al obtener el catalogo de tramites para agendar citas.",
                "error" => $th->getMessage(),
                "location" => $th->getFile(),
                "line" => $th->getLine(),
            ], 200);
        }
    }

    public function guardarNuevoTramite(Request $request)
    {
        $exito = false;

        DB::beginTransaction();

        try {
            $tramite = new Tramite;
            $tramite->nombre = $request->nombre;
            $tramite->descripcion = $request->descripcion;
            $tramite->url_informacion = $request->url;
            $tramite->tipo_tramite_id = $request->tipo_tramite_id;
            $tramite->save();

            $tramites = Tramite::all();

            $arrayTramites = array();
            foreach($tramites as $tramite)
            {
                foreach($tramites as $tramite)
                {
                    $objectTramite = new \stdClass();
                    $objectTramite->id = $tramite->id;
                    $objectTramite->nombre = $tramite->nombre;
                    $objectTramite->descripcion = $tramite->descripcion;
                    $objectTramite->url_informacion = $tramite->url_informacion;
                    $objectTramite->tipo_tramite_id = $tramite->tipo_tramite_id;

                    array_push($arrayTramites,$objectTramite);
                }
            }

            DB::commit();
            $exito = true;

        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                "message" => "Ocurrió un error guardar nuevo tramite",
                "error" => $th->getMessage(),
                "location" => $th->getFile(),
                "line" => $th->getLine(),
            ], 200);
        }
    }

    public function getCalendarioCitas()
    {
        try {
            $days = Carbon::now()->month(12)->daysInMonth;

            $first = Carbon::createFromDate(2022, 12, 1);
            $last = Carbon::createFromDate(2022, 12, $days);
            $period = CarbonPeriod::create($first, $last);

            $semana_uno = array();
            $semana_dos = array();
            $semana_tres = array();
            $semana_cuatro = array();
            $semana_cinco = array();
            $semana_seis = array();

            // $contador = $first->dayOfWeek+1;
            $objectVacio = new \stdClass();
            $objectVacio->fecha_completa = '';
            $objectVacio->dia = '';
            $objectVacio->numero_dia_semana = '';
            $objectVacio->dia_disponible = false;
            $objectVacio->dia_sin_servicio = false;

            $contador = $first->dayOfWeek+1;
            foreach ($period as $date) {
                $object = new \stdClass();
                $object->fecha_completa = $date->toDateString();
                $object->dia = $date->day;
                $object->numero_dia_semana = $date->dayOfWeek;
                $object->fecha_formateada = $this->formatearFecha($date->dayOfWeek, $date->day, $date->month, $date->year);

                if ($contador > 0 && $contador <= 7) {
                    $object->dia_disponible = false;
                    if ($date->dayOfWeek == 0 || $date->dayOfWeek == 6) {
                        $object->dia_sin_servicio = true;
                    } else {
                        $object->dia_sin_servicio = false;
                    }
                    array_push($semana_uno, $object);
                } else if ($contador > 7 && $contador <= 14) {
                    $object->dia_disponible = false;
                    if ($date->dayOfWeek == 0 || $date->dayOfWeek == 6) {
                        $object->dia_sin_servicio = true;
                    } else {
                        $object->dia_sin_servicio = false;
                    }
                    array_push($semana_dos, $object);
                } else if ($contador > 14 && $contador <= 21) {
                    $object->dia_disponible = false;
                    if ($date->dayOfWeek == 0 || $date->dayOfWeek == 6) {
                        $object->dia_sin_servicio = true;
                    } else {
                        $object->dia_sin_servicio = false;
                    }
                    array_push($semana_tres, $object);
                } else if ($contador > 21 && $contador <= 28) {
                    $object->dia_disponible = false;
                    $object->dia_sin_servicio = true;
                    // if ($date->dayOfWeek == 0 || $date->dayOfWeek == 6) {
                    //     $object->dia_sin_servicio = true;
                    // } else {
                    //     $object->dia_sin_servicio = false;
                    // }
                    array_push($semana_cuatro, $object);
                } else if ($contador > 28 && $contador <= 35) {
                    if ($contador > 31 && $contador <= 34) {
                        $object->dia_disponible = true;
                    }
                    if ($date->dayOfWeek == 0 || $date->dayOfWeek == 6) {
                        $object->dia_sin_servicio = true;
                    } else {
                        $object->dia_sin_servicio = false;
                    }
                    array_push($semana_cinco, $object);
                } else if ($contador > 35) {
                    $object->dia_disponible = false;
                    if ($date->dayOfWeek == 0 || $date->dayOfWeek == 6) {
                        $object->dia_sin_servicio = true;
                    } else {
                        $object->dia_sin_servicio = false;
                    }
                    array_push($semana_seis, $object);
                }

                $contador++;
            }

            $array_aux_1 = array();
            $dias_faltantes_semana_uno = 7 - count($semana_uno);
            if ($dias_faltantes_semana_uno > 0) {
                for ($i = 0; $i < $dias_faltantes_semana_uno; $i++) {
                    array_push($array_aux_1, $objectVacio);
                }
                $semana_uno = array_merge($array_aux_1, $semana_uno);
            }
            
            $array_aux_2 = array();
            $dias_faltantes_semana_seis = 7 - count($semana_seis);
            if ($dias_faltantes_semana_seis > 0) {
                for ($i = 0; $i < $dias_faltantes_semana_seis; $i++) {
                    array_push($array_aux_2, $objectVacio);
                }
                $semana_seis = array_merge($semana_seis, $array_aux_2);
            }

            $array_aux_3 = array();
            $dias_faltantes_semana_cinco = 7 - count($semana_cinco);
            if ($dias_faltantes_semana_cinco > 0) {
                for ($i = 0; $i < $dias_faltantes_semana_cinco; $i++) {
                    array_push($array_aux_3, $objectVacio);
                }
                $semana_cinco = array_merge($semana_cinco, $array_aux_3);
            }

            $objectCalendarioCitas = new \stdClass();
            $objectCalendarioCitas->semana_uno = $semana_uno;
            $objectCalendarioCitas->semana_dos = $semana_dos;
            $objectCalendarioCitas->semana_tres = $semana_tres;
            $objectCalendarioCitas->semana_cuatro = $semana_cuatro;
            $objectCalendarioCitas->semana_cinco = $semana_cinco;
            $objectCalendarioCitas->semana_seis = $semana_seis;
            
            return response()->json([
                "status" => "ok",
                "message" => "Calendario de citas obtenido con exito.",
                "calendario_citas" => $objectCalendarioCitas,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                "message" => "Ocurrió un error al obtener el calendario de citas disponibles.",
                "error" => $th->getMessage(),
                "location" => $th->getFile(),
                "line" => $th->getLine(),
            ], 200);
        }

        if ($exito) {
            return response()->json([
                "status" => "ok",
                "message" => "Nuevo Tramite agregado con exito.",
                "tramites" => $arrayTramites
            ], 200);
        }
    }

    public function guardarNuevoTramite(Request $request)
    {

        $exito = false;
        DB::beginTransaction();
        try {
            $tramite = Tramite::find($request->id);
            $tramite->nombre = $request->nombre;
            $tramite->descripcion = $request->descripcion;
            $tramite->url_informacion = $request->url;
            $tramite->tipo_tramite_id = $request->tipo_tramite_id;
            $tramite->save();

            $tramites = Tramite::all();

            $arrayTramites = array();
            foreach($tramites as $tramite)
            {
                foreach($tramites as $tramite)
                {
                    $objectTramite = new \stdClass();
                    $objectTramite->id = $tramite->id;
                    $objectTramite->nombre = $tramite->nombre;
                    $objectTramite->descripcion = $tramite->descripcion;
                    $objectTramite->url_informacion = $tramite->url_informacion;
                    $objectTramite->tipo_tramite_id = $tramite->tipo_tramite_id;

                    array_push($arrayTramites,$objectTramite);
                }
            }

            DB::commit();
            $exito = true;
        }catch (\Throwable $th) {
            DB::rollback();
            $exito = false;
            return response()->json([
                "status" => "error",
                "message" => "Ocurrió un error guardar nuevo tramite",
                "error" => $th->getMessage(),
                "location" => $th->getFile(),
                "line" => $th->getLine(),
            ], 200);
        }
        if ($exito) {
            return response()->json([
                "status" => "ok",
                "message" => "Nuevo Tramite agregado con exito.",
                "tramites" => $arrayTramites
            ], 200);
        }
    }

    public function formatearFecha($week_day, $day, $month, $year)
    {
        $nombre_dia = '';
        switch ($week_day) {
            case 0:
                $nombre_dia = 'Domingo';
                break;
            case 1:
                $nombre_dia = 'Lunes';
                break;
            case 2:
                $nombre_dia = 'Martes';
                break;
            case 3:
                $nombre_dia = 'Miércoles';
                break;
            case 4:
                $nombre_dia = 'Jueves';
                break;
            case 5:
                $nombre_dia = 'Viernes';
                break;
            case 6:
                $nombre_dia = 'Sabado';
                break;
        }

        $nombre_mes = '';
        switch ($month) {
            case 1:
                $nombre_mes = 'Enero';
                break;
            case 2:
                $nombre_mes = 'Febrero';
                break;
            case 3:
                $nombre_mes = 'Marzo';
                break;
            case 4:
                $nombre_mes = 'Abril';
                break;
            case 5:
                $nombre_mes = 'Mayo';
                break;
            case 6:
                $nombre_mes = 'Junio';
                break;
            case 7:
                $nombre_mes = 'Julio';
                break;
            case 8:
                $nombre_mes = 'Agosto';
                break;
            case 9:
                $nombre_mes = 'Septiembre';
                break;
            case 10:
                $nombre_mes = 'Octubre';
                break;
            case 11:
                $nombre_mes = 'Noviembre';
                break;
            case 12:
                $nombre_mes = 'Diciembre';
                break;
        }

        $fecha_formateada = $nombre_dia . ', ' . $day . ' de ' . $nombre_mes . ' de ' . $year;
        return $fecha_formateada;
    }

    public function getDiasMes(Request $request)
    {
        try
        {
            $days = Carbon::createFromDate(2022, $request->mes, 1)->daysInMonth;

            $first = Carbon::createFromDate(2022, $request->mes, 1);
            $last = Carbon::createFromDate(2022, $request->mes, $days);
            $period = CarbonPeriod::create($first, $last);

            $arrayDias = array();

            $id = 1;

            foreach($period as $date)
            {
                $objectDia = new \stdClass();
                $objectDia->id = $id;
                $objectDia->dia = $this->formatearFecha($date->dayOfWeek,$date->day, $date->month, $date->year);
                $objectDia->hora_inicio = $request->hora_inicio;
                $objectDia->hora_fin = $request->hora_fin;
                $objectDia->duracion = $request->duracion;
                if($date->day < 10)
                {
                    $objectDia->fecha = '0'.$date->day.'/'.$date->month.'/'.$date->year;
                }
                else
                {
                    $objectDia->fecha = $date->day.'/'.$date->month.'/'.$date->year;
                }
                if ($date->dayOfWeek == 0 || $date->dayOfWeek == 6) 
                {
                    $objectDia->inhabil = true;
                } else {
                    $objectDia->inhabil = false;
                }

                array_push($arrayDias,$objectDia);
                $id++;
            }

            return response()->json([
                "status" => "ok",
                "message" => "Dias obtenidos con exito",
                "dias" => $arrayDias
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                "message" => "Ocurrió un error al obtener dias",
                "error" => $th->getMessage(),
                "location" => $th->getFile(),
                "line" => $th->getLine(),
            ], 200);
        }

    }
}

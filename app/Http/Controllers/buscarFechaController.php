<?php

namespace App\Http\Controllers;

set_time_limit(0);

use App\Exports\DiaExcel;
use App\Exports\SegmentoExcel;
use App\Models\PDFModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class buscarFechaController extends Controller
{
    public function index(Request $request)
    {
        $post = $request->all();
        $idmall = auth()->user()->id_mall;
        $fecha_inicial = NULL;
        $fecha_final = NULL;
        $opcion = NULL;
        $region = NULL;
        $Consulta = new PDFModel();


        $graficoPorDia = [];
        $graficoPorCamara = [];

        $datos = [];
        $datos_segmentados = [];

        $session_data = $request->session()->get('data_fecha');
        $crear_session = true;


        if (!empty($post)) {
            $fecha_inicial = trim($post['fecha_inicial']);
            $fecha_final = trim($post['fecha_final']);
            $opcion = $post['opcion'];
            $region = !empty($post['region']) ? $post['region'] : '';



            if ($region == 2) {
                $graficoPorDia = $Consulta->GetGraficoPorDiaR2($fecha_inicial, $fecha_final);
                $datos = $Consulta->GetDatosR2($fecha_inicial, $fecha_final);
                $datos_segmentados = $Consulta->GetSegmentoEntradaR2($fecha_inicial, $fecha_final);
                $graficoPorCamara = $Consulta->GetGraficoPorCamaraR2($fecha_inicial, $fecha_final);
            } else {
                $graficoPorDia = $Consulta->GetGraficoPorDiaR1($fecha_inicial, $fecha_final);
                $datos = $Consulta->GetDatosR1($fecha_inicial, $fecha_final);
                $datos_segmentados = $Consulta->GetSegmentoEntradaR1($fecha_inicial, $fecha_final);
                $graficoPorCamara = $Consulta->GetGraficoPorCamaraR1($fecha_inicial, $fecha_final);
                //pre('1');
            }
            //pre_die($graficoPorCamara); 
            if (!empty($datos_segmentados)) {
                $datos_segmentados = $datos_segmentados[0];
            }
            if (!empty($datos)) {
                $datos = $datos[0];
            }

            $data_fecha = [
                'fecha_inicial' => $fecha_inicial,
                'fecha_final' => $fecha_final,
                'tipo_filtro' => $opcion,
                'region' => $region,
                'datos_segmentados' => $datos_segmentados,
            ];
            if ($crear_session) {
                $request->session()->put('data_fecha', $data_fecha);
            }
        }
        //pre_die($graficoPorCamara);
        $js_content = [
            0 => 'layouts.js.GeneralJS',
            1 => 'layouts.buscar.js.BuscarJS',
        ];

        $mall = GetRowByWhere('malls', ['id' => $idmall]);
        $seccion_flujo = 'FLUJO DE DATOS';
        $nombre_mall = !empty($mall->nombre) ? StrUpper($mall->nombre) : '';
        $acceso_mall = 'BUSQUEDA POR FECHAS';

        $valida_reload = true;
        return view('layouts.buscar.buscar', compact(
            'seccion_flujo',
            'nombre_mall',
            'acceso_mall',
            'valida_reload',
            'valida_reload',
            'js_content',
            'graficoPorCamara',
            'idmall',
            'opcion',
            'region',
            'graficoPorDia',
            'datos',
            'fecha_inicial',
            'fecha_final',
            'datos_segmentados',
        ));
    }

    public function LimpiarFiltrosSearch(Request $request)
    {
        $session_data = $request->session()->get('data_fecha');
        if (!empty($session_data)) {
            $request->session()->put('data_fecha', []);
        }
        return redirect(route('searchDate'));
    }

    public function pdf(Request $request)
    {
        $fecha_inicial = NULL;
        $fecha_final = NULL;
        $region = NULL;
        $opcion = NULL;

        $graficoPorCamara = [];
        $graficoPorDia = [];
        $datos = [];


        $idmall = auth()->user()->id_mall;

        $datos_segmentados = [];
        $Consulta = new PDFModel();

        /*if (!empty($post)) {
            $fecha_inicial = trim($post['fecha_inicial']);
            $fecha_final = trim($post['fecha_final']);
            $opcion = $post['opcion'];
            $region = !empty($post['region']) ? $post['region'] : '';

            $data_fecha = [
                'fecha_inicial' => $fecha_inicial,
                'fecha_final' => $fecha_final,
                'tipo_filtro' => $opcion,
                'region' => $region,
            ];

            if ($region == 2) {
                $graficoPorDia = $Consulta->GetGraficoPorDiaR2($fecha_inicial, $fecha_final);
                $datos = $Consulta->GetDatosR2($fecha_inicial, $fecha_final);
                $datos_segmentados = $Consulta->GetSegmentoEntradaR2($fecha_inicial, $fecha_final);
                $graficoPorCamara = $Consulta->GetGraficoPorCamaraR2($fecha_inicial, $fecha_final);
            } else {
                $graficoPorDia = $Consulta->GetGraficoPorDiaR1($fecha_inicial, $fecha_final);
                $datos = $Consulta->GetDatosR1($fecha_inicial, $fecha_final);
                $datos_segmentados = $Consulta->GetSegmentoEntradaR1($fecha_inicial, $fecha_final);
                $graficoPorCamara = $Consulta->GetGraficoPorCamaraR1($fecha_inicial, $fecha_final);
            }

            if (!empty($datos_segmentados)) {
                $datos_segmentados = $datos_segmentados[0];
            }
            if (!empty($datos)) {
                $datos = $datos[0];
            }
        }*/



        $endDate = Carbon::now()->translatedFormat('d-m-Y');

        $nombreMall = [];

        switch ($idmall) {
            case 1:
                $nombreMall = "San Fernando";
                break;
            case 2:
                $nombreMall = "Coquimbo";
                break;
            case 3:
                $nombreMall = "Trapenses";
                break;
            case 4:
                $nombreMall = "Panorámico";
                break;
        }
        $data_fecha = $request->session()->get('data_fecha');
        $fecha_inicial = !empty($data_fecha['fecha_inicial']) ? $data_fecha['fecha_inicial'] : '';
        $fecha_final = !empty($data_fecha['fecha_final']) ? $data_fecha['fecha_final'] : '';
        $seleccion = !empty($data_fecha['region']) ? $data_fecha['region'] : '';

        $newDate = date("d-m-Y", strtotime($fecha_inicial));
        $newDate2 = date("d-m-Y", strtotime($fecha_final));

        if ($seleccion == 2) {
            $graficoPorDia = $Consulta->GetGraficoPorDiaR2($fecha_inicial, $fecha_final);
            $datos = $Consulta->GetDatosR2($fecha_inicial, $fecha_final);
            $datos_segmentados = $Consulta->GetSegmentoEntradaR2($fecha_inicial, $fecha_final);
            $graficoPorCamara = $Consulta->GetGraficoPorCamaraR2($fecha_inicial, $fecha_final);
        } else {
            $graficoPorDia = $Consulta->GetGraficoPorDiaR1($fecha_inicial, $fecha_final);
            $datos = $Consulta->GetDatosR1($fecha_inicial, $fecha_final);
            $datos_segmentados = $Consulta->GetSegmentoEntradaR1($fecha_inicial, $fecha_final);
            $graficoPorCamara = $Consulta->GetGraficoPorCamaraR1($fecha_inicial, $fecha_final);
        }
        unset($datos_segmentados[0]->Tipo);
        //pre_die($graficoPorCamara);
        $pdf = \PDF::loadView('layouts.buscar.pdf', compact('seleccion', 'newDate', 'newDate2', 'graficoPorDia', 'graficoPorCamara', 'endDate', 'nombreMall', 'idmall'), [
            'idmall' => $idmall,
            'datos' => $datos,
            'fecha' => $fecha_inicial,
            'fecha2' => $fecha_final,
            'opcion' => $opcion,
            'datos_segmentados' => !empty($datos_segmentados) ? $datos_segmentados[0] : []
        ]);




        switch ($idmall) {
            case 1:
                return $pdf->stream('Reporte Mall Vivo San Fernando ' . $endDate . '.pdf');
                break;
            case 2:
                return $pdf->stream('Reporte Mall Vivo Coquimbo ' . $endDate . '.pdf');
                break;
            case 3:
                return $pdf->stream('Reporte Mall Vivo Trapenses ' . $endDate . '.pdf');
                break;
            case 4:
                return $pdf->stream('Reporte Mall Vivo Panorámico ' . $endDate . '.pdf');
                break;
        }
    }

    public function export(Request $request)
    {
        $data_fecha = $request->session()->get('data_fecha');
        $fecha = !empty($data_fecha['fecha_inicial']) ? $data_fecha['fecha_inicial'] : '';
        $fecha2 = !empty($data_fecha['fecha_final']) ? $data_fecha['fecha_final'] : '';
        $seleccion = !empty($data_fecha['region']) ? $data_fecha['region'] : '';
        $opcion = !empty($data_fecha['tipo_filtro']) ? $data_fecha['tipo_filtro'] : '';
        $idmall = auth()->user()->id_mall;
        //pre_die($data_fecha);
        $nombre_acceso = '';
        if ($seleccion == 1) {
            $nombre_acceso = 'Acceso_General';
        } elseif ($seleccion == 2) {
            $nombre_acceso = 'Acceso_Exterior';
        } elseif ($seleccion == 3) {
            $nombre_acceso = 'Acceso_Patio_Comida';
        } else {
            $seleccion = 1;
            $nombre_acceso = 'Acceso_General';
        }
        switch ($opcion) {
            case 1:
                return (new DiaExcel($fecha, $fecha2, $seleccion))->download('Dias_' . $nombre_acceso . '.xlsx');
                break;
            case 2:
                return (new SegmentoExcel($fecha, $fecha2, $seleccion, $idmall))->download('Segmentos_' . $nombre_acceso . '.xlsx');
                break;
        }
        //return (new SegmentoExportR2FDSANFERNANDO($fecha, $fecha2, $seleccion))->download('Dias_Patio_Comida.xlsx');
        //return (new SegmentoExportR2SANFERNANDO($fecha, $fecha2, $seleccion))->download('Segmentos_Patio_Comida.xlsx');
    }
}

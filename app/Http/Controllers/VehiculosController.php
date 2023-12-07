<?php

namespace App\Http\Controllers;

use App\Models\TendenciasModel;
use App\Models\VehiculosModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculosController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->locale('es');
        $fechaHoy = $date->translatedFormat('l j F Y');
        $endDate = Carbon::now()->subDay()->translatedFormat('l j F Y');
        $mesActual = $date->translatedFormat('F');
        $roleid = auth()->user()->role_id;
        $idmall = auth()->user()->id_mall;
        $VehiculosModel = new VehiculosModel();
        $uActualizacion = $VehiculosModel->uActualizacion();

        // $patenteVehiculos = $VehiculosModel->patenteVehiculos();
        
        $dAyer = $VehiculosModel->dAyer();
        //pre_die($salidasVehiculos);
        $camaraSectorAnterior = $VehiculosModel->camaraSectorAnterior();
        
        $dAyerGrafico = $VehiculosModel->dAyerGrafico();
        $dHoyGrafico = $VehiculosModel->dHoyGrafico();
        $datosAnuales = $VehiculosModel->datosAnuales();
        // pre_die($datosAnuales);
        $datosMensuales = $VehiculosModel->datosMensuales();
        $js_content = [
            '0' => 'vehiculos/js/VehiculoJS'
        ];
        
        $view_vehicle = GetRowByWhere('view_vehicle', ['mall_id' => $idmall]);  
        if($view_vehicle->mostrar_flujo_personas){
            $salidasVehiculos = $VehiculosModel->salidasVehiculosTendencia();
        }else{
            $salidasVehiculos = $VehiculosModel->salidasVehiculos();
        }

        // pre_die($view_vehicle);
        $mall = GetRowByWhere('malls', ['id' => $idmall]);
        $logo_mall = !empty($mall->imagen) ? $mall->imagen : '';
        $nombre_mall = !empty($mall->nombre) ? StrUpper($mall->nombre) : '';
        //$acceso_mall = !empty($mall->acceso_r1_nombre) ? $mall->acceso_r1_nombre : '';
        $nav_acceso_r1 = true;
        $seccion_flujo = 'FLUJO DE VEHICULOS';
        // pre_die($salidasVehiculos);
        return view('vehiculos.home', compact(
            'logo_mall',
            'nombre_mall',
            //'acceso_mall',
            'seccion_flujo',
            'js_content',
            'view_vehicle',
            'salidasVehiculos',
            'fechaHoy',
            'uActualizacion',
            'endDate',
            'dAyer',
            'camaraSectorAnterior',
            'dHoyGrafico',
            'datosAnuales',
            'mesActual',
            'datosMensuales',
            'dAyerGrafico',
            'idmall',
            'roleid'
        ));
    }

    //TENDENCIA PERSONAS X VEHICULOS
    public function vehiculosPersonas()
    {
        $date = Carbon::now()->locale('es');
        $fechaHoy = $date->translatedFormat('l j F Y');
        $endDate = Carbon::now()->subDay()->translatedFormat('l j F Y');
        $mesAnterior = Carbon::now()->subMonth(1)->translatedFormat('F');
        $mesActualNumero = $date->translatedFormat('m');
        $mesActualNumeroANT = $date->subMonth(1)->translatedFormat('m');
        $Consulta = new TendenciasModel();
        $idmall = auth()->user()->id_mall;

        $uActualizacion = $Consulta->uActualizacion();

        $dHoy = $Consulta->dHoy();

        $dHoyGrafico = $Consulta->dHoyGrafico();

        $dAyer = $Consulta->dAyer();

        $dAyerGrafico = $Consulta->dAyerGrafico();

        $js_content = [
            '0' => 'vehiculos.js.TendenciasJS'
        ];
        $seccion_flujo = 'FLUJO DE VEHICULOS';

        return view('vehiculos.tendencia_personas', compact(
            'js_content',
            'date',
            'fechaHoy',
            'endDate',
            'mesAnterior',
            'mesActualNumero',
            'mesActualNumeroANT',
            'uActualizacion',
            'dHoyGrafico',
            'dAyerGrafico',
            'dHoy',
            'idmall',
            'dAyer'
        ));
    }

    public function BuscarPatente(Request $request)
    {
        $post = $request->all();
        $rsp = [];
        if (!empty($post)) {

            $data = !empty($post) ? $post['data'] : [];
            $texto = !empty($data['texto']) ? $data['texto'] : '';
            $fecha_inicial = !empty($data['fecha_inicial']) ? $data['fecha_inicial'] : '';
            $fecha_final = !empty($data['fecha_final']) ? $data['fecha_final'] : '';
            $page = !empty($data['page']) ? $data['page'] : '';
            $perPage = 10; // Número de resultados por página por defecto es 10
            $VehiculosModel = new VehiculosModel();
            $result = $VehiculosModel->patentesTexto($texto, $page, $perPage, $fecha_inicial, $fecha_final);
            //pre_die($result);
            if (!empty($result)) {
                $rsp = [
                    'tipo' => 'success',
                    'title' => 'Gestión de Vehiculos',
                    'msg' => 'Datos cargados con éxito.',
                    'data' => $result,
                ];
                http_response_code(200); // Código de estado HTTP: 200 OK
            } else {
                $rsp = [
                    'tipo' => 'warning',
                    'title' => 'Gestión de Vehiculos',
                    'msg' => 'No se han encontado resultados para los filtros establecidos.'
                ];
                http_response_code(404); // Código de estado HTTP: 200 OK
            }
        } else {
            $rsp = [
                'tipo' => 'error',
                'title' => 'Error de Validación',
                'msg' => 'Datos no recibidos por el servidor'
            ];
            http_response_code(400); // Código de estado HTTP: 200 OK
        }
        header('Content-Type: application/json');
        echo json_encode($rsp);
        exit;
    }

    public function buscarPatentes(Request $request)
    {
        $post = $request->all();
        $idmall = auth()->user()->id_mall;

        $texto = NULL;
        $fecha = NULL;
        $fecha2 = NULL;
        $data_fecha = $request->session()->get('data_fecha');
        if (!empty($post)) {
            $texto = trim($request->get('texto'));
            $fecha = trim($request->get('fecha'));
            $fecha2 = trim($request->get('fecha2'));
            $data_fechas = [
                'patente' => $texto,
                'fecha_inicio' => $fecha,
                'fecha_final' => $fecha2
            ];
            $request->session()->put('data_fechas', $data_fechas);
        }

        $Consulta = new VehiculosModel();

        if (empty($fecha2)) {
            $patentes = $Consulta->patentesFechaTexto($texto, $fecha);
        } else {
            $patentes = $Consulta->patentesFechaFechaTexto($texto, $fecha, $fecha2);
        }

        if (empty($fecha) && empty($fecha2)) {
            //    $patentes = $Consulta->patentesTexto($texto);
        }
        $mall =GetRowByWhere('malls', ['id' => $idmall]);
        $patentes = [];
        $js_content = [
            '0' => 'layouts.js.GeneralJS',
            '1' => 'vehiculos.js.SearchVehiculoJS'
        ];
        $vehicle_search = true;
        $valida_reload = true;
        $seccion_flujo = 'FLUJO DE VEHICULOS';
        $nombre_mall = !empty($mall->nombre) ? StrUpper($mall->nombre) : '';
        $acceso_mall = 'BUSQUEDA DE PATENTES';

        return view('vehiculos.search', compact(
            'js_content',
            'patentes',
            'acceso_mall',
            'nombre_mall',
            'seccion_flujo',
            'vehicle_search',
            'texto',
            'fecha',
            'valida_reload',
            'fecha2',
            'idmall',
        ));
    }
}

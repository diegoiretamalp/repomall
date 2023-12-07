<?php

namespace App\Http\Controllers;

use App\Models\ConsultasModel;
use App\Models\GerentesModel;
use App\Models\MallsModel;
use App\Models\TendenciasModel;
use App\Models\UsersModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GerenteController extends Controller
{


    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $idmall = auth()->user()->id_mall;
        $distribucion_id = auth()->user()->distribucion_id;
        $UsersModel = new UsersModel();

        $where_dbs = [
            'distribucion_id' => $distribucion_id,
            'estado' => true,
            'deleted' => false,
        ];

        $databases = QueryBuilder('databases', $where_dbs);
        if (empty($databases)) {
            return redirect('logoutSession');
        }
        $datos_malls = [];
        $array_push = [];
        foreach ($databases as $db) {
            $_SESSION['db_active'] = $db;
            //configureDatabaseConnection($db);
            $mall = GetRowByWhere('malls', ['estado' => true, 'id' => $db->mall_id]);
            $GerentesModel = new GerentesModel();
            $array_push[$db->mall_id]['mall'] = $mall;

            if ($mall->acceso_vehicle) {
                $aforo_actual_vehicle = $GerentesModel->aforoActualVehicle();
                if (!empty($aforo_actual_vehicle)) {
                    $array_push[$db->mall_id]['aforo_actual_vehicle'] = $aforo_actual_vehicle;
                }
            }
            // if ($mall->acceso_tendencia) {
            //     $aforo_actual_tendencia = $GerentesModel->aforoActualVehicle();
            //     if (!empty($aforo_actual_tendencia)) {
            //         $array_push[$db->mall_id]['aforo_actual_vehicle'] = $aforo_actual_vehicle;
            //     }
            // }
            if ($mall->acceso_r0) {
                $aforo_actual_r0 = $GerentesModel->aforoActualR0();
                if (!empty($aforo_actual_r0)) {
                    $array_push[$db->mall_id]['aforo_actual_r0'] = $aforo_actual_r0;
                }
            }
            if ($mall->acceso_r1) {
                $aforo_actual_r1 = $GerentesModel->aforoActualR1();
                if (!empty($aforo_actual_r1)) {
                    $array_push[$db->mall_id]['aforo_actual_r1'] = $aforo_actual_r1;
                }
                // $GerentesModel = new GerentesModel($db);
                // $datos_segmentados_dia_r1 = $GerentesModel->GetDataR1();
                // if (!empty($datos_segmentados_dia_r1)) {
                //     $array_push['datos_segmentados_dia_r1'] = $datos_segmentados_dia_r1;
                // }
            }

            if ($mall->acceso_r2) {


                if ($mall->id == 3) {
                    // pre($db);
                    // pre($mall);
                    $GerentesModel = new GerentesModel($db);
                    $datos_segmentados_dia_r2 = $GerentesModel->GetDataTendencia();
                    $aforo_actual_r2 = $GerentesModel->aforoActualTendencia();
                } else {
                    $GerentesModel = new GerentesModel($db);
                    $aforo_actual_r2 = $GerentesModel->aforoActualR2();
                    $datos_segmentados_dia_r2 = $GerentesModel->GetDataR2();
                }

                if (!empty($aforo_actual_r2)) {
                    $array_push[$db->mall_id]['aforo_actual_r2'] = $aforo_actual_r2;
                }
                // if (!empty($datos_segmentados_dia_r2)) {
                //     $array_push['datos_segmentados_dia_r2'] = $datos_segmentados_dia_r2;
                // }
            }
            if ($mall->acceso_r3) {
                $GerentesModel = new GerentesModel($db);
                // $datos_segmentados_dia_r3 = $GerentesModel->GetDataR3();
                $aforo_actual_r3 = $GerentesModel->aforoActualR3();
                // if (!empty($datos_segmentados_dia_r3)) {
                //     $array_push['datos_segmentados_dia_r3'] = $datos_segmentados_dia_r3;
                // }
                if (!empty($aforo_actual_r3)) {
                    $array_push[$db->mall_id]['aforo_actual_r3'] = $aforo_actual_r3;
                }
            }

            array_push($datos_malls, $array_push);
            $_SESSION['db_active'] = [];
        }
        $datos_malls = $array_push;
        // pre_die($array_push);
        //pre($idmall);
        $nav_gerente_administracion = true;
        $no_top = true;
        $js_content = [
            //  '0' => 'gerentes/js/AdministracionJS'
        ];
        return view('gerentes.administracion_view', compact(
            'nav_gerente_administracion',
            'datos_malls',
            'js_content',
            'no_top',
            'idmall',
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ConsultasModel;
use App\Models\RegionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('RedirectRoutes');
    }
    public function AccesoRegionR1($id)
    {
        //pre_die(auth()->user());
        $RegionModel = new RegionModel();

        $date = Carbon::now()->locale('es');
        $fechaHoy = $date->translatedFormat('l j F Y');
        $endDate = Carbon::now()->subDay()->translatedFormat('l j F Y');
        $mesActualGrafico = Carbon::now()->locale('ES')->translatedFormat('F');
        $mesActualNumero = $date->translatedFormat('m');
        $mesActualNumeroANT = $date->subMonth(1)->translatedFormat('m');
        $idmall = auth()->user()->id_mall;

        $aforoHoy = $RegionModel->getAforoHoyR1();
        $aforoAyer = $RegionModel->getAforoAyerR1();
        $personasSegmentoAyer = $RegionModel->getPersonasSegmentoAyerR1();
        $personasSegmentoHoy = $RegionModel->getPersonasSegmentoHoyR1();
        $timeActualizacion =  $RegionModel->timeActualizacion();
        $entradasCamaraAyer = $RegionModel->getEntradasCamaraAyerR1();
        $datosAnuales = $RegionModel->getDatosAnualesR1();
        $datosMensuales = $RegionModel->getDatosMensualesR1();
        $comparativoMesActual = $RegionModel->comparativoMesActualR1();
        $comparativoMesAnterior = $RegionModel->comparativoMesAnteriorR1();


        $js_content = [
            '0' => 'layouts/js/GeneralJS',
            '1' => 'layouts/regiones/js/RegionR1JS',
        ];

        $mall = GetRowByWhere('malls', ['id' => $idmall]);
        $logo_mall = !empty($mall->imagen) ? $mall->imagen : '';
        $nombre_mall = !empty($mall->nombre) ? StrUpper($mall->nombre) : '';
        $acceso_mall = !empty($mall->acceso_r1_nombre) ? $mall->acceso_r1_nombre : '';
        $nav_acceso_r1 = true;
        return view('layouts.regiones.region_r1_view', compact(
            'nav_acceso_r1',
            'js_content',
            'logo_mall',
            'nombre_mall',
            'acceso_mall',
            'aforoHoy', //'dHoy',
            'aforoAyer', //'dAyer',
            'personasSegmentoAyer', //'dAyerGrafico',
            'personasSegmentoHoy', //'dHoyGrafico',
            'fechaHoy',
            'idmall',
            'timeActualizacion', //'uActualizacion',
            'endDate',
            'entradasCamaraAyer', //'camaraSectorAnterior',
            'datosAnuales',
            'datosMensuales',
            'comparativoMesActual',
            'comparativoMesAnterior',
        ));
    }
    public function AccesoRegionR2($id)
    {
        $RegionModel = new RegionModel();

        $date = Carbon::now()->locale('es');
        $fechaHoy = $date->translatedFormat('l j F Y');
        $endDate = Carbon::now()->subDay()->translatedFormat('l j F Y');
        $mesActualGrafico = Carbon::now()->locale('ES')->translatedFormat('F');
        $mesActualNumero = $date->translatedFormat('m');
        $mesActualNumeroANT = $date->subMonth(1)->translatedFormat('m');
        $idmall = auth()->user()->id_mall;

        $aforoHoy = $RegionModel->getAforoHoyR2();
        $aforoAyer = $RegionModel->getAforoAyerR2();
        $personasSegmentoAyer = $RegionModel->getPersonasSegmentoAyerR2();
        $personasSegmentoHoy = $RegionModel->getPersonasSegmentoHoyR2();
        $timeActualizacion =  $RegionModel->timeActualizacion();
        $entradasCamaraAyer = $RegionModel->getEntradasCamaraAyerR2();
        $datosAnuales = $RegionModel->getDatosAnualesR2();
        $datosMensuales = $RegionModel->getDatosMensualesR2();
        $comparativoMesActual = $RegionModel->comparativoMesActualR2();
        $comparativoMesAnterior = $RegionModel->comparativoMesAnteriorR2();


        $js_content = [
            '0' => 'layouts/js/GeneralJS',
            '1' => 'layouts/regiones/js/RegionR2JS'
        ];
        $mall = GetRowByWhere('malls', ['id' => $idmall]);
        $logo_mall = !empty($mall->imagen) ? $mall->imagen : '';
        $nombre_mall = !empty($mall->nombre) ? $mall->nombre : '';
        $acceso_mall = !empty($mall->acceso_r2_nombre) ? $mall->acceso_r2_nombre : '';

        $nav_acceso_r2 = true;
        return view('layouts.regiones.region_r2_view', compact(
            'nav_acceso_r2',
            'js_content',
            'logo_mall',
            'nombre_mall',
            'acceso_mall',
            'aforoHoy', //'dHoy',
            'aforoAyer', //'dAyer',
            'personasSegmentoAyer', //'dAyerGrafico',
            'personasSegmentoHoy', //'dHoyGrafico',
            'fechaHoy',
            'idmall',
            'timeActualizacion', //'uActualizacion',
            'endDate',
            'entradasCamaraAyer', //'camaraSectorAnterior',
            'datosAnuales',
            'datosMensuales',
            'comparativoMesActual',
            'comparativoMesAnterior',
        ));
    }
    public function AccesoRegionR3($id)
    {
        $RegionModel = new RegionModel();

        $date = Carbon::now()->locale('es');
        $fechaHoy = $date->translatedFormat('l j F Y');
        $endDate = Carbon::now()->subDay()->translatedFormat('l j F Y');
        $mesActualGrafico = Carbon::now()->locale('ES')->translatedFormat('F');
        $mesActualNumero = $date->translatedFormat('m');
        $mesActualNumeroANT = $date->subMonth(1)->translatedFormat('m');
        $idmall = auth()->user()->id_mall;

        $aforoHoy = $RegionModel->getAforoHoyR3();
        $aforoAyer = $RegionModel->getAforoAyerR3();
        $personasSegmentoAyer = $RegionModel->getPersonasSegmentoAyerR3();
        $personasSegmentoHoy = $RegionModel->getPersonasSegmentoHoyR3();
        $timeActualizacion =  $RegionModel->timeActualizacion();
        $entradasCamaraAyer = $RegionModel->getEntradasCamaraAyerR3();
        $datosAnuales = $RegionModel->getDatosAnualesR3();
        $datosMensuales = $RegionModel->getDatosMensualesR3();
        $comparativoMesActual = $RegionModel->comparativoMesActualR3();
        $comparativoMesAnterior = $RegionModel->comparativoMesAnteriorR3();


        $js_content = [
            '0' => 'layouts/js/GeneralJS',
            '1' => 'layouts/regiones/js/RegionR3JS',
        ];
        $mall = GetRowByWhere('malls', ['id' => $idmall]);
        $logo_mall = !empty($mall->imagen) ? $mall->imagen : '';
        $nombre_mall = !empty($mall->nombre) ? $mall->nombre : '';
        $acceso_mall = !empty($mall->acceso_r3_nombre) ? $mall->acceso_r3_nombre : '';

        $nav_acceso_r3 = true;
        return view('layouts.regiones.region_r3_view', compact(
            'nav_acceso_r3',
            'js_content',
            'logo_mall',
            'nombre_mall',
            'acceso_mall',
            'aforoHoy', //'dHoy',
            'aforoAyer', //'dAyer',
            'personasSegmentoAyer', //'dAyerGrafico',
            'personasSegmentoHoy', //'dHoyGrafico',
            'fechaHoy',
            'idmall',
            'timeActualizacion', //'uActualizacion',
            'endDate',
            'entradasCamaraAyer', //'camaraSectorAnterior',
            'datosAnuales',
            'datosMensuales',
            'comparativoMesActual',
            'comparativoMesAnterior',
        ));
    }
    public function AccesoRegionR0($id)
    {
        $user = auth()->user();
        $mall = getMallsRegiones($user->id_mall);
        if ($mall->acceso_r0 == false) {
            return redirect()->route('acceso.r1', ['url' => $mall->url_region_r1]);
        }

        $RegionModel = new RegionModel();

        $date = Carbon::now()->locale('es');
        $fechaHoy = $date->translatedFormat('l j F Y');
        $endDate = Carbon::now()->subDay()->translatedFormat('l j F Y');
        $mesActualGrafico = Carbon::now()->locale('ES')->translatedFormat('F');
        $mesActualNumero = $date->translatedFormat('m');
        $mesActualNumeroANT = $date->subMonth(1)->translatedFormat('m');
        $idmall = auth()->user()->id_mall;

        $aforoHoy = $RegionModel->getAforoHoyR0();
        $aforoAyer = $RegionModel->getAforoAyerR0();
        $personasSegmentoAyer = $RegionModel->getPersonasSegmentoAyerR0();
        $personasSegmentoHoy = $RegionModel->getPersonasSegmentoHoyR0();
        $timeActualizacion =  $RegionModel->timeActualizacion();
        $entradasCamaraAyer = $RegionModel->getEntradasCamaraAyerR0();
        $datosAnuales = $RegionModel->getDatosAnualesR0();
        $datosMensuales = $RegionModel->getDatosMensualesR0();
        $comparativoMesActual = $RegionModel->comparativoMesActualR0();
        $comparativoMesAnterior = $RegionModel->comparativoMesAnteriorR0();


        $js_content = [
            '0' => 'layouts/js/GeneralJS',
            '1' => 'layouts/regiones/js/RegionR0JS',
        ];
        $logo_mall = !empty($mall->imagen) ? $mall->imagen : '';
        $nombre_mall = !empty($mall->nombre) ? $mall->nombre : '';
        $acceso_mall = !empty($mall->acceso_r0_nombre) ? $mall->acceso_r0_nombre : '';
        $nav_acceso_r0 = true;
        return view('layouts.regiones.region_r0_view', compact(
            'nav_acceso_r0',
            'js_content',
            'logo_mall',
            'nombre_mall',
            'acceso_mall',
            'aforoHoy', //'dHoy',
            'aforoAyer', //'dAyer',
            'personasSegmentoAyer', //'dAyerGrafico',
            'personasSegmentoHoy', //'dHoyGrafico',
            'fechaHoy',
            'idmall',
            'timeActualizacion', //'uActualizacion',
            'endDate',
            'entradasCamaraAyer', //'camaraSectorAnterior',
            'datosAnuales',
            'datosMensuales',
            'comparativoMesActual',
            'comparativoMesAnterior',
        ));
    }
}

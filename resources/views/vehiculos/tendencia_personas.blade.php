@extends('layouts.layout_main_view')

@section('content')
    <div class="container" style="align-content: center">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <p class="datosHoy display-8" style="margin-left: 11px">
                    <h5>Estadísticas del día</h5>
                </div>
                <div class="col-md-6" style="text-align: center; margin-top: 15px">
                    <h5>
                        <p>{{ ucwords($fechaHoy) }}</p>
                    </h5>
                </div>
                <div class="col-md-3" style=" text-align: end;">
                    </p>
                    <p class="datosHoy display-8">
                    <h5>Última actualización: @foreach ($uActualizacion as $item)
                            {{ $item->tiempo }}</h5>
                    @endforeach
                    </p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner text-center">
                            <h2>Total entradas</h2>
                            <h4>{{ !empty($dHoy) ? formatear_miles($dHoy[0]->Entradas) : 'Sin información' }}</h4>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <hr style="margin-top: 23px;">
            <div id="EntradaHoy" class="col-md-12 shadow-sm chartHoy card graHoy" style="margin-top: 15px;"></div>
        </div>
        <hr>
        <p class="display-8 datosOtros" style="margin-top: 10px;">
        <div class="row">
            <div class="col-md-3">
                <p class="datosHoy display-8" style="margin-left: 11px">
                <h5>Estadísticas del día anterior</h5>
            </div>
            <div class="col-md-6" style="text-align: center; margin-top: 15px">
                <h5>
                    <p>{{ ucwords($endDate) }}</p>
                </h5>
            </div>
        </div>
        </p>
        <div class="row">
            <div class="col-md-6 card shadow-sm">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="font-size: 20px;">
                                Item
                            </th>
                            <th style="font-size: 20px;">
                                Número
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size: 20px;">
                                Total entradas
                            </td>
                            <td style="font-size: 20px;">
                                @foreach ($dAyer as $tPersonasAnt)
                                    {{ number_format($tPersonasAnt->totalenter, 0, ',', '.') }}
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="text-align: center; margin-top: 50px;">
                    <i class="fa-solid fa-person-walking-arrow-right fa-10x"></i>
                </div>
            </div>
            <div class="col-md-6 card shadow-sm aforoDiaAnterior">
                <div>
                    <div id="containerDona"></div>
                </div>
            </div>
        </div>
    @endsection

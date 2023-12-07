@extends('layouts.layout_main_view')

@section('content')
    <div class="container">
        <div class="card card-body">
            <div class="row d-flex justify-content-center">
                @if (!empty($datos_malls))
                    @foreach ($datos_malls as $mall)
                        @if ($mall['mall']->acceso_r0)
                            <div class="col-md-3 mb-3">
                                <div class="card h-100 w-100">
                                    <div class="card-header d-flex justify-content-center">
                                        <h1 class="card-title" style="font-size: 16px">
                                            {{ $mall['mall']->nombre }} - {{ $mall['mall']->acceso_r2_nombre }}
                                        </h1>
                                    </div>
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                        <div class="row-span-1 text-center">
                                            <h3>Entradas</h3>
                                            <p style="font-size: 20px">
                                                {{ formatear_miles($mall['aforo_actual_r0']->Entrada) }}
                                            </p>
                                            <p style="font-size: 14px">
                                                Act: {{ $mall['aforo_actual_r0']->actualizacion }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($mall['mall']->acceso_r1)
                            <div class="col-md-3 mb-3">
                                <div class="card h-100 w-100">
                                    <div class="card-header d-flex justify-content-center">
                                        <h1 class="card-title" style="font-size: 16px">
                                            {{ $mall['mall']->nombre }} -  {{ $mall['mall']->acceso_r1_nombre }}
                                        </h1>
                                    </div>
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                        <div class="row-span-1 text-center">
                                            <h3>Entradas</h3>
                                            <p style="font-size: 20px">
                                                {{ formatear_miles($mall['aforo_actual_r1']->Entrada) }}
                                            </p>
                                            <p style="font-size: 14px">
                                                Act: {{ $mall['aforo_actual_r1']->actualizacion }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($mall['mall']->acceso_r2)
                            <div class="col-md-3 mb-3">
                                <div class="card h-100 w-100">
                                    <div class="card-header d-flex justify-content-center">
                                        <h1 class="card-title" style="font-size: 16px">
                                            {{ $mall['mall']->nombre }} -  {{ $mall['mall']->acceso_r2_nombre }}
                                        </h1>
                                    </div>
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                        <div class="row-span-1 text-center">
                                            <h3>Entradas</h3>
                                            <p style="font-size: 20px">
                                                {{ formatear_miles($mall['aforo_actual_r2']->Entrada) }}
                                            </p>
                                            <p style="font-size: 14px">
                                                Act: {{ $mall['aforo_actual_r2']->actualizacion }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($mall['mall']->acceso_r3)
                            <div class="col-md-3 mb-3">
                                <div class="card h-100 w-100">
                                    <div class="card-header d-flex justify-content-center">
                                        <h1 class="card-title" style="font-size: 16px">
                                            {{ $mall['mall']->nombre }} -  {{ $mall['mall']->acceso_r3_nombre }}
                                        </h1>
                                    </div>
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                        <div class="row-span-1 text-center">
                                            <h3>Entradas</h3>
                                            <p style="font-size: 20px">
                                                {{ formatear_miles($mall['aforo_actual_r3']->Entrada) }}
                                            </p>
                                            <p style="font-size: 14px">
                                                Act: {{ $mall['aforo_actual_r3']->actualizacion }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($mall['mall']->acceso_vehicle)
                            <div class="col-md-3 mb-3">
                                <div class="card h-100 w-100">
                                    <div class="card-header d-flex justify-content-center">
                                        <h1 class="card-title" style="font-size: 16px">
                                            {{ $mall['mall']->nombre }} -  VEHICULOS
                                        </h1>
                                    </div>
                                    <div class="card-body d-flex justify-content-center align-items-center">
                                        <div class="row-span-1 text-center">
                                            <h3>Entradas</h3>
                                            <p style="font-size: 20px">
                                                {{ formatear_miles($mall['aforo_actual_vehicle']->totalenter) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

        </div>
    </div>
@endsection

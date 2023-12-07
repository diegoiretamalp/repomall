@extends('layouts.layout_main_view')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <h4>Formulario de Nuevo Usuario</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <form action="{{ route('users/nuevo.post') }}" method="post" id="formulario">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="Ingrese Nombre Usuario...">
                                        <span id="invalid_name" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email" class="form-control"
                                            placeholder="Ingrese Email...">
                                        <span id="invalid_email" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_id">Rol Usuario</label>
                                        <select name="role_id" id="role_id" class="form-control">
                                            @if (!empty($roles))
                                                @foreach ($roles as $rol)
                                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="invalid_role_id" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6" id="col_mall">
                                    <div class="form-group">
                                        <label for="id_mall">Mall</label>
                                        <select name="id_mall" id="id_mall" class="form-control">
                                            @if (!empty($malls))
                                                @foreach ($malls as $mall)
                                                    <option value="{{ $mall->id }}">{{ $mall->nombre }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="invalid_acceso_r2" class="text-danger"></span>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6" id="col_distribucion" style="display: none">
                                    <div class="form-group">
                                        <label for="distribucion_id">Distribución</label>
                                        <select name="distribucion_id" id="distribucion_id" class="form-control">
                                            <option value="1">Mall Vivo</option>
                                            <option value="2">Espacio Urbano</option>
                                        </select>
                                        <span id="invalid_distribucion_id" class="text-danger"></span>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row" style="display: none">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
                                        <select name="estado" id="estado" class="form-control">
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                        <span id="invalid_estado" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row d-flex justify-content-end">
                                <div class="col-md-4 d-flex justify-content-end">
                                    <div class="btn-group">
                                        <a class="btn btn-secondary" href="{{ route('users/listado') }}"><i
                                                class="fas fa-arrow-left"></i>
                                            Atrás</a>
                                        <button class="btn btn-success" type="button" id="btn_submit"><i
                                                class="fas fa-save"></i>
                                            Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

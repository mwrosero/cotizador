@extends('template.dashboard')
@section('title')
    Veris - Consulta de Clientes
@endsection
@section('title-section')
    Consulta de Clientes
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="accordion mt-3" id="accordionExample">
            <div class="card accordion-item active">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter me-2" width="17" height="17" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z"></path>
                        </svg>
                        Filtros de búsqueda
                    </button>
                </h2>
                <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample" style="">
                    <form class="accordion-body" action="" method="GET">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6 col-md-4">
                                <label for="codigoCliente" class="form-label">Código Cliente</label>
                                <input type="number"
                                    inputmode="numeric" 
                                    pattern="[0-9]*"
                                    step="1"
                                    class="form-control"
                                    id="codigoCliente"
                                    name="codigoCliente" 
                                    value="{{ old('codigoCliente', request()->get('codigoCliente')) }}"
                                    placeholder="" />
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <label for="tipoPersona" class="form-label">Tipo Persona</label>
                                <select id="tipoPersona" name="tipoPersona" class="form-select select2 w-100" data-style="btn-default">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <option {{ old('tipoPersona', request()->get('tipoPersona')) == 'N' ? 'selected' : '' }} value="N">Natural</option>
                                    <option {{ old('tipoPersona', request()->get('tipoPersona')) == 'J' ? 'selected' : '' }} value="J">Juridica</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <label for="estado" class="form-label">Estado</label>
                                <select id="estado" name="estado" class="form-select select2 w-100" data-style="btn-default">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <option {{ old('estado', request()->get('estado')) == 'ACTIVO' ? 'selected' : '' }} value="ACTIVO">Activo</option>
                                    <option {{ old('estado', request()->get('estado')) == 'INACTIVO' ? 'selected' : '' }} value="INACTIVO">Inactivo</option>
                                    <option {{ old('estado', request()->get('estado')) == 'TODOS' ? 'selected' : '' }} value="TODOS">Todos</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <label for="tipoFiltro" class="form-label">Filtrar por</label>
                                <select id="tipoFiltro" name="tipoFiltro" class="form-select select2 w-100" data-style="btn-default">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <option {{ old('tipoFiltro', request()->get('tipoFiltro')) == 'numeroIdentificacion' ? 'selected' : '' }} value="numeroIdentificacion">Número de Identificación</option>
                                    <option {{ old('tipoFiltro', request()->get('tipoFiltro')) == 'nombreCliente' ? 'selected' : '' }} value="nombreCliente">Nombre del Cliente</option>
                                    <option {{ old('tipoFiltro', request()->get('tipoFiltro')) == 'razonSocial' ? 'selected' : '' }} value="razonSocial">Razón Social</option>
                                    <!-- <option value="nombreCliente_razonSocial">nombreCliente_razonSocial</option> -->
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <label for="valorFiltro" class="form-label">Valor</label>
                                <input type="text"
                                    class="form-control"
                                    id="valorFiltro"
                                    name="valorFiltro" 
                                    value="{{ old('valorFiltro', request()->get('valorFiltro')) }}"
                                    placeholder="" />
                            </div>
                            <div class="col-2 col-sm-1 col-md-1">
                                <a href="{{ request()->url() }}" type="button" class="btn bg-alt w-100 mt-0 mt-sm-4" title="Limpiar Filtro">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-filter-x" width="17" height="17" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M13.785 19.405l-4.785 1.595v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414"></path>
                                       <path d="M22 22l-5 -5"></path>
                                       <path d="M17 22l5 -5"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="col-10 col-sm-5 col-md-3">
                                <button type="submit" class="btn bg-veris w-100 mt-0 mt-sm-4">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <div class="col-12 mt-2">
        <div class="card mb-4">
            <!--form class="card-header" action="" method="GET">
                <div class="row g-3">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="codigoCliente" class="form-label">Código Cliente</label>
                        <input type="text"
                            class="form-control"
                            id="codigoCliente"
                            name="codigoCliente" 
                            placeholder="" />
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="tipoPersona" class="form-label">Tipo de Empresa</label>
                        <select id="tipoPersona" name="tipoPersona" class="form-select select2 w-100" data-style="btn-default">
                            <option value="N">Natural</option>
                            <option value="J">Juridica</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="estado" class="form-label">Estado</label>
                        <select id="estado" name="estado" class="form-select select2 w-100" data-style="btn-default">
                            <option value="numeroIdentificacion">Número de Identificación</option>
                            <option value="nombreCliente">Nombre del Cliente</option>
                            <option value="razonSocial">Razón Social</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="tipoFiltro" class="form-label">Filtrar por</label>
                        <select id="tipoFiltro" name="tipoFiltro" class="form-select select2 w-100" data-style="btn-default">
                            <option value="ACTIVO">Activo</option>
                            <option value="INACTIVO">Inactivo</option>
                            <option value="TODOS">Todos</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="valorFiltro" class="form-label">Valor</label>
                        <input type="text"
                            class="form-control"
                            id="valorFiltro"
                            name="valorFiltro" 
                            placeholder="" />
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <button type="button" class="btn bg-veris w-100 mt-0 mt-sm-4">Buscar</button>
                    </div>
                </div>
            </form-->
            <div class="card-header">
                @include('partials.info')
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código Cliente</th>
                                <th>Nombre Cliente</th>
                                <th>Tipo Persona</th>
                                <th>Cédula/RUC</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @if ($datosPaginados->isEmpty())
                            <tr>
                                <td class="text-center p-5" colspan="6">
                                    <h5>No existen resultados para mostrar</h5>
                                </td>
                            </tr>
                        @endif
                        @foreach ($datosPaginados as $dato)
                            <tr>
                                <td>{{ $dato->codigoCliente }}</td>
                                <td>{{ $dato->nombreCliente }}</td>
                                <td>{{ $dato->nombreTipoPersona }}</td>
                                <td>{{ $dato->numeroIdentificacion }}</td>
                                <td>{{ $dato->descripcionEstado }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="ti ti-pencil me-2"></i> Editar
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="ti ti-trash me-2"></i> Eliminar
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @include('partials.pagination')
            </div>
        </div>
    </div>
</div>
@endsection


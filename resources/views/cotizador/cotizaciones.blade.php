@extends('template.dashboard')
@section('title')
    Veris - Consulta de Cotizaciones
@endsection
@section('title-section')
    Consulta de Cotizaciones
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="accordion" id="accordionExample">
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
                                <label for="estado" class="form-label">Estado Cotización</label>
                                <select id="estado" name="estado" class="form-select select2 w-100" data-style="btn-default">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <option {{ old('estado', request()->get('estado')) == 'INGRESADO' ? 'selected' : '' }} value="INGRESADO">INGRESADO</option>
                                    <option {{ old('estado', request()->get('estado')) == 'MODIFICADO' ? 'selected' : '' }} value="MODIFICADO">MODIFICADO</option>
                                    <option {{ old('estado', request()->get('estado')) == 'CONFIRMADO' ? 'selected' : '' }} value="CONFIRMADO">CONFIRMADO</option>
                                    <option {{ old('estado', request()->get('estado')) == 'APROBADO' ? 'selected' : '' }} value="APROBADO">APROBADO</option>
                                    <option {{ old('estado', request()->get('estado')) == 'RECHAZADO' ? 'selected' : '' }} value="RECHAZADO">RECHAZADO</option>
                                    <option {{ old('estado', request()->get('estado')) == 'TODOS' ? 'selected' : '' }} value="TODOS">TODOS</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <label for="codigoTipoContrato" class="form-label">Tipo de Contrato</label>
                                <select id="codigoTipoContrato" name="codigoTipoContrato" class="form-select select2 w-100" data-style="btn-default">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    @foreach($dataContratos as $contrato)
                                        <option {{ (old('codigoTipoContrato', request()->get('codigoTipoContrato'))) == $contrato->codigoTipoContrato ? 'selected' : '' }} value="{{ $contrato->codigoTipoContrato }}">{{ $contrato->nombreTipoContrato }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-10 col-sm-5 col-md-3">
                                <button type="submit" class="btn bg-orange w-100 mt-0 mt-sm-4">Buscar</button>
                            </div>
                            <div class="col-2 col-sm-1 col-md-1">
                                <a href="{{ request()->url() }}" type="button" class="btn bg-alt w-100 mt-0 mt-sm-4" title="Limpiar Filtro">
                                    <img class="ico-button" src="{{ asset('assets/img/veris/reset-ico.svg') }}">
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    @if (session()->has('success'))
    <div class="col-12 mt-4">
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    <div class="col-12 mt-2">
        <div class="card mb-4">
            {{-- <div class="card-header">
                @include('partials.info')
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Cliente</th>
                                <th>Tipo Contrato</th>
                                <th>Fecha Inicio</th>
                                <th>Total</th>
                                <th>Rentabilidad</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @if ($datosPaginados->isEmpty())
                            <tr>
                                <td class="text-center p-5" colspan="8">
                                    <h5>No existen resultados para mostrar</h5>
                                </td>
                            </tr>
                        @endif
                        @foreach ($datosPaginados as $dato)
                            <tr class="fs-12">
                                <td>{{ $dato->codigoCliente }}</td>
                                <td>{{ $dato->nombreCliente }}</td>
                                <td>{{ $dato->nombreTipoContrato }}</td>
                                <td>{{ $dato->fechaInicio }}</td>
                                <td>${{ number_format($dato->total, 2, '.', ',') }}</td>
                                <td>
                                    @if($dato->porcentajeRentabilidad >= 20)
                                    <span class="badge bg-success t_h">{{ $dato->porcentajeRentabilidad }}%</span>
                                    @else
                                    <span class="badge bg-danger t_h">{{ $dato->porcentajeRentabilidad }}%</span>
                                    @endif
                                </td>
                                <td>{{ $dato->estado }}</td>
                                <td>
                                    <a class="d-inline-block me-2" href="/cotizador/cotizacion/edit/{{ $dato->idCotizacion }}">
                                        <img class="action-ico" src="{{ asset('assets/img/veris/edit-ico.svg') }}" alt="" title="Editar">
                                    </a>
                                    {{-- <a class="d-inline-block" href="/cotizador/cotizador/{{ $dato->numeroIdentificacion }}">
                                        <img class="action-ico" src="{{ asset('assets/img/veris/cotizar-ico.svg') }}" alt="" title="Cotizar">
                                    </a> --}}
                                    {{-- <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/cotizador/cliente/edit/{{ $dato->codigoCliente }}">
                                                <i class="fa-regular fa-pen-to-square me-2"></i> Editar
                                            </a>
                                            <a class="dropdown-item" href="/cotizador/cotizador/{{ $dato->numeroIdentificacion }}">
                                                <i class="fa-solid fa-file-invoice-dollar me-2"></i> Cotizar
                                            </a>
                                        </div>
                                    </div> --}}
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
<style>
    .t_h{
        width: 80px;
    }
</style>
@endsection
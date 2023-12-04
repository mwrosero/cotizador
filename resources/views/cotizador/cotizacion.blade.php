@extends('template.dashboard')
@section('title')
    Veris - Cotizacion
@endsection
@section('title-section')
    Cotizador
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                @if(isset($numeroIdentificacion) || isset($edit) )
                <h6 class="txt-veris">Cliente</h6>
                @else
                <h6 class="txt-veris">Seleccionar Cliente<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></h6>
                @endif
                <div class="row g-3">
                    @if(isset($numeroIdentificacion))
                    <input type="hidden" id="searchInput" value="{{ $numeroIdentificacion }}" />
                    @elseif(isset($edit))
                    <input type="hidden" id="idCotizacion" name="idCotizacion" value="{{ $data->idCotizacion }}">
                    @else
                    <div class="col-11 col-md-6">
                        <div class="input-group input-group-merge">
                            <input type="text"
                                id="searchInput"
                                class="form-control"
                                placeholder="Buscar Cliente por Nombre o RUC"
                                autofocus
                                aria-label="Search..."
                                aria-describedby="infoCliente"/>
                            <span title="BUSCAR" class="input-group-text" id="busquedaCliente" onclick="buscarCliente();">
                                <i class="ti ti-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-1 d-none">
                        <div class="sk-chase sk-veris">
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                        </div>
                    </div>
                    @endif
                    <div class="col-12 d-none" id="box-info-cliente">
                        <input type="hidden" id="cliente">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <label class="form-label fs-12">Nombre Cliente</label>
                                <p id="nombreCliente">
                                    @if(isset($edit))
                                    {{ $data->nombreCliente }}
                                    @endif
                                </p>
                            </div>
                            @if(!isset($edit))
                            <div class="col-12 col-md-3">
                                <label class="form-label fs-12">Cédula/RUC</label>
                                <p id="numeroIdentificacion"></p>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label fs-12">Tipo de persona</label>
                                <p id="tipoPersona"></p>
                            </div>
                            @endif
                            {{-- <div class="col-12 col-sm-6 col-md-4">
                                <label class="form-label fs-12">Giro de Negocio</label>
                                <p>Empresa de Informática</p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <label class="form-label fs-12">Nombre Contacto</label>
                                <p>Isabela Devera Delgado</p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <label class="form-label fs-12">Correo electrónico</label>
                                <p>isabela.devera@akold.com</p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <label class="form-label fs-12">Teléfono</label>
                                <p>0988036344</p>
                            </div> --}}
                        </div>                            
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <h6 class="txt-veris">Parametrizaciones</h6>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                    @if(isset($edit))
                        <label class="form-label fs-12">Teléfono</label>
                        <p>{{ $data->nombreEntidadAfiliada }}</p>
                    @else
                        <label for="entidadAfiliada" class="form-label">Entidad Afiliada<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                        <div class="select2-dark">
                            <select id="entidadAfiliada" class="select2 form-select">
                            </select>
                        </div>
                    @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-md-3">
                        <label for="aplicaGeneracionOrden" class="form-label">Aplica Generar Orden</label>
                        <div class="form-check form-switch mb-2 mt-2">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="aplicaGeneracionOrden" 
                                name="aplicaGeneracionOrden"
                                value="aplicaGeneracionOrden" 
                                @if(isset($edit))
                                readonly disabled 
                                @endif
                            />
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="aplicaEnvioMailPaciente" class="form-label">Aplica Enviar Resultados Paciente</label>
                        <div class="form-check form-switch mb-2 mt-2">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="aplicaEnvioMailPaciente" 
                                name="aplicaEnvioMailPaciente"
                                value="aplicaEnvioMailPaciente" 
                                @if(isset($edit))
                                readonly disabled 
                                @endif
                            />
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="aplicaEnvioMailEmpresa" class="form-label">Aplica Enviar Resultados Empresa</label>
                        <div class="form-check form-switch mb-2 mt-2">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="aplicaEnvioMailEmpresa" 
                                name="aplicaEnvioMailEmpresa"
                                value="aplicaEnvioMailEmpresa" 
                                @if(isset($edit))
                                readonly disabled 
                                @endif
                            />
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="validaLineaNegocio" class="form-label">Valida Línea Negocio</label>
                        <div class="form-check form-switch mb-2 mt-2">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="validaLineaNegocio" 
                                name="validaLineaNegocio"
                                value="validaLineaNegocio" 
                                @if(isset($edit))
                                readonly disabled 
                                @endif
                            />
                        </div>
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <h6 class="txt-veris">Tipos de Servicios</h6>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="tipoServicio" class="form-label">¿Qué servicio deseas cotizar?<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                        <div class="select2-dark">
                            <select id="tipoServicio" class="select2 form-select">
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="lugarServicio" class="form-label">¿Dónde deseas el servicio?<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                        <div class="select2-dark">
                            <select id="lugarServicio" class="select2 form-select" multiple>
                                {{-- LUGAR_EMPRESA, CENTRO_MEDICO_VERIS, OTROS --}}
                                <option value="LUGAR_EMPRESA">En el lugar de la empresa</option>
                                <option value="CENTRO_MEDICO_VERIS">En el centro médico Veris</option>
                                <option value="OTROS">Otros</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="centroMedico" class="form-label">Centrales Médicas<i class="fa-solid fa-asterisk fs-10 text-danger ms-2 d-none req-centroMedico"></i></label>
                        <div class="select2-dark">
                            <select id="centroMedico" class="select2 form-select">
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-none">
                        <label for="ciudadChequeo" class="form-label">Ciudad<i class="fa-solid fa-asterisk fs-10 text-danger ms-2 d-none req-ciudadChequeo"></i></label>
                        <div class="select2-dark">
                            <select id="ciudadChequeo" class="select2 form-select" multiple>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="detalleLugar" class="form-label">Por favor detallar el lugar<i class="fa-solid fa-asterisk fs-10 text-danger ms-2 d-none req-detalleLugar"></i></label>
                        <input type="text"
                            class="form-control"
                            id="detalleLugar"
                            placeholder="" 
                            @if(isset($edit))
                            value="{{ $data->direccionServicio }}"
                            @endif
                            />
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <h6 class="txt-veris">Planificación del Chequeo</h6>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="inicioChequeo" class="form-label">¿Cuándo deseas que inicie el chequeo?<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                        <input type="date"
                            min="{{ date('Y-m-d') }}"
                            class="form-control" 
                            id="inicioChequeo"
                            @if(isset($edit))
                            @php
                                $fechaPartes = explode('/', $data->fechaInicio);
                                $fechaFormateada = $fechaPartes[2] . '-' . $fechaPartes[1] . '-' . $fechaPartes[0];
                            @endphp
                            value="{{ $fechaFormateada }}"
                            @endif
                            />
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="diasServicio" class="form-label">¿En cuántos días quieres que finalice el servicio?<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                        <input type="number"
                            inputmode="numeric" 
                            pattern="[0-9]*"
                            oninput="removeLeadingZero(this,6)"
                            step="1"
                            class="form-control"
                            id="diasServicio"
                            placeholder=""
                            @if(isset($edit))
                            value="{{ $data->cantidadDias }}"
                            @endif
                            />
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <h6 class="txt-veris">Prestaciones</h6>
                <div class="row g-3">
                    <div class="col-12">
                        <button type="button"
                            disabled 
                            id="btn-prestaciones"
                            class="btn bg-veris"
                            data-bs-toggle="modal"
                            data-bs-target="#modalPrestaciones"
                            onclick="cargarDataPrestaciones()" 
                            title="Seleccionar Prestaciones"
                            >
                            <i class="fa-solid fa-laptop-medical me-2"></i>
                            Seleccionar Prestaciones
                        </button>
                    </div>
                </div>
                <hr class="my-4 mx-n4 box-resumen d-none" />
                <div class="row g-3 box-resumen d-none">
                    <h6 class="txt-veris box-resumen d-none col-12 col-md-6">Resumen de la Cotización</h6>
                    <div class="col-12 col-md-6 text-end">
                        <button 
                            {{-- data-bs-toggle="modal"
                            data-bs-target="#modalPrestadores" --}}
                            onclick="showModalPrestadores()" 
                            class="btn btn-sm btn-secondary mb-2">
                            <i class="fa-solid fa-house-medical me-2"></i>
                            Seleccionar Prestador
                        </button>
                        <button 
                            data-bs-toggle="modal"
                            data-bs-target="#modalCostos"
                            class="btn btn-sm bg-orange ms-2 mb-2">
                            <i class="fa-solid fa-hand-holding-dollar me-2"></i>
                            Agregar costos
                        </button>
                    </div>
                </div>
                <div class="row g-3 box-resumen d-none">
                    <div class="col-12">
                        <!-- Responsive Datatable -->
                        <div class="card shadow-none">
                            <div class="card-datatable table-responsive">
                                <table class="dt-responsive-prestaciones table table-prestaciones table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Localidad</th>
                                            <th>Ciudad</th>
                                            <th>Grupo</th>
                                            <th>Servicio</th>
                                            <th>Prestación</th>
                                            <th>Cód. Prestación</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unit.</th>
                                            <th>Precio Total</th>
                                            <th width="100px">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="prestaciones-seleccionadas">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/ Responsive Datatable -->
                    </div>
                </div>
                <div class="row g-3 box-resumen d-none">
                    <div class="col-12 col-md-3 mb-2">
                        <label for="observacion" class="form-label">Resumen</label>
                        <div class="row">
                            <div class="col-12 label_costo_0 d-none">
                                <span class="badge tr_costo_0 text-dark fw-bold">* Prestación con Costo $0</span>
                            </div>
                            <div class="col-12 mt-2">
                                <span class="badge bg-orange" id="precio_total"></span>
                            </div>
                            <div class="col-12 mt-2">
                                <span class="badge" id="t_h"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-2">
                        <label for="observacion" class="form-label">Observación (Para el Cliente)</label>
                        <textarea class="form-control fs-12" id="observacion" name="observacion" rows="3" maxlength="4000"></textarea>
                    </div>
                    <div class="col-12 col-md-3 mb-2">
                        <label for="observacion" class="form-label">Sección Interna</label>
                        <button 
                            type="button" 
                            @if(!isset($edit))
                            title="Debe haber una cotización creada para agregar un comentario" 
                            disabled 
                            @endif
                            class="btn btn-sm btn-secondary mb-2 waves-effect waves-light w-100" 
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#offcanvasComentarios" 
                            aria-controls="offcanvasComentarios">
                            <i class="fa-regular fa-comments me-2"></i>
                            Comentarios <span class="badge bg-veris ms-2" id="numeroComentarios">0</span>
                        </button>
                    </div>
                    <div class="col-12 mt-5 text-center">
                    @if(isset($edit))
                        <button type="button"
                            id="btn-crear-cotizacion"
                            class="btn bg-veris"
                            onclick="actualizarCotizacion()" 
                            title="Seleccionar Prestaciones"
                            >
                            <i class="fa-regular fa-floppy-disk me-2"></i>
                            Actualizar Cotización
                        </button>
                    @else
                        <button type="button"
                            id="btn-crear-cotizacion"
                            class="btn bg-veris"
                            onclick="crearCotizacion()" 
                            title="Seleccionar Prestaciones"
                            >
                            <i class="fa-regular fa-floppy-disk me-2"></i>
                            Crear Cotización
                        </button>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PRESTACIONES -->
<div class="modal fade" id="modalPrestaciones" aria-labelledby="modalPrestacionesLabel" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
    {{-- <div class="modal-dialog modal-xl"> --}}
    <div class="modal-dialog modal-fullscreen modal-fullscreen-md-down">
        <div class="modal-content p-2">
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            <div class="modal-header row">
                <div class="col-12 col-md-6">
                    <label for="localidad" class="form-label d-flex justify-content-between">
                        Localidad <span><input type="checkbox" id="selectAll"> Todos</span>
                    </label>
                    <div class="select2-dark">
                        <select id="localidad" multiple class="select2 form-select">
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <label for="grupoPerfil" class="form-label">Grupo Perfil</label>
                    <div class="select2-dark">
                        <select id="grupoPerfil" class="select2 form-select">
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-body pt-2">
                <div class="row">
                    <div class="col-12">
                        <div class="swiper-container rounded" id="scroll-tags">
                            <div class="swiper-button-prev swiper-button-white custom-icon"></div>
                            <ul class="swiper-wrapper justify-content-center" id="list-nivel-1"></ul>
                            <div class="swiper-button-next swiper-button-white custom-icon"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-6 offset-lg-3">
                        <div class="input-group input-group-merge">
                            <span title="BUSCAR" class="input-group-text">
                                <i class="ti ti-search"></i>
                            </span>
                            <input type="search"
                                id="searchInputPrestacion"
                                class="form-control fs-12"
                                placeholder="Buscar prestación"
                                aria-label="Buscar prestación"/>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="grid" id="box-prestaciones"></div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn bg-veris">Guardar</button> --}}
                {{-- onclick="drawTable()" --}}
                <button type="button" class="btn bg-veris" data-bs-dismiss="modal">
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CLIENTES -->
<div class="modal fade" id="modalCliente" aria-labelledby="modalClienteLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        {{-- <div class="modal-dialog modal-fullscreen modal-fullscreen-md-down"> --}}
        <div class="modal-content p-2">
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            <div class="modal-header">
                <div class="col-12">
                    <label class="form-label">Búsqueda: <span class="fw-bold txt-veris" id="clienteSearch"></span></label>
                </div>
            </div>
            <div class="modal-body pt-2">
                <div class="row table-responsive box-row-modal-clientes">
                    <table class="table">
                        <thead class="sticky-top">
                            <tr>
                                <th class="fs-12">Cédula/RUC</th>
                                <th class="fs-12">Cliente</th>
                                <th class="fs-12">Tipo de persona</th>
                                <th class="fs-12">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="box-clientes-list"></tbody>
                    </table>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL COSTOS -->
<div class="modal fade" id="modalCostos" aria-labelledby="modalCostosLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        {{-- <div class="modal-dialog modal-fullscreen modal-fullscreen-md-down"> --}}
        <div class="modal-content p-2">
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            <div class="modal-header">
                <div class="col-12">
                    <label class="form-label">Agregar Costos</label>
                </div>
            </div>
            <div class="modal-body pt-2">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="servicioCosto" class="form-label">Servicio</label>
                        <div class="select2-dark">
                            <select id="servicioCosto" class="select2 form-select">
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="costo" class="form-label">Costo</label>
                        <input type="number"
                            inputmode="numeric" 
                            pattern="[0-9]*"
                            class="form-control"
                            id="costo"
                            placeholder="" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Cerrar
                </button>
                <button type="button" class="btn bg-veris" onclick="agregarCosto()">
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PRESTADORES -->
<div class="modal fade" id="modalPrestadores" aria-labelledby="modalPrestadoresLabel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        {{-- <div class="modal-dialog modal-fullscreen modal-fullscreen-md-down"> --}}
        <div class="modal-content p-2">
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            <div class="modal-header">
                <div class="col-12">
                    <label class="form-label">Costos Prestadores</label>
                </div>
            </div>
            <div class="modal-body pt-2">
                <div class="row" id="box-prestadores">
                </div>
                <div class="row table-responsive">
                    <table class="table table-bordered">
                        <thead class="sticky-top" id="box-prestadores-list-th"></thead>
                        <tbody id="box-prestadores-list"></tbody>
                    </table>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal" onclick="calcularTH()">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas Editar Prestaciones -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasPrestacion" aria-labelledby="offcanvasPrestacionLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasPrestacionLabel">Editar Prestación</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row g-3">
            <div class="col-12">
                <span class="d-block">Prestación:</span>
                <h6 class="txt-veris fs-14 mb-0" id="nombrePrestacionEdit"></h6>
            </div>
            <div class="col-12">
                <span class="d-block">Servicio:</span>
                <h6 class="txt-veris fs-14 mb-0" id="nombreServicioEdit"></h6>
            </div>
            <div class="col-12">
                <span class="d-block">Localidad:</span>
                <h6 class="txt-veris fs-14 mb-0" id="localidadEdit"></h6>
            </div>
            <div class="col-12">
                <span class="d-block">Grupo Perfil:</span>
                <h6 class="txt-veris fs-14 mb-0" id="grupoPerfilEdit"></h6>
            </div>
            <input type="hidden" id="idItemEdit">
            <input type="hidden" id="codigoPrestacionEdit">
            <div class="col-12">
                <label for="precioUnitarioEdit" class="form-label">Precio Unitario</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text cursor-pointer">
                        <i class="fa-solid fa-dollar-sign me-2"></i>
                    </span>
                    <input type="number"
                        inputmode="numeric" 
                        pattern="[0-9]*"
                        class="form-control"
                        id="precioUnitarioEdit"
                        name="precioUnitarioEdit" 
                        placeholder="" />
                </div>
            </div>
            <div class="col-12">
                <label for="cantidadEdit" class="form-label">Cantidad Pacientes</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text cursor-pointer">
                        <i class="fa-solid fa-hashtag me-2"></i>
                    </span>
                    <input type="number"
                        inputmode="numeric" 
                        pattern="[0-9]*"
                        step="1" 
                        class="form-control"
                        id="cantidadEdit"
                        name="cantidadEdit" 
                        placeholder="" />
                </div>
            </div>
            {{-- <div class="col-12">
                <label for="aplicaTodoGrupo" class="form-label">Aplicar <b>precio</b> para todos los Grupo Perfiles</label>
                <div class="form-check form-switch mb-2 mt-2">
                    <input class="form-check-input" type="checkbox" id="aplicaTodoGrupo" name="aplicaTodoGrupo" />
                </div>
            </div> --}}
            <div class="col-12">
                <button type="button"
                    class="btn bg-veris w-100"
                    data-bs-dismiss="offcanvasPrestacion"
                    onclick="actualizarPrestacion()" 
                    title="Actualizar Prestación">
                    <i class="fa-regular fa-floppy-disk me-2"></i>
                    Actualizar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas Editar Gastos -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasGastos" aria-labelledby="offcanvasGastosLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasPrestacionLabel">Editar Gasto</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row g-3">
            <div class="col-12">
                <span class="d-block">Servicio:</span>
                <h6 class="txt-veris fs-14 mb-0" id="nombreServicioGastoEdit"></h6>
            </div>
            <input type="hidden" id="idItemGastoEdit">
            <div class="col-12">
                <label for="costoGastoEdit" class="form-label">Costo</label>
                <input type="number"
                    inputmode="numeric" 
                    pattern="[0-9]*"
                    class="form-control"
                    id="costoGastoEdit"
                    name="costoGastoEdit" 
                    placeholder="" />
            </div>
            <div class="col-12">
                <button type="button"
                    class="btn bg-veris w-100"
                    data-bs-dismiss="offcanvasGastos"
                    onclick="actualizarGasto()" 
                    title="Actualizar Prestación">
                    <i class="fa-regular fa-floppy-disk me-2"></i>
                    Actualizar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas Comentarios -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasComentarios" aria-labelledby="offcanvasComentariosLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasPrestacionLabel">Comentarios de Cotización</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row g-3">
            <div class="col-12 box-comentarios mb-2">
                {{-- <div class="row rounded p-1 mb-1 fs-12">
                    <div class="col-6 fw-bold fs-10 mb-2">MFARIAS</div>
                    <div class="col-6 text-end fs-10 mb-2"><span class="badge bg-light text-dark fw-bold">hace 1 día</span></div>
                    <div class="col-12">
                        Lorem ipsum dolor sit amet consectetur adipisicing, elit. Praesentium quae optio asperiores nesciunt! Doloremque dolorum, culpa adipisci saepe inventore, voluptatem recusandae, nihil tempore possimus cumque at quas amet nemo tempora.
                    </div>
                </div> --}}
            </div>
            <div class="col-12 mb-2">
                <textarea class="form-control fs-12" id="nuevoComentario" name="nuevoComentario" rows="3" maxlength="2000"></textarea>
            </div>
            <div class="col-12 mt-0">
                <button type="button"
                    id="btnAgregarComentario"
                    class="btn bg-veris w-100"
                    {{-- data-bs-dismiss="offcanvasGastos" --}}
                    onclick="agregarComentario()" 
                    title="Agregar Comentario">
                    <i class="fa-regular fa-comments me-2"></i>
                    Agregar Comentario
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let modalCliente;
    let swiper;
    let dataPrestaciones = [];
    let dataPrestacionesEditOriginal = [];
    let dataCostos = [];
    let costosPrestadores = [];
    let th_cotizacion = 0;
    let modificadoPorCarga = false;

    window.onload = async () => {
        @if(isset($numeroIdentificacion))
        buscarCliente();
        @endif
        @if(isset($edit))
        showLoader();
        @endif
        modalCliente = new bootstrap.Modal('#modalCliente');
        obtenerTiposContrato();
        obtenerCentralesMedicas();
        obtenerCiudades();
        obtenerGruposPerfiles();
        await obtenerServiciosCostos();
        await obtenerNivel1();
        await obtenerPrestaciones();
        showPrestaciones();

        $('body').on('change', '#localidad', function(){
            if(getInput('localidad','select2').length > 0){
                $('.input-prestacion').attr("disabled",false);
            }else{
                $('.input-prestacion').attr("disabled",true);
            }
        })

        $('#selectAll').change(function() {
            // Obtén el estado del checkbox de seleccionar/deseleccionar todos
            var selectAllChecked = $(this).prop('checked');

            // Selecciona o deselecciona todos los options en el select
            $('#localidad option').prop('selected', selectAllChecked).trigger('change');

            // Actualiza el estado del select2
            $('#localidad').trigger('change');
        });

        $('body').on('click touch', '.swiper-slide', function(){
            $('.swiper-slide').removeClass('item-selected');
            $(this).addClass('item-selected');
            showPrestaciones();
        })

        /*$('body').on('change', '#searchInput', function(){
            buscarCliente();
        })*/
        $('#searchInput').keypress(function(event) {
            if (event.which === 13) {
                event.preventDefault();
                if($('#searchInput').val().length > 0){
                    buscarCliente();
                }
            }
        });

        $('body').on('change', '#lugarServicio', function(){
            $('.req-centroMedico').addClass('d-none');
            $('.req-ciudadChequeo').addClass('d-none');
            $('.req-detalleLugar').addClass('d-none');

            /*
                lugarServicio: 1.Empresa 2.Veris 3.Otros
                {{-- LUGAR_EMPRESA, CENTRO_MEDICO_VERIS, OTROS --}}
            */
            let filtroLugar = getInput('lugarServicio','select2');
            //Solo en Veris
            if(filtroLugar.length == 1 && $.inArray("CENTRO_MEDICO_VERIS", filtroLugar) !== -1) {
                $('.req-centroMedico').removeClass('d-none');
            }

            //En la Empresa o en Otro lugar
            if(filtroLugar.length == 1 && ($.inArray("LUGAR_EMPRESA", filtroLugar) !== -1 || $.inArray("OTROS", filtroLugar) !== -1)){
                $('.req-ciudadChequeo').removeClass('d-none');
                $('.req-detalleLugar').removeClass('d-none');
            }

            //En la Empresa y en Veris
            if(filtroLugar.length > 1 && $.inArray("LUGAR_EMPRESA", filtroLugar) !== -1 && $.inArray("CENTRO_MEDICO_VERIS", filtroLugar) !== -1) {
                $('.req-centroMedico').removeClass('d-none');
                $('.req-ciudadChequeo').removeClass('d-none');
                $('.req-detalleLugar').removeClass('d-none');                
            }

            //En Veris y Otros
            if(filtroLugar.length > 1 && $.inArray("CENTRO_MEDICO_VERIS", filtroLugar) !== -1 && $.inArray("OTROS", filtroLugar) !== -1) {
                $('.req-centroMedico').removeClass('d-none');
                $('.req-ciudadChequeo').removeClass('d-none');
                $('.req-detalleLugar').removeClass('d-none');
            }

            //En la Empresa y Otros
            if(filtroLugar.length > 1 && $.inArray("LUGAR_EMPRESA", filtroLugar) !== -1 && $.inArray("OTROS", filtroLugar) !== -1){
                $('.req-ciudadChequeo').removeClass('d-none');
                $('.req-detalleLugar').removeClass('d-none');
            }

            //En los 3
            if(filtroLugar.length > 1 && $.inArray("LUGAR_EMPRESA", filtroLugar) !== -1 && $.inArray("CENTRO_MEDICO_VERIS", filtroLugar) !== -1 && $.inArray("OTROS", filtroLugar) !== -1) {
                $('.req-centroMedico').removeClass('d-none');
                $('.req-ciudadChequeo').removeClass('d-none');
                $('.req-detalleLugar').removeClass('d-none');
            }

        })

        $('body').on('change', '#centroMedico', function(){
            $('.localidad_veris').remove();
            if($('#centroMedico option:selected').val() != ""){
                $('#localidad').append(`<option class="localidad_veris" value="0" title='${ $('#centroMedico option:selected').html() }'>Veris</option>`);
            }
        })

        /*$('.box-row-modal-clientes').each(function() {
            new PerfectScrollbar(this);
        });*/

        $('body').on('click touch', '.btn-seleccionar-cliente', function(){
            let detalle = $.parseJSON($(this).attr("data-rel"));
            $('#nombreCliente').html(detalle.nombreCliente);
            $('#numeroIdentificacion').html(detalle.numeroIdentificacion);
            $('#tipoPersona').html(detalle.nombreTipoPersona);
            $('#box-info-cliente').removeClass('d-none');
            $('#cliente').val(detalle.codigoCliente);
            $('#cliente').attr("cliente-rel",JSON.stringify(detalle));
            $.each(detalle.localidades,function(key, value){
                console.log(value.nombreCiudad);
                $('#localidad').append(`<option class="localidad-item" codigoCiudad-rel="${value.codigoPais}-${value.codigoProvincia}-${value.codigoCiudad}" nombreCiudad-rel="${value.nombreCiudad}" value="${value.secuenciaLocalidad}">${value.nombreLocalidad}</option>`);
            })
            obtenerEntidadesAfiliadas();
            modalCliente.hide();
        })

        /*$('body').on('change','.input-prestacion', function(){
            let grupo = getInput('grupoPerfil');
            let prestacion = $.parseJSON($(this).attr("prestacion-rel"));
            console.log(prestacion);
            dataPrestaciones["grupo-"+grupo] = {
                "codigoPrestacion": parseInt(prestacion.codigoPrestacion),
                "codigoServicio": parseInt($(this).attr("codigoServicio-rel")),
                "cantidadPacientes": $(this).val(),
                "costoUnitario": prestacion.valorCosto,
                "precioUnitario": prestacion.valorCosto,
                "iva": 0
            };
        })*/

        $('body').on('change', '#localidad', function() {
            cargarDataPrestaciones();

            // $('.swiper-wrapper li').removeClass('item-selected');
            // $('.swiper-wrapper li:first-child').addClass('item-selected');
            // showPrestaciones();
        });

        $('body').on('change', '#grupoPerfil', function() {
            cargarDataPrestaciones();

            // $('.swiper-wrapper li').removeClass('item-selected');
            // $('.swiper-wrapper li:first-child').addClass('item-selected');
            // showPrestaciones();
        });

        $('body').on('change', '.input-prestacion', function() {
            //let localidad = parseInt(getInput('localidad'));
            let inputChanged = $(this);
            let localidades = getInput('localidad','select2');
            $.each(localidades, function(key, localidad){
                console.log({localidad})
                let nombreLocalidad = $('#localidad option:selected').html();
                let nombreCiudad = $('#localidad option[value="' + localidad + '"]').attr("nombreCiudad-rel");
                let codigoCiudad = $('#localidad option[value="' + localidad + '"]').attr("codigoCiudad-rel");
                console.log({codigoCiudad});
                let grupo = parseInt(getInput('grupoPerfil'));
                let nombreGrupo = $('#grupoPerfil option:selected').html();
                let prestacion = $.parseJSON(inputChanged.attr("prestacion-rel"));
                let idDetalle = null;
                // console.log(prestacion);

                // Si la secuenciaLocalidad no existe en dataPrestaciones, agregarla
                let secuenciaLocalidad = parseInt(localidad);
                let localidadIndex = dataPrestaciones.findIndex(function(item) {
                    return item.secuenciaLocalidad === secuenciaLocalidad;
                });

                // Si la localidad no existe en dataPrestaciones, agregarlo
                if (localidadIndex === -1) {
                    let nuevaLocalidad = {
                        "secuenciaLocalidad": secuenciaLocalidad,
                        "nombreLocalidad": nombreLocalidad,
                        "nombreCiudad": nombreCiudad,
                        "codigoCiudad": codigoCiudad,
                        "grupos": []
                    };
                    dataPrestaciones.push(nuevaLocalidad);
                    localidadIndex = dataPrestaciones.length - 1; // Obtener el índice de la nueva localidad
                }

                // Obtener el índice del grupo en el arreglo grupos
                let grupoIndex = dataPrestaciones[localidadIndex].grupos.findIndex(function(item) {
                    return item.codigoGrupo === grupo;
                });

                console.log({grupoIndex});

                // Si el grupo no existe en la localidad actual, agregarlo
                if (grupoIndex === -1) {
                    let nuevoGrupo = {
                        "codigoGrupo": grupo,
                        "nombreGrupo": nombreGrupo,
                        "prestaciones": []
                    };
                    dataPrestaciones[localidadIndex].grupos.push(nuevoGrupo);
                    grupoIndex = dataPrestaciones[localidadIndex].grupos.length - 1; // Obtener el índice del nuevo grupo
                }

                if(inputChanged.val() != ''){
                    $('#ck_'+inputChanged.attr("id")).prop('checked',true);
                    //if(inputChanged.attr('item-loaded') && inputChanged.attr('item-loaded') == "S"){);
                    let gruposRel = $('.input_'+inputChanged.attr("codigoServicio-rel")+'_'+prestacion.codigoPrestacion).attr("grupos-rel");
                    // Para cuando se esta editando la cotizacion
                    if(gruposRel){
                        console.log(gruposRel);
                        let gruposRelArr = gruposRel.split(',').map( Number );
                        console.log(parseInt(grupo));
                        console.log(gruposRelArr);
                        if(gruposRelArr.includes(parseInt(grupo))){
                            console.log("----------")
                            // console.log("Agregar idDetalle, activo:true y status:edit");
                            idDetalle = inputChanged.attr("idDetalle-rel");
                            console.log(idDetalle)
                        }
                    }
                }else{
                    $('#ck_'+inputChanged.attr("id")).prop('checked',false);
                }

                // Si el grupo no existe en dataPrestaciones y el valor del input es vacío, no se realiza ninguna acción
                if (grupoIndex === -1 && inputChanged.val() === '') {
                    console.log("Si el grupo no existe en dataPrestaciones y el valor del input es vacío, no se realiza ninguna acción")
                    return;
                }

                let costoUnitario = prestacion.valorCosto;console.log({costoUnitario});
                let precioUnitario = prestacion.valorPvp;
                //if(inputChanged.attr("precioUnitario-rel") && inputChanged.attr("precioUnitario-rel") != ""){
                if(!modificadoPorCarga && inputChanged.attr("precioUnitario-rel") && inputChanged.attr("costoUnitario-rel") != 0){
                    costoUnitario = inputChanged.attr("costoUnitario-rel");
                }
                console.log({costoUnitario});
                if(inputChanged.attr("precioUnitario-rel") && inputChanged.attr("precioUnitario-rel") != ""){
                    precioUnitario = inputChanged.attr("precioUnitario-rel");
                }

                // console.log(prestacion);
                // console.log({costoUnitario});

                let idItem = localidad+"_"+grupo+"_"+inputChanged.attr("codigoServicio-rel")+"_"+prestacion.codigoPrestacion;

                prestacionesEliminadas = $.grep(prestacionesEliminadas, function(valor) {
                    return valor !== idItem;
                });

                // Crear el objeto de la prestación
                let prestacionObj = {
                    "idItem":idItem,
                    "codigoPrestacion": parseInt(prestacion.codigoPrestacion),
                    "nombrePrestacion": prestacion.nombrePrestacion,
                    "codigoServicio": parseInt(inputChanged.attr("codigoServicio-rel")),
                    "nombreServicio": inputChanged.attr("nombreServicio-rel"),
                    "cantidadPacientes": parseInt(inputChanged.val()),
                    "precioUnitario": parseFloat(precioUnitario),
                    "costoUnitario": parseFloat(costoUnitario),
                    /*@if(isset($edit))
                    "precioUnitario": parseFloat(inputChanged.attr("precioUnitario-rel")),
                    "costoUnitario": parseFloat(inputChanged.attr("costoUnitario-rel")),
                    @else
                    "costoUnitario": parseFloat(prestacion.valorCosto),
                    "precioUnitario": parseFloat(prestacion.valorPvp),
                    @endif*/
                    "aplicaIva": prestacion.aplicaIva,
                    "valorPvp": prestacion.valorPvp,
                    "id": inputChanged.attr("id"),
                    "activo":true,
                    @if(isset($edit))
                    "status":"edit",
                    @endif
                    "idDetalle": parseInt(idDetalle)
                };

                let prestacionExistenteIndex = dataPrestaciones[localidadIndex].grupos[grupoIndex].prestaciones.findIndex(function(item) {
                    return item.codigoPrestacion === prestacionObj.codigoPrestacion;
                });

                if (prestacionExistenteIndex !== -1) {
                    // Actualizar los valores de la prestación
                    dataPrestaciones[localidadIndex].grupos[grupoIndex].prestaciones[prestacionExistenteIndex] = prestacionObj;
                } else {
                    // Agregar la prestación al grupo
                    dataPrestaciones[localidadIndex].grupos[grupoIndex].prestaciones.push(prestacionObj);
                }

                console.log(localidadIndex)
                console.log(grupoIndex)
                // Si el valor del input es vacío, eliminar la prestación del grupo
                if (inputChanged.val() === '') {
                    // Si la localidad y el grupo existen en dataPrestaciones
                    if (localidadIndex !== -1 && grupoIndex !== -1) {
                        let grupoExistente = dataPrestaciones[localidadIndex].grupos[grupoIndex];
                        console.log(grupoExistente);
                        let prestacionExistenteIndex = grupoExistente.prestaciones.findIndex(function(item) {
                            return item.codigoPrestacion === prestacionObj.codigoPrestacion;
                        });

                        // Si la prestación existe en el grupo, se elimina
                        if (prestacionExistenteIndex !== -1) {
                            grupoExistente.prestaciones.splice(prestacionExistenteIndex, 1);
                        }

                        // Si no quedan más prestaciones en el grupo, eliminar el grupo
                        if (grupoExistente.prestaciones.length === 0) {
                            dataPrestaciones[localidadIndex].grupos.splice(grupoIndex, 1);
                        }

                        // Si no hay grupos eliminar localidad
                        if(dataPrestaciones[localidadIndex].grupos.length == 0){
                            dataPrestaciones.splice(localidadIndex, 1);
                        }
                    }
                } else {
                    // Si la localidad y el grupo existen en dataPrestaciones
                    if (localidadIndex !== -1 && grupoIndex !== -1) {
                        let grupoExistente = dataPrestaciones[localidadIndex].grupos[grupoIndex];
                        console.log(grupoExistente);
                        let prestacionExistenteIndex = grupoExistente.prestaciones.findIndex(function(item) {
                            return item.codigoPrestacion === prestacionObj.codigoPrestacion;
                        });

                        // Si la prestación existe en el grupo
                        if (prestacionExistenteIndex !== -1) {
                            // Actualizar los valores de la prestación
                            grupoExistente.prestaciones[prestacionExistenteIndex] = prestacionObj;
                        } else {
                            // Agregar la prestación al grupo
                            grupoExistente.prestaciones.push(prestacionObj);
                        }
                    } else {
                        // Si la localidad existe pero el grupo no, crear un nuevo grupo y agregar la prestación
                        if (localidadIndex !== -1) {
                            let nuevoGrupo = {
                                "codigoGrupo": grupo,
                                "nombreGrupo": nombreGrupo,
                                "prestaciones": [prestacionObj]
                            };
                            dataPrestaciones[localidadIndex].grupos.push(nuevoGrupo);
                        }
                    }
                }
            })

        });

        $('body').on('click', '.item-prestadores', function(){
            obtenerPrestadores($(this).attr('idPrestacion-rel'));
        })

        $('body').on('click', '.item-edit', function(){
            cargarItem($(this).attr('idItem-rel'),$(this).attr('secuenciaLocalidad-rel'),$(this).attr('codigoGrupo-rel'));
        })

        $('body').on('click', '.item-edit-gasto', function(){
            cargarGasto($(this).attr('idItem-rel'));
        })

        $('body').on('click', '.item-delete', function(){
            //eliminarItem($(this).attr('idItem-rel'));
            eliminarItem($(this).attr('idItem-rel'),$(this).attr('secuenciaLocalidad-rel'),$(this).attr('codigoGrupo-rel'));
            // tabla.row($(this).parents('tr')).remove().draw();
            // calcularTH();
            drawTable();
            if(dataPrestaciones.length == 0){
                $('.box-resumen').addClass('d-none');
                $('#servicioCosto option').prop('disabled', false);
                dataCostos = [];
                costosPrestadores = [];
            }
        });

        $('body').on('click', '.item-delete-alt', function(){
            eliminarCosto($(this).attr('idItem-rel'));
            tabla.row($(this).parents('tr')).remove().draw();
            calcularTH()
        })

        $('#modalPrestaciones').on('shown.bs.modal', function() {
            resizeAllGridItems();
        });

        $('#modalPrestaciones').on('hidden.bs.modal', function() {
            setTimeout(function(){
                drawTable();
            },300)
        })

        let searchInput = $('#searchInputPrestacion');

        searchInput.on('input', function(event) {
            let cards = $('.servicio-'+$('.item-selected').attr('codigoServicio-rel'));
            if(getInput('searchInputPrestacion').length > 0){
                cards.each(function(index, item) {
                    let cardId = item.id;
                    let searchText = event.target.value.toLowerCase();
                    let qty = 0;
                    let labels = $('#'+cardId + ' label');
                    labels.each(function(index, label) {
                        let labelContent = label.textContent.toLowerCase();
                        //console.log(labelContent, searchText);
                        if (labelContent.includes(searchText) ) {
                            qty++;
                            $(label).parent().removeClass('d-none');
                            $(label).parent().addClass('d-flex');
                        } else {
                            $(label).parent().removeClass('d-flex');
                            $(label).parent().addClass('d-none');
                        }
                    });
                    
                    if(qty == 0){
                        $('#'+cardId).hide();
                    }else{
                        $('#'+cardId).show();
                    }
                })
            }else{
                $('#box-prestaciones .item li').removeClass('d-none');
                $('#box-prestaciones .item li').addClass('d-flex');
                $('.servicio-'+$('.item-selected').attr('codigoServicio-rel')).show();
                resizeAllGridItems();
            }
        });

        $('body').on('change', '.ck-input-prestacion-costo', function() {
            // Obtener el idPrestacion del grupo al que pertenece el checkbox actual
            let idPrestacion = parseInt($(this).attr("data-idPrestacion"));
            let costo = parseFloat($(this).val());
            let identificador = $(this).attr("identificador-rel");

            // Deseleccionar todos los checkboxes del grupo actual, excepto el checkbox actual
            $("[data-idPrestacion='" + idPrestacion + "']").not(this).prop("checked", false);
            
            if ($(this).prop("checked")) {
                // Agregar el idPrestacion y costo al array costosPrestadores si el checkbox está seleccionado
                const index = costosPrestadores.findIndex(item => item.idPrestacion === idPrestacion);
                if (index !== -1) {
                    // Si idPrestacion ya existe, reemplazar el elemento en el array
                    costosPrestadores[index] = { idPrestacion: idPrestacion, costo: costo, identificador: identificador };
                } else {
                    // Si no existe, hacer el push al array
                    costosPrestadores.push({ idPrestacion: idPrestacion, costo: costo, identificador: identificador });
                }

                bg_costo_0(idPrestacion,'remove');
                console.log('remove')

            } else {
                // Si el checkbox está deseleccionado, eliminar el objeto correspondiente del array costosPrestadores
                console.log('add')
                if(prestacionTieneCosto0(idPrestacion) == 0){
                    bg_costo_0(idPrestacion,'add');
                }
                costosPrestadores = costosPrestadores.filter(function(item) {
                    return item.idPrestacion !== idPrestacion;
                });
            }

            calcularTH();
        });

        @if(isset($edit))
            loadComentarios();
            $('#box-info-cliente').removeClass('d-none');
            $('#tipoServicio').val({{ $data->codigoTipoContrato }}).trigger("change");
            @if(isset($data->codigoSucursal))
            $('#centroMedico').val({{ $data->codigoSucursal }}).trigger("change");
            @endif

            @if(isset($data->observacion))
            $('#observacion').val(`{{ $data->observacion }}`);
            @endif

            //Parametrizaciones
            $('#aplicaGeneracionOrden').prop('checked',{{ $data->aplicaGeneracionOrden }});
            $('#aplicaEnvioMailPaciente').prop('checked',{{ $data->aplicaEnvioMailPaciente }});
            $('#aplicaEnvioMailEmpresa').prop('checked',{{ $data->aplicaEnvioMailEmpresa }});
            $('#validaLineaNegocio').prop('checked',{{ $data->validaLineaNegocio }});

            let ciudades = @json($data->ciudades);
            let ciudadesArr = [];
            $.each(ciudades, function(key, value){
                ciudadesArr.push(value.codigoPais+"-"+value.codigoProvincia+"-"+value.codigoCiudad);
            });
            $('#ciudadChequeo').val(ciudadesArr).trigger("change");
            let lugarServicio = "{{ $data->nemonicoLugarServicio }}";
            $('#lugarServicio').val(lugarServicio.split(',')).trigger("change");
            let detalle = @json($data->detalle);
            //Lleno arrays
            $.each(detalle, function(key, value){
                $('#grupoPerfil').val(value.codigoGrupo).trigger('change')
                $.each(value.prestaciones, function(k,v){
                    if(v.activo){
                        console.log(">>>>>"+v.idDetalle)
                        $('.input_'+v.codigoServicio+'_'+v.codigoPrestacion).attr("item-loaded","S");
                        $('.input_'+v.codigoServicio+'_'+v.codigoPrestacion).attr("idDetalle-rel",v.idDetalle);
                        $('.input_'+v.codigoServicio+'_'+v.codigoPrestacion).attr("precioUnitario-rel",v.precioUnitario);
                        $('.input_'+v.codigoServicio+'_'+v.codigoPrestacion).attr("costoUnitario-rel",v.costoUnitario);
                        let gruposRel = $('.input_'+v.codigoServicio+'_'+v.codigoPrestacion).attr("grupos-rel");
                        if(gruposRel){
                            let gruposRelArr = gruposRel.split(',').map( Number );
                            if(!gruposRelArr.includes(parseInt(value.codigoGrupo))){
                                gruposRelArr.push(parseInt(value.codigoGrupo));
                                $('.input_'+v.codigoServicio+'_'+v.codigoPrestacion).attr("grupos-rel",gruposRelArr.join(","))
                            }
                        }else{
                            $('.input_'+v.codigoServicio+'_'+v.codigoPrestacion).attr("grupos-rel",parseInt(value.codigoGrupo));
                        }
                        $('.input_'+v.codigoServicio+'_'+v.codigoPrestacion).val(v.cantidadPacientes).trigger('change');
                    }
                })
            })

            modificadoPorCarga = true;
            
            let costosAdicionales = @json($data->costosAdicionales);
            // console.log(costosAdicionales);
            $.each(costosAdicionales, function(key, value){
                /*$('#servicioCosto').val(value.idCosto).trigger('change');
                $('#costo').val(value.valorUnitario);
                agregarCosto();*/
                let idItem = "costo_"+value.idCosto;
                let msg = "";
                if(value.activo){
                    dataCostos.push(
                        {
                            "idCostoCotizacion": value.idCostoCotizacion,
                            "idCosto": value.idCosto,
                            "nombreCosto": value.nombreCosto,
                            "cantidad": 1,
                            "valorUnitario": parseFloat(value.valorUnitario),
                            "idItem":idItem,
                            "activo": true,
                            "status": "edit"
                        }
                    );
                    $('#servicioCosto').find('option[value="'+value.idCosto+'"]').prop('disabled', true).trigger('change');
                }
            })
            drawTable();
            hideLoader();
            dataPrestacionesEditOriginal = jQuery.extend(true, [], dataPrestaciones);

            //Sobre-escribo valores
        @endif

    }

    function bg_costo_0(codigoPrestacion, type){
        for (const elemento of dataPrestaciones) {
            for (const prestacion of elemento.prestaciones) {
                //Reemplazar costos de provincias
                if(type == "add"){
                    $('.tr-prestacion-'+codigoPrestacion).addClass('tr_costo_0');
                }else{
                    $('.tr-prestacion-'+codigoPrestacion).removeClass('tr_costo_0');
                }
            }
        }
    }

    function prestacionTieneCosto0(codigoPrestacion){
        for (const grupo of dataPrestaciones) {
            for (const prestacion of grupo.prestaciones) {
                if (prestacion.codigoPrestacion === codigoPrestacion) {
                    return prestacion.costoUnitario;
                }
            }
        }
        // Si no se encuentra, puedes devolver un valor por defecto o manejarlo de otra forma
        return 0; // O cualquier otro valor que desees
    }

    let tabla;
    function drawTable(){
        if(tabla){
            tabla.clear().draw();
            //$('.dt-responsive-prestaciones').DataTable().clear().destroy();
        }

        if(dataPrestaciones.length > 0){
            $('.box-resumen').removeClass('d-none');
            let elem = ``;
            $.each(dataCostos, function(key, value){
                elem += `
                <tr class="border-bottom">
                    <td>---</td>
                    <td>GENERAL</td>
                    <td>COSTO ADICIONAL</td>
                    <td>GASTO</td>
                    <td>${ value.nombreCosto }</td>
                    <td>${ value.idCosto }</td>
                    <td id="cantidad_${ value.idItem }">1</td>
                    <td id="precioUnitario_${ value.idItem }">$${ formatDollar(value.valorUnitario) }</td>
                    <td id="total_${ value.idItem }">$${ formatDollar(value.valorUnitario) }</td>
                    <td width="100px" class="text-start align-middle">
                        <div class="d-flex">
                            <a idItem-rel="${ value.idItem }" title="Editar" href="javascript:;" class="btn btn-sm btn-icon item-edit-gasto d-inline" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasGastos" aria-controls="offcanvasGastos">
                                <img class="action-ico d-inline" src="/assets/img/veris/edit-ico.svg" alt="" title="Editar">
                            </a>
                            <a idItem-rel="${ value.idItem }" title="Eliminar Costo" href="javascript:;" class="btn btn-sm btn-icon item-delete-costo d-inline item-delete-alt">
                                <i class="fa-solid fa-trash text-danger d-inline""></i>
                            </a>
                        </div>
                    </td>
                </tr>       
                `;
            });

            $('.label_costo_0').addClass('d-none');
            let total_precios = 0;
            $.each(dataPrestaciones, function(kp, vp){
                $.each(vp.grupos, function(kg, vg){
                    $.each(vg.prestaciones, function(k, v){
                        total_precios += (v.precioUnitario*v.cantidadPacientes);
                        let class_costo_0 = "";
                        // console.log(v.costoUnitario);
                        if(v.costoUnitario == 0){
                            $('.label_costo_0').removeClass('d-none');
                            class_costo_0 = "tr_costo_0";
                            //class_costo_0 = `<span class="badge bg-danger text-white fw-bold p-1" title="Prestación con Costo $0">*</span>`;
                        }
                        elem += `
                        <tr class="border-bottom tr-prestacion-${v.codigoPrestacion} tr-prestacion-${vp.secuenciaLocalidad}-${v.codigoPrestacion} ${class_costo_0}">
                            <td>${ vp.nombreLocalidad }</td>
                            <td>${ vp.nombreCiudad }</td>
                            <td>${ vg.nombreGrupo }</td>
                            <td>${ v.nombreServicio }</td>
                            <td>${ v.nombrePrestacion }</td>
                            <td>${ v.codigoPrestacion }</td>
                            <td id="cantidad_${ v.idItem }">${ v.cantidadPacientes }</td>
                            <td id="precioUnitario_${ v.idItem }" class="precioUnitario_${ v.codigoPrestacion }">$${ formatDollar(v.precioUnitario) }</td>
                            <td id="total_${ v.idItem }">$${ formatDollar(v.precioUnitario*v.cantidadPacientes) }</td>
                            <td width="100px" class="text-end align-middle">
                                <div class="d-flex">
                                    <a idPrestacion-rel="${ v.codigoPrestacion }" title="Ver Prestadores" href="javascript:;" class="btn btn-sm btn-icon pt-1 item-prestadores">
                                        <i class="fa-solid fa-eye text-info align-items-center justify-content-center"></i>
                                    </a>
                                    <a idItem-rel="${ v.idItem }" secuenciaLocalidad-rel="${ vp.secuenciaLocalidad }" codigoGrupo-rel="${ vg.codigoGrupo }" title="Editar" href="javascript:;" class="btn btn-sm btn-icon item-edit align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPrestacion" aria-controls="offcanvasPrestacion">
                                        <img class="action-ico" src="{{ asset('assets/img/veris/edit-ico.svg') }}" alt="" title="Editar">
                                    </a>
                                    <a idItem-rel="${ v.idItem }" secuenciaLocalidad-rel="${ vp.secuenciaLocalidad }" codigoGrupo-rel="${ vg.codigoGrupo }" title="Eliminar Prestación" href="javascript:;" class="btn btn-sm btn-icon item-delete align-items-center pt-1 justify-content-center">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>       
                        `;
                    });
                });
            });

            $('#precio_total').html("Total: $"+formatDollar(total_precios));

            calcularTH();

            $('#prestaciones-seleccionadas').empty();
            $('#prestaciones-seleccionadas').append(elem);
            if(!tabla){
                tabla = $('.dt-responsive-prestaciones').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                    },
                    pageLength: 25,
                    responsive: false,
                    columnDefs: [
                        {
                            targets: [2, 6, 7], // Índices de las columnas que deseas mantener visibles
                            responsivePriority: 1, // Establece una prioridad alta para mantener estas columnas visibles
                        },
                        {
                            targets: '_all',
                            responsivePriority: 2, // Establece una prioridad baja para el resto de las columnas
                        }
                    ]
                });
            }
            $(window).scrollTop($(document).height());
        }else{
            $('.box-resumen').addClass('d-none');
        }
    }

    function cargarDataPrestaciones() {
        $('.input-prestacion').val('');
        $('.ck-input-prestacion').prop('checked',false);
        if(dataPrestaciones.length > 0){
            console.log("cargarDataPrestaciones");
            let secuenciaLocalidad = parseInt($('#localidad option:selected').val());
            let grupo = parseInt($('#grupoPerfil option:selected').val());

            let localidadIndex = dataPrestaciones.findIndex(function(item) {
                return item.secuenciaLocalidad === secuenciaLocalidad;
            });

            if (localidadIndex != -1) {

                let grupoIndex = dataPrestaciones[localidadIndex].grupos.findIndex(function(item) {
                    return item.codigoGrupo === grupo;
                });

                let grupoExistente = dataPrestaciones[localidadIndex].grupos[grupoIndex];
                
                let dataPrestacionesTmp = dataPrestaciones;
                // Blanquear todos los inputs
                dataPrestaciones = dataPrestacionesTmp;

                // Si el grupo existe en dataPrestaciones
                if (grupoExistente) {
                    // Cargar los datos en los inputs
                    grupoExistente.prestaciones.forEach(function(prestacion) {
                        $('#'+prestacion.id).val(prestacion.cantidadPacientes);
                        $('#ck_'+prestacion.id).prop("checked",true);
                    });
                } else {
                    dataPrestacionesTmp = [];
                }
            }
        }
    }

    function cargarItem(idItem,secuenciaLocalidad,codigoGrupo){
        console.log(idItem,secuenciaLocalidad,codigoGrupo)
        let localidadIndex = dataPrestaciones.findIndex(function(item) {
            return item.secuenciaLocalidad === parseInt(secuenciaLocalidad);
        });

        console.log(localidadIndex);

        let grupoIndex = dataPrestaciones[localidadIndex].grupos.findIndex(function(item) {
            return item.codigoGrupo === parseInt(codigoGrupo);
        });

        console.log(grupoIndex);

        $.each(dataPrestaciones[localidadIndex].grupos[grupoIndex].prestaciones, function(key, prestacion){
            if (prestacion.idItem === idItem) {
                //console.table(prestacion)
                $('#nombrePrestacionEdit').html(prestacion.nombrePrestacion + ": "+ prestacion.codigoPrestacion );
                $('#nombreServicioEdit').html(prestacion.nombreServicio );
                $('#localidadEdit').html(dataPrestaciones[localidadIndex].nombreLocalidad);
                $('#grupoPerfilEdit').html(dataPrestaciones[localidadIndex].grupos[grupoIndex].nombreGrupo);
                $('#precioUnitarioEdit').val(prestacion.precioUnitario);
                $('#cantidadEdit').val(prestacion.cantidadPacientes);
                $('#idItemEdit').val(prestacion.idItem);
                $('#codigoPrestacionEdit').val(prestacion.codigoPrestacion);
                return prestacion;
            }
        });

        return null;
    }

    function cargarGasto(idItem){
        for (const gasto of dataCostos) {
            if (gasto.idItem === idItem) {
                //console.table(gasto)
                $('#nombreServicioGastoEdit').html(gasto.nombreCosto+": "+gasto.idCosto);
                $('#costoGastoEdit').val(gasto.valorUnitario);
                $('#idItemGastoEdit').val(gasto.idItem);
                return gasto;
            }
        }
        return null;
    }

    function actualizarPrestacion() {
        let idItem = $('#idItemEdit').val();
        for (const localidades of dataPrestaciones) {
            for (const elemento of localidades.grupos) {
                for (const prestacion of elemento.prestaciones) {
                    if (prestacion.idItem === idItem) {
                        // console.log(idItem);
                        prestacion.cantidadPacientes = parseInt(getInput('cantidadEdit'));
                        prestacion.precioUnitario = getInput('precioUnitarioEdit');
                        // precioUnitario-rel
                        $('#cantidad_'+idItem).html(getInput('cantidadEdit'));
                        $('#precioUnitario_'+idItem).html("$"+formatDollar(getInput('precioUnitarioEdit')));
                        $('#precioUnitario_'+idItem).html("$"+formatDollar(getInput('precioUnitarioEdit')));
                        //$('.precioUnitario_'+prestacion.codigoPrestacion).html("$"+formatDollar(getInput('precioUnitarioEdit')));
                        $('#total_'+idItem).html("$"+formatDollar(getInput('precioUnitarioEdit') * getInput('cantidadEdit')));
                        $('#offcanvasPrestacion').offcanvas('hide');
                        //actualizarItemsConCodigoPrestacion(dataPrestaciones, prestacion.codigoPrestacion, getInput('precioUnitarioEdit'));
                        calcularTH();
                        calcularTotal()

                        return true;
                    }
                }
            }
        }

        return false; // Si no se encuentra el elemento, retorna false
    }

    function calcularTotal(){
        let total_precios = 0;
        $.each(dataPrestaciones, function(key, value){
            $.each(value.prestaciones, function(k, v){
                // console.log(total_precios,(v.precioUnitario*v.cantidadPacientes));
                total_precios += (v.precioUnitario*v.cantidadPacientes);
            })
        })
        $('#precio_total').html("Total: $"+formatDollar(total_precios));
    }

    function actualizarItemsConCodigoPrestacion(objeto, codigoPrestacion, nuevoPrecioUnitario) {
        // Recorremos el objeto
        for (let i = 0; i < objeto.length; i++) {
            const grupo = objeto[i];
            // Recorremos las prestaciones dentro de cada grupo
            for (let j = 0; j < grupo.prestaciones.length; j++) {
                const prestacion = grupo.prestaciones[j];
                // Verificamos si el código de prestación coincide
                if (prestacion.codigoPrestacion === codigoPrestacion) {
                    // Actualizamos el número con el nuevo valor
                    prestacion.precioUnitario = parseFloat(nuevoPrecioUnitario); // Si deseas actualizar el precio también
                }
            }
        }
    }

    /*function actualizarPrestacion() {
        if(!$('#aplicaTodoGrupo').prop('checked')){
            let idItem = $('#idItemEdit').val();
            for (const elemento of dataPrestaciones) {
                for (const prestacion of elemento.prestaciones) {
                    if (prestacion.idItem === idItem) {
                        prestacion.cantidadPacientes = getInput('cantidadEdit');
                        prestacion.precioUnitario = getInput('precioUnitarioEdit');
                        $('#cantidad_'+idItem).html(getInput('cantidadEdit'));
                        $('#precioUnitario_'+idItem).html("$"+getInput('precioUnitarioEdit'));
                        $('#total_'+idItem).html("$"+formatDollar(getInput('precioUnitarioEdit') * getInput('cantidadEdit')));
                        $('#offcanvasPrestacion').offcanvas('hide');
                        calcularTH();
                        return true;
                    }
                }
            }
        }else{
            actualizarPrestacionesMasivas();
        }

        return false; // Si no se encuentra el elemento, retorna false
    }

    function actualizarPrestacionesMasivas() {
        console.log("actualizarPrestacionesMasivas")
        let codigoPrestacionEdit = $('#codigoPrestacionEdit').val();
        let idItem = $('#idItemEdit').val();
        for (const elemento of dataPrestaciones) {
            for (const prestacion of elemento.prestaciones) {
                console.log(prestacion);
                if (prestacion.codigoPrestacion == codigoPrestacionEdit) {
                    prestacion.precioUnitario = getInput('precioUnitarioEdit');
                    if (prestacion.idItem === idItem) {
                        prestacion.cantidadPacientes = getInput('cantidadEdit');
                    }
                    $('#offcanvasPrestacion').offcanvas('hide');
                    calcularTH();
                    drawTable();
                    return true;
                }
            }
        }

        return false; // Si no se encuentra el elemento, retorna false
    }*/

    function actualizarGasto(){
        let idItem = $('#idItemGastoEdit').val();
        for (const gasto of dataCostos) {
            if (gasto.idItem === idItem) {
                gasto.valorUnitario = parseFloat(getInput('costoGastoEdit'));
                $('#precioUnitario_'+idItem).html("$"+formatDollar(getInput('costoGastoEdit')));
                $('#total_'+idItem).html("$"+formatDollar(getInput('costoGastoEdit')));
                $('#offcanvasGastos').offcanvas('hide');
                calcularTH();
                return true;
            }
        }

        return false; // Si no se encuentra el elemento, retorna false
    }

    // Eliminar item desde tabla
    let prestacionesEliminadas = [];
    let costosEliminados = [];
    function eliminarItem(idItem,secuenciaLocalidad,codigoGrupo) {
        console.log(idItem,secuenciaLocalidad,codigoGrupo)
        
        let localidadIndex = dataPrestaciones.findIndex(function(item) {
            return item.secuenciaLocalidad === parseInt(secuenciaLocalidad);
        });
        console.log(localidadIndex);

        let grupoIndex = dataPrestaciones[localidadIndex].grupos.findIndex(function(item) {
            return item.codigoGrupo === parseInt(codigoGrupo);
        });
        console.log(grupoIndex);

        //$.each(dataPrestaciones[localidadIndex].grupos[grupoIndex].prestaciones, function(key, prestacion){})
        // Buscar el elemento con el idItem dado
        const elemento = dataPrestaciones[localidadIndex].grupos[grupoIndex].prestaciones.find(prestacion => prestacion.idItem === idItem);
        console.log(elemento);
        prestacionesEliminadas.push(idItem);

        const prestacionIndex = dataPrestaciones[localidadIndex].grupos[grupoIndex].prestaciones.findIndex(prestacion => prestacion.idItem === idItem);

        if (prestacionIndex !== -1) {
            // Eliminar el elemento con el índice encontrado
            dataPrestaciones[localidadIndex].grupos[grupoIndex].prestaciones.splice(prestacionIndex, 1);
            console.log('Elemento eliminado:', idItem);

            let grupoExistente = dataPrestaciones[localidadIndex].grupos[grupoIndex];

            if (grupoExistente.prestaciones.length === 0) {
                dataPrestaciones[localidadIndex].grupos.splice(grupoIndex, 1);
            }

            // Si no hay grupos eliminar localidad
            if(dataPrestaciones[localidadIndex].grupos.length == 0){
                dataPrestaciones.splice(localidadIndex, 1);
            }
        } else {
            console.log('Elemento no encontrado');
        }

        /*if (elemento) {
            // Filtrar las prestaciones y eliminar la que tiene el idItem
            elemento.prestaciones = elemento.prestaciones.filter(prestacion => prestacion.idItem !== idItem);

            // Verificar si prestaciones[] está vacío
            if (elemento.prestaciones.length === 0) {
                // Eliminar el elemento superior
                dataPrestaciones = dataPrestaciones.filter(item => item.codigoGrupo !== elemento.codigoGrupo);
            }
        }*/
        drawTable();
        //return dataPrestaciones;
    }

    function eliminarCosto(idItem){
        let idCostoEliminado = null;

        // Buscar el índice del item en el array
        var indice = -1;
        for (var i = 0; i < dataCostos.length; i++) {
            if (dataCostos[i].idItem === idItem) {
                if(dataCostos[i].idCostoCotizacion){
                    costosEliminados.push({
                        "idCostoCotizacion":dataCostos[i].idCostoCotizacion,
                        "idCosto": dataCostos[i].idCosto,
                        "nombreCosto": dataCostos[i].nombreCosto,
                        "cantidad": 1,
                        "valorUnitario": parseFloat(dataCostos[i].valorUnitario),
                        "activo":false,
                        "status":"edit",
                        "idItem":idItem
                    });
                }
                indice = i;
                idCostoEliminado = dataCostos[i].idCosto;
                break;
            }
        }

        // Si se encontró el item, eliminarlo del array
        if (indice !== -1) {
            dataCostos.splice(indice, 1);
            $('#servicioCosto option[value="'+idCostoEliminado+'"]').prop("disabled",false);
        }
    }

    function agregarCosto(){
        let idCosto = parseInt(getInput('servicioCosto'));
        let nombreCosto = $('#servicioCosto option:selected').html();
        let valorUnitario = getInput('costo');
        let idItem = "costo_"+idCosto;
        let msg = "";
        
        if(getInput('servicioCosto') == ""){
            msg += "<span class='fs-12'>-Seleccionar un Servicio</span><br>";
        }

        if(valorUnitario == "" || valorUnitario < 1){
            msg += "<span class='fs-12'>-El Costo debe ser un valor mayor a $0</span><br>";
        }
        
        if(msg != ""){
            showMessage('warning','Atención',msg);
            return;
        }

        for (var i = 0; i < dataCostos.length; i++) {
            if (dataCostos[i].idCosto === idCosto) {
                return; // Salir de la función ya que el item fue encontrado
            }
        }

        dataCostos.push(
            {
                "idCosto": idCosto,
                "nombreCosto": nombreCosto,
                "cantidad": 1,
                "valorUnitario": parseFloat(valorUnitario),
                "activo":true,
                @if(isset($edit))
                "status":"edit",
                @endif
                "idItem":idItem
            }
        );

        $('#servicioCosto option[value="'+idCosto+'"]').prop("disabled",true);
        $("#servicioCosto").val(null).trigger("change");
        $('#costo').val("");
        $('#modalCostos').modal('hide');

        calcularTH();

        let elem = ``;
        elem += `
            <tr class="border-bottom">
                <td>GENERAL</td>
                <td>COSTO ADICIONAL</td>
                <td>GASTO</td>
                <td>${ nombreCosto }</td>
                <td>${ idCosto }</td>
                <td id="cantidad_${ idItem }">1</td>
                <td id="precioUnitario_${ idItem }">$${ formatDollar(valorUnitario) }</td>
                <td id="total_${ idItem }">$${ formatDollar(valorUnitario) }</td>
                <td width="100px" class="text-start align-middle">
                    <a idItem-rel="${ idItem }" title="Editar" href="javascript:;" class="btn btn-sm btn-icon item-edit-gasto d-inline" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasGastos" aria-controls="offcanvasGastos">
                        <img class="d-inline action-ico" src="/assets/img/veris/edit-ico.svg" alt="" title="Editar">
                    </a>
                    <a idItem-rel="${ idItem }" title="Eliminar Costo" href="javascript:;" class="btn btn-sm btn-icon item-delete-costo d-inline item-delete-alt">
                        <i class="fa-solid fa-trash text-danger d-inline"></i>
                    </a>
                </td>
            </tr>       
            `;
        //$('#prestaciones-seleccionadas').append(elem);
        tabla.row.add($(elem)[0]).draw();
        tabla.draw();
        drawTable();
    }

    async function crearCotizacion(){
        $('#btn-crear-cotizacion').prop('disabled',true);
        let msg = "";
        let cliente = getInput('cliente');
        let tipoServicio = getInput('tipoServicio');
        let lugarServicio = getInput('lugarServicio');
        let centroMedico = getInput('centroMedico');
        let detalleLugar = getInput('detalleLugar');
        let inicioChequeo  = getInput('inicioChequeo');
        let diasServicio  = getInput('diasServicio');
        let ciudadChequeo = getInput('ciudadChequeo','select2');
        let entidadAfiliada = getInput('entidadAfiliada','select2');
        let observacion = getInput('observacion');

        if(cliente == ""){
            msg += "<span class='fs-12'>-Seleccionar un cliente</span><br>";
        }

        if(tipoServicio == ""){
            msg += "<span class='fs-12'>-Seleccionar un Tipo de Servicio</span><br>";
        }

        if(lugarServicio == ""){
            msg += "<span class='fs-12'>-Seleccionar un lugar</span><br>";
        }

        /*
            lugarServicio: 1.Empresa 2.Veris 3.Otros
        */
        let filtroLugar = getInput('lugarServicio','select2');
        //Solo en Veris
        if(filtroLugar.length == 1 && $.inArray("CENTRO_MEDICO_VERIS", filtroLugar) !== -1) {
            if(centroMedico == ""){
                msg += "<span class='fs-12'>-Seleccionar un Centro Médico</span><br>";
            }
        }

        //En la Empresa o en Otro lugar
        if(filtroLugar.length == 1 && ($.inArray("LUGAR_EMPRESA", filtroLugar) !== -1 || $.inArray("OTROS", filtroLugar) !== -1)){
            if(ciudadChequeo.length == 0){
                // msg += "<span class='fs-12'>-Seleccionar una Ciudad</span><br>";
            }

            if(detalleLugar == ""){
                msg += "<span class='fs-12'>-Seleccionar un detalle del lugar</span><br>";
            }
        }

        //En la Empresa y en Veris
        if(filtroLugar.length > 1 && $.inArray("LUGAR_EMPRESA", filtroLugar) !== -1 && $.inArray("CENTRO_MEDICO_VERIS", filtroLugar) !== -1) {
            if(centroMedico == ""){
                msg += "<span class='fs-12'>-Seleccionar un Centro Médico</span><br>";
            }
            
            if(ciudadChequeo.length == 0){
                // msg += "<span class='fs-12'>-Seleccionar una Ciudad</span><br>";
            }

            if(detalleLugar == ""){
                msg += "<span class='fs-12'>-Seleccionar un detalle del lugar</span><br>";
            }
        }

        //En Veris y Otros
        if(filtroLugar.length > 1 && $.inArray("CENTRO_MEDICO_VERIS", filtroLugar) !== -1 && $.inArray("OTROS", filtroLugar) !== -1) {
            if(centroMedico == ""){
                msg += "<span class='fs-12'>-Seleccionar un Centro Médico</span><br>";
            }
            
            if(ciudadChequeo.length == 0){
                // msg += "<span class='fs-12'>-Seleccionar una Ciudad</span><br>";
            }

            if(detalleLugar == ""){
                msg += "<span class='fs-12'>-Seleccionar un detalle del lugar</span><br>";
            }
        }

        //En la Empresa y Otros
        if(filtroLugar.length > 1 && $.inArray("LUGAR_EMPRESA", filtroLugar) !== -1 && $.inArray("OTROS", filtroLugar) !== -1) {
            if(ciudadChequeo.length == 0){
                // msg += "<span class='fs-12'>-Seleccionar una Ciudad</span><br>";
            }

            if(detalleLugar == ""){
                msg += "<span class='fs-12'>-Seleccionar un detalle del lugar</span><br>";
            }
        }

        //En los 3
        if(filtroLugar.length > 1 && $.inArray("LUGAR_EMPRESA", filtroLugar) !== -1 && $.inArray("CENTRO_MEDICO_VERIS", filtroLugar) !== -1 && $.inArray("OTROS", filtroLugar) !== -1) {
            if(centroMedico == ""){
                msg += "<span class='fs-12'>-Seleccionar un Centro Médico</span><br>";
            }
            
            if(ciudadChequeo.length == 0){
                // msg += "<span class='fs-12'>-Seleccionar una Ciudad</span><br>";
            }

            if(detalleLugar == ""){
                msg += "<span class='fs-12'>-Seleccionar un detalle del lugar</span><br>";
            }
        }

        if(inicioChequeo == ""){
            msg += "<span class='fs-12'>-Seleccionar una fecha de inicio del chequeo</span><br>";
        }

        if(diasServicio == ""){
            msg += "<span class='fs-12'>-Indicar los días que tomará</span><br>";
        }

        if(msg != ""){
            showMessage('warning','Atención',msg);
            $('#btn-crear-cotizacion').prop('disabled',false);
        }else{
            const fecha = new Date(inicioChequeo + 'T00:00:00');
            fecha.setHours(fecha.getHours() + 5); // Ajustar para GMT-0500
            const dia = fecha.getDate();
            const mes = fecha.getMonth() + 1; // Los meses van de 0 a 11 en JavaScript
            const anio = fecha.getFullYear();
            const fechaPrevista = `${dia.toString().padStart(2, '0')}/${mes.toString().padStart(2, '0')}/${anio}`;
            let dataPrestacionesTmp = [...dataPrestaciones];

            for (const elemento of dataPrestacionesTmp) {
                for (const prestacion of elemento.prestaciones) {
                    //Reemplazar costos de provincias
                    let costo_alterno = obtenerCostoPorId(prestacion.codigoPrestacion);
                    if( costo_alterno != null){
                        prestacion.costoUnitario = costo_alterno;
                    }
                }
            }

            let args = [];
            args["endpoint"] = api_url+"/empresarial/v1/cotizacion";
            args["method"] = "POST";
            args["bodyType"] = "json";
            args["showLoader"] = true;
            args["data"] = JSON.stringify({
                "codigoCliente": parseInt(cliente),
                "aplicaGeneracionOrden": $('#aplicaGeneracionOrden').is(":checked"),
                "aplicaEnvioMailPaciente": $('#aplicaEnvioMailPaciente').is(":checked"),
                "aplicaEnvioMailEmpresa": $('#aplicaEnvioMailEmpresa').is(":checked"),
                "validaLineaNegocio": $('#validaLineaNegocio').is(":checked"),
                "codigoEntidadAfiliada": parseInt(entidadAfiliada),
                "nemonicoLugarServicio": getInput('lugarServicio','select2').join(','),
                "codigoTipoContrato": parseInt(tipoServicio),
                "codigoEmpresa":parseInt($('#centroMedico option:selected').attr('codigoEmpresa-rel')),
                "codigoSucursal": parseInt(centroMedico),
                "direccionServicio": detalleLugar,
                "fechaInicio": fechaPrevista,
                "cantidadDias": parseInt(diasServicio),
                "porcentajeRentabilidad": parseFloat(th_cotizacion),
                "observacion": observacion,
                "ciudades":getInput('ciudadChequeo','select2'),
                "detalle": dataPrestacionesTmp,
                "costosAdicionales": dataCostos
            });

            const data = await call(args);
            if(data.code == 200){
                showMessage('success','Atención',"Cotización creada");
                location.href = '/cotizador/consulta-cotizaciones';
            }else{
                showMessage('warning','Atención',data.message);
                $('#btn-crear-cotizacion').prop('disabled',false);
            }
        }
    }
    
    async function actualizarCotizacion(){
        $('#btn-crear-cotizacion').prop('disabled',true);
        let ciudadesArr = [];
        let ciudades = getInput('ciudadChequeo','select2');
        $.each(ciudades, function(key, value){
            ciudadesArr.push({
                "idCiudad": value,
                "activo": true,
                "status": "edit"
            })
        })

        let dataPrestacionesTmp = [...dataPrestaciones];

        for (const elemento of dataPrestacionesTmp) {
            for (const prestacion of elemento.prestaciones) {
                //Reemplazar costos de provincias
                let costo_alterno = obtenerCostoPorId(prestacion.codigoPrestacion);
                if( costo_alterno != null){
                    prestacion.costoUnitario = costo_alterno;
                }
            }
        }

        $.each(prestacionesEliminadas, function(num, codigoPrestacion){
            let prestacion = codigoPrestacion.split("_");
            $.each(dataPrestacionesEditOriginal, function(key, value){
                if(value.codigoGrupo == prestacion[0]){
                    $.each(value.prestaciones, function(k,v){
                        if(v.codigoServicio == prestacion[1] && v.codigoPrestacion == prestacion[2]){
                            v.activo = false;
                            console.log(v)
                            let grupoExistente = dataPrestacionesTmp.find(function(grupo) {
                                return grupo.codigoGrupo === value.codigoGrupo;
                            });
                            console.log(grupoExistente)
                            if(grupoExistente) {
                                grupoExistente.prestaciones.push(v);
                            }
                        }
                    })
                }
            })
        })

        let _costos = dataCostos.concat(costosEliminados);

        let args = [];
        args["endpoint"] = api_url+"/empresarial/v1/cotizacion/"+getInput('idCotizacion')+"/detalle";
        args["method"] = "PUT";
        args["bodyType"] = "json";
        args["showLoader"] = true;
        args["data"] = JSON.stringify({
            // "codigoCliente": parseInt(cliente),
            // "codigoTipoContrato": parseInt(tipoServicio),
            // "codigoEmpresa":parseInt($('#centroMedico option:selected').attr('codigoEmpresa-rel')),
            // "codigoSucursal": parseInt(centroMedico),
            // "direccionServicio": detalleLugar,
            // "fechaInicio": fechaPrevista,
            // "cantidadDias": parseInt(diasServicio),
            "porcentajeRentabilidad": parseFloat(th_cotizacion),
            "observacion": getInput('observacion'),
            "ciudades":ciudadesArr,
            "detalle": dataPrestacionesTmp,
            "costosAdicionales": _costos
        });

        const data = await call(args);
        if(data.code == 200){
            $('#btn-crear-cotizacion').prop('disabled',false);
            showMessage('success','Atención',"Cotización actualizada");
            location.href = '/cotizador/consulta-cotizaciones';
        }else{
            showMessage('warning','Atención',data.message);
            $('#btn-crear-cotizacion').prop('disabled',false);
        }
    }

    function formatDollar(numero){
        if(numero == 0){
            return numero;
        }
        let numStr = numero.toString().replace(/^0+/, '');
        let numeroRedondeado = parseFloat(numStr).toFixed(2);
        let partes = numeroRedondeado.split('.');
        partes[0] = partes[0].replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Agregar comas para separación de miles
        let numeroFormateado = partes.join('.');
        return numeroFormateado;
    }

    function calcularTH(){
        /*TH = ((Sumatoria Total del campo Precio Total - Sumatoria Total de todos los Costos) / Sumatoria Total del campo Precio Total ) *100*/
        let totales = 0;
        let total_costos = 0;
        if(dataPrestaciones.length > 0){
            $.each(dataCostos, function(key, value){
                //totales += value.valorUnitario;
                total_costos += value.valorUnitario;
            });

            $.each(dataPrestaciones, function(key, value){
                $.each(value.grupos, function(k, v){
                    $.each(v.prestaciones, function(k1, v1){
                        let costo_alterno = obtenerCostoPorId(v1.codigoPrestacion);
                        if( costo_alterno == null){
                            total_costos += (v1.costoUnitario*v1.cantidadPacientes);
                        }else{
                            // console.log("Costo alterno")
                            total_costos += (costo_alterno*v1.cantidadPacientes);
                        }
                        totales += (v1.precioUnitario*v1.cantidadPacientes);
                    })
                })
            })


            /*$.each(dataPrestaciones, function(key, value){
                $.each(value.prestaciones, function(k, v){
                    let costo_alterno = obtenerCostoPorId(v.codigoPrestacion);
                    if( costo_alterno == null){
                        total_costos += (v.costoUnitario*v.cantidadPacientes);
                    }else{
                        // console.log("Costo alterno")
                        total_costos += (costo_alterno*v.cantidadPacientes);
                    }
                    totales += (v.precioUnitario*v.cantidadPacientes);
                });
            });*/

            // console.log(totales, total_costos)

            let t_h = (((totales - total_costos) / totales ) * 100);
            $('#t_h').html("TH: "+t_h.toFixed(2)+"%");
            $('#t_h').removeClass('bg-danger').removeClass('bg-warning').removeClass('bg-success');
            if(t_h >= 20){
                $('#t_h').addClass('bg-success');
            }else{
                $('#t_h').addClass('bg-danger');
            }
            th_cotizacion = t_h.toFixed(2);
        }
    }

    // Función para escapar las comillas dobles en el valor del atributo
    function escapeAttributeValue(value) {
        return value.replace(/"/g, '\\"');
    }

    async function buscarCliente(){
        if($('#searchInput').val().length > 0){
            let args = [];
            let tipoFiltro = "nombreCliente_razonSocial";
            if(sonNumeros($('#searchInput').val())){
                tipoFiltro = "numeroIdentificacion";
            }
            args["endpoint"] = api_url+"/comercial/v1/clientes?page=1&perPage=100&estado=TODOS&infoEmpresarial=true&tipoFiltro="+tipoFiltro+"&valorFiltro="+$('#searchInput').val();
            args["method"] = "GET";
            args["bodyType"] = "json";
            args["showLoader"] = true;
            
            $('#box-clientes-list').empty();
            $('#box-info-cliente').addClass('d-none');
            $('#nombreCliente').html('');
            $('#numeroIdentificacion').html('');
            $('#tipoPersona').html('');
            $('#clienteSearch').html('');

            $('#cliente').val('');
            $('#cliente').attr("cliente-rel",'');

            $('#entidadAfiliada').empty().trigger('change');

            const data = await call(args);
            // console.log(data);
            if(data.data.totalRows == 0 ){
                showMessage('warning','Atención','No se encontró información de Clientes con esos datos')
            }else if(data.data.totalRows == 1) {
                $('#nombreCliente').html(data.data.row[0].nombreCliente);
                $('#numeroIdentificacion').html(data.data.row[0].numeroIdentificacion);
                $('#tipoPersona').html(data.data.row[0].nombreTipoPersona);
                $('#box-info-cliente').removeClass('d-none');
                $('#cliente').val(data.data.row[0].codigoCliente);
                $('#cliente').attr("cliente-rel",JSON.stringify(data.data.row[0]));
                $('#localidad').empty();
                $.each(data.data.row[0].localidades,function(key, value){
                    $('#localidad').append(`<option class="localidad-item" codigoCiudad-rel="${value.codigoPais}-${value.codigoProvincia}-${value.codigoCiudad}" nombreCiudad-rel="${value.nombreCiudad}" value="${value.secuenciaLocalidad}">${value.nombreLocalidad}</option>`);
                })
                obtenerEntidadesAfiliadas();
            }else{
                let elem;
                $('#clienteSearch').html($('#searchInput').val() +" ("+data.data.totalRows+" clientes encontrados)");
                $.each(data.data.row, function(key, value){
                    let data_attr = JSON.stringify(value);
                    data_attr = data_attr.replace(/'/g, "");
                    elem += `<tr>
                                <td class="fs-12">${value.numeroIdentificacion}</td>
                                <td class="fs-12">${value.nombreCliente}</td>
                                <td class="fs-12">${value.nombreTipoPersona}</td>
                                <td class="fs-12">
                                    <button type="button" data-rel='${data_attr}'s class="btn btn-sm bg-veris btn-seleccionar-cliente">Seleccionar</button>
                                </td>
                            </tr>`;
                })
                $('#box-clientes-list').append(elem);
                modalCliente.show();
            }
        }
    }

    async function obtenerCiudades(){
        let args = [];
        args["endpoint"] = api_url+"/general/v1/ciudades?codigoPais=1";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;

        $('#ciudadChequeo').empty();
        $('#ciudadChequeo').append(`<option value=""></option>`);
        const data = await call(args);
        $.each(data.data, function(key, value){
            $('#ciudadChequeo').append(`<option value="${value.codigoPais}-${value.codigoProvincia}-${value.codigoCiudad}">${value.nombreCiudad}</option>`);
        })
    }

    async function obtenerCentralesMedicas(){
        let args = [];
        args["endpoint"] = api_url+"/general/v1/sucursales?codigoEmpresa=1&tipoSucursal=TODOS&grupoSucursal=CMV";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;
        $('#centroMedico').empty();
        $('#centroMedico').append(`<option value=""></option>`);
        const data = await call(args);
        $.each(data.data, function(key, value){
            $('#centroMedico').append(`<option value="${value.codigoSucursal}" codigoEmpresa-rel="${value.codigoEmpresa}">${value.nombreSucursal}</option>`);
        })
    }

    async function obtenerTiposContrato(){
        let args = [];
        args["endpoint"] = api_url+"/comercial/v1/tipos_contratos?codigoTipoProducto=2&estado=ACTIVO";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;
        $('#tipoServicio').empty();
        $('#tipoServicio').append(`<option value=""></option>`);
        const data = await call(args);
        $.each(data.data, function(key, value){
            if(value.esActivo){
                $('#tipoServicio').append(`<option value="${value.codigoTipoContrato}">${value.nombreTipoContrato}</option>`);
            }
        })
    }

    async function obtenerGruposPerfiles(){
        let args = [];
        args["endpoint"] = api_url+"/comercial/v1/convenios/niveles_cobertura?page=1&perPage=100&nemonicoTipoCredito=CREDITO_LISTA_PRESTACIONES&tipoFiltro=nombreNivelCobertura&valorFiltro=&estado=ACTIVO";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;
        $('#grupoPerfil').empty();
        const data = await call(args);
        $.each(data.data.rows, function(key, value){
            if(value.activo){
                $('#grupoPerfil').append(`<option value="${value.codigoNivel}">${value.nombreNivel}</option>`);
            }
        })
    }

    async function obtenerNivel1(){
        let args = [];
        args["endpoint"] = api_url+"/comercial/v1/convenios/consulta_servicios_primer_nivel/?idTarifario=1-1-4";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;

        const data = await call(args);
        let elem = "";
        $.each(data.data, function(key, value){
            let _class = '';
            if(key == 0){
                _class = 'item-selected';
            }
            elem += `<li codigoServicio-rel='${value.codigoServicio}' class="swiper-slide ${_class}">
                <i class="fa-solid fa-stethoscope me-2"></i>${value.nombreServicio}</li>`;
        })
        $('#list-nivel-1').append(elem);

        swiper = new Swiper(".swiper-container", {
            slidesPerView: "auto",
            // centeredSlides: true,
            // centeredSlidesBounds: true,
            // loop: verificarLoop(),
            freeMode: {
                enabled: true,
                sticky: true,
            },
            spaceBetween: 10,
            mousewheel: true,
            navigation: {
                prevEl: '.swiper-button-prev',
                nextEl: '.swiper-button-next'
            },
            on: {
                init: function() {
                    swiperCenter(this);
                },
                resize: function() {
                    swiperCenter(this);
                }
            }
        });
    }

    function swiperCenter(swiperInstance) {
        let contenedorItems = $('.swiper-container').width();
        let itemsWidth = 0;
        $('#list-nivel-1').removeClass('justify-content-center');
        $('.swiper-button-white').show();
        $('.swiper-wrapper li').each(function(key, value) {
            itemsWidth += $(this).outerWidth(true);
            // itemsWidth += 15;
        })

        if(contenedorItems > itemsWidth){
            $('#list-nivel-1').addClass('justify-content-center');
            $('.swiper-button-white').hide();
        }
    }

    async function obtenerPrestaciones(){
        let args = [];
        args["endpoint"] = api_url+"/comercial/v1/tarifarios/1-1-4/detalle/?idTarifario=1-1-4&incluirPrestacionesNoParametrizadas=false";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;

        const data = await call(args);
        let elem = "";

        $.each(data.data, function(key, value){
            $.each(value.servicios, function(k, v){
                $.each(v.servicios, function(k1, v1){
                    elem = "";
                    // elem += `<div class="col-12 col-md-6 col-lg-6 col-xl-4 mb-2 pt-1 pb-1 servicio servicio-${ value.codigoServicio }">
                    elem += `<div class="item mb-2 pt-1 pb-1 servicio servicio-${ value.codigoServicio }" id="box-servicio-${ v1.codigoServicio }">
                            <div class="shadow bg-white prestaciones-item">
                            <div class="card shadow-none">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="card-title mb-0">
                                        <h6 class="mb-0 text-white">${ v1.nombreServicio }</h6>
                                    </div>
                                </div>
                                <div class="card-body content">
                                    <ul class="p-0 m-0">`
                    $.each(v1.prestaciones, function(k2, v2){
                        elem += `       <li class="mb-1 d-flex align-items-center">
                                            <input type="checkbox" id="ck_prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="me-2 ck-input-prestacion">
                                            <label for="ck_prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="flex-fill fs-10">${ v2.nombrePrestacion }</label>
                                            <div title="Cantidad" class="align-self-start input-group input-price ms-2">
                                                <span class="input-group-text ps-1 pe-1 pt-1 pb-1 fw-bold"><i class="fa-solid fa-hashtag"></i></span>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" step="1" id="prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="form-control text-center fs-12 ps-1 pe-1 input-prestacion input_${v1.codigoServicio}_${ v2.codigoPrestacion }" placeholder="" codigoServicio-rel="${v1.codigoServicio}" nombreServicio-rel='${value.nombreServicio}' prestacion-rel='${JSON.stringify(v2)}'>
                                            </div>
                                            <!--div title="Precio" class="align-self-start input-group input-price ms-2">
                                                <span class="input-group-text ps-1 pe-1 pt-1 pb-1 fw-bold"><i class="fa-solid fa-dollar-sign"></i></span>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" id="price_prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="form-control text-center fs-12 ps-1 pe-1 input-prestacion price_input_${v1.codigoServicio}_${ v2.codigoPrestacion }" placeholder="" codigoServicio-rel="${v1.codigoServicio}" nombreServicio-rel='${value.nombreServicio}' prestacion-rel='${JSON.stringify(v2)}' value="${v2.pvpBaseOriginal}">
                                            </div-->
                                        </li>`;
                    })
                    elem += `           </ul>
                                    </div>
                                </div>
                                </div>
                            </div>`;
                    $('#box-prestaciones').append(elem);

                    // window.addEventListener("resize", resizeAllGridItems);
                    var resizeTimer;

                    window.addEventListener("resize", function() {
                        clearTimeout(resizeTimer);
                        resizeTimer = setTimeout(resizeAllGridItems, 1000); // Ajusta el tiempo de espera según tus necesidades (en milisegundos)
                    });

                    $('.input-prestacion').attr("disabled",true);
                    $('#btn-prestaciones').prop('disabled', false);
                      
                })
            });
            /*$('.prestaciones-item').each(function() {
                new PerfectScrollbar(this);
            });*/
        })
    }
/*
var tableHtml = '<table>';

// Create header rows
tableHtml += '<tr>';
tableHtml += '<th>Ciudad</th>';
data.forEach(function(ciudad) {
    tableHtml += '<th colspan="' + ciudad.prestaciones.length * 2 + '">' + ciudad.nombreCiudad + '</th>';
});
tableHtml += '</tr>';

tableHtml += '<tr>';
tableHtml += '<th>Prestadores</th>';
data.forEach(function(ciudad) {
    ciudad.prestaciones.forEach(function(prestacion) {
        tableHtml += '<th colspan="2">' + prestacion.nombrePrestacion + '</th>';
    });
});
tableHtml += '</tr>';

tableHtml += '<tr>';
tableHtml += '<th></th>';
data.forEach(function(ciudad) {
    ciudad.prestaciones.forEach(function(prestacion) {
        tableHtml += '<th>Prestador</th>';
        tableHtml += '<th>Precio</th>';
    });
});
tableHtml += '</tr>';

// Populate data
var maxPrestadores = Math.max(...data.map(ciudad => ciudad.prestaciones.reduce((max, p) => Math.max(max, p.prestadores.length), 0)));

for (var i = 0; i < maxPrestadores; i++) {
    tableHtml += '<tr>';
    data.forEach(function(ciudad) {
        var prestacion = ciudad.prestaciones[i];
        if (i === 0) {
            tableHtml += '<td rowspan="' + prestacion.prestadores.length + '">' + ciudad.nombreCiudad + '</td>';
        }
        var prestador = prestacion.prestadores[i];
        if (prestador) {
            tableHtml += '<td>' + prestador.nombreInstitucion + '</td>';
            tableHtml += '<td>' + (prestador.valorCosto ? prestador.valorCosto : '---') + '</td>';
        } else if (i === 0) {
            tableHtml += '<td rowspan="' + maxPrestadores + '">---</td>';
            tableHtml += '<td rowspan="' + maxPrestadores + '"></td>';
        }
    });
    tableHtml += '</tr>';
}

tableHtml += '</table>';

$('#tableContainer').html(tableHtml);
*/
    function drawTablePrestadores(data){
        let dataGrouped = agruparDatos(data)
        
        if(dataGrouped.length > 0){
            /*$('#box-prestadores').empty();
            $.each(dataGrouped, function(key, value){
                let elem = ``;
                let tr_second = ``;
                let colspan = getMaxDepth(value);
                elem += `<div class="table-responsive mb-3"><table class="table">`
                elem += `<thead>
                            <tr>
                                <th colspan="${colspan}" class="text-center">${value.nombrePrestacion}</th>
                            </tr>
                            <tr class="tr_second text-center tr_ciudad_${value.codigoPrestacion}">
                            </tr>
                        </thead>
                        <tbody>`;
                $.each(value.listadoCiudades, function(k, v){
                    tr_second += `<th colspan=${v.listadoPrestadores.length}>${v.nombreCiudad}</th>`;
                    elem += `<tr">`;
                    $.each(v.listadoPrestadores, function(k1, v1){
                        elem += `<td>
                            <label class="fs-12 fw-bold label-prestador mb-2">${v1.nombreInstitucion}</label>
                            <div class="w-100 d-flex align-items-center">
                                <input type="checkbox" id="ck_prestacion_costo_${value.codigoPrestacion}_${v1.idInstitucion}_${ v.codigoCiudad }" class="me-2 ck-input-prestacion-costo ck_prestacion_costo_${value.codigoPrestacion}" value="${v1.valorCosto}" data-idPrestacion="${value.codigoPrestacion}">
                                <label for="ck_prestacion_costo_${value.codigoPrestacion}_${v1.idInstitucion}_${ v.codigoCiudad }" class="flex-fill fs-10">$${ formatDollar(v1.valorCosto) }</label>
                            </div>
                        </td>`;
                    })
                    elem += `</tr">`;
                })
                elem += `<tbody>
                    </table></div>`;
                
                $('#box-prestadores').append(elem);
                $('.tr_ciudad_'+value.codigoPrestacion).append(tr_second);
            })*/

            let institucionesArr = [];
            let theader = `<tr><th class="fs-12">Ciudades</th>`;
            $.each(data.data, function(key, value){
                let total = 0;
                let existenPrestadores = false;
                $.each(value.prestaciones, function(k,v){
                    $.each(v.prestadores, function(k1,v1){
                        if(!institucionesArr.includes(value.codigoCiudad+"_"+v1.idInstitucion)){
                            total++;
                            existenPrestadores = true;
                            institucionesArr.push(value.codigoCiudad+"_"+v1.idInstitucion);
                        }
                    })
                    //total += v.prestadores.length;
                })
                if(existenPrestadores){
                    theader += `<th class="fs-12 text-center" colspan="${total}">${value.nombreCiudad}</th>`;
                }
            })
            institucionesArr = [];
            theader += `</tr>
                        <tr class="tr_second"><th class="fs-12">Prestadores</th>`;
            $.each(data.data, function(key, value){
                $.each(value.prestaciones, function(k,v){
                    $.each(v.prestadores, function(k1,v1){
                        if(!institucionesArr.includes(value.codigoCiudad+"_"+v1.idInstitucion)){
                            theader += `<th class="fs-12 text-center" id="th_${value.codigoCiudad+"_"+v1.idInstitucion}">${v1.nombreInstitucion}</th>`
                            institucionesArr.push(value.codigoCiudad+"_"+v1.idInstitucion);
                        }
                    })
                })
            })
            theader += `</tr>`;
            $('#box-prestadores-list-th').html(theader);

            //institucionesArr = []; 
            let prestacionesArr = []
            let tbody = ``;
            $.each(data.data, function(key, value){
                $.each(value.prestaciones, function(k,v){
                    if(!prestacionesArr.includes(v.codigoPrestacion)){
                        tbody += `<tr id="tr_prestacion_${v.codigoPrestacion}">`;
                        tbody += `<td>${v.nombrePrestacion}</td>`;
                        prestacionesArr.push(v.codigoPrestacion);
                        tbody += getTds(v.codigoPrestacion, dataGrouped);
                        tbody += '<tr>';
                    }
                })
            })
            $('#box-prestadores-list').html(tbody);
            asignTdCostos(dataGrouped);
            $('#modalPrestadores').modal('show');
        }else{
            showMessage('warning','Atención',"La prestación seleccionada no tiene prestadores externos asociados.");
        }
    }

    function getTds(codigoPrestacion, dataGrouped){
        var maxThPrestadores = $('#box-prestadores-list-th .tr_second th').length - 1;
        let elemTd = ``;
        for(var i=0; i<maxThPrestadores; i++){
            elemTd += `<td id="prestacion_${codigoPrestacion}_${i+1}">---</td>`;
        }
        return elemTd;
    }

    function asignTdCostos(dataGrouped){
        $.each(dataGrouped, function(key,value){
            $.each(value.listadoCiudades, function(k, v){
                $.each(v.listadoPrestadores, function(k1, v1){
                    let thId = 'th_'+v.codigoCiudad+"_"+v1.idInstitucion; // Cambia esto al id que estés buscando
                    let position = $('#box-prestadores-list-th .tr_second th#' + thId).index();
                    let isChecked = "";
                    if(existeItemPorIdentificador(costosPrestadores,v.codigoCiudad+"_"+v1.idInstitucion+"_"+value.codigoPrestacion)){
                        isChecked = "checked";
                    }

                    let elem = `<div class="w-100 d-flex align-items-center">
                                    <input type="checkbox" id="ck_prestacion_costo_${value.codigoPrestacion}_${v1.idInstitucion}_${ v.codigoCiudad }" identificador-rel="${v.codigoCiudad}_${v1.idInstitucion}_${value.codigoPrestacion}" class="me-2 ck-input-prestacion-costo ck_prestacion_costo_${value.codigoPrestacion}" value="${v1.valorCosto}" data-idPrestacion="${value.codigoPrestacion}" ${isChecked}>
                                    <label for="ck_prestacion_costo_${value.codigoPrestacion}_${v1.idInstitucion}_${ v.codigoCiudad }" class="flex-fill fs-10">$${ formatDollar(v1.valorCosto) }</label>
                                </div>`;
                    $('#prestacion_'+value.codigoPrestacion+'_'+position).html(elem);
                })
            })
        })
    }

    function existeItemPorIdentificador(array, identificador) {
        return array.some(function(item) {
            return item.identificador === identificador;
        });
    }

    function getMaxDepth(data){
        let max = 0;
        $.each(data.listadoCiudades, function(key,value) {
            max += value.listadoPrestadores.length;
        })
        return max;
    }

    function agruparDatos(data) {
        let dataPrestadores = []
        $.each(data.data, function(key,value) {
            $.each(value.prestaciones, function(k,v){
                $.each(v.prestadores, function(k1,v1){
                    dataPrestadores.push({
                        "nombreInstitucion":v1.nombreInstitucion,
                        "idInstitucion":v1.idInstitucion,
                        "valorCosto":v1.valorCosto,
                        "aplicaIva":v1.aplicaIva,
                        "nombrePrestacion":v.nombrePrestacion,
                        "codigoPrestacion":v.codigoPrestacion,
                        "nombreCiudad":value.nombreCiudad,
                        "codigoCiudad":value.codigoCiudad
                    })
                })
            })
        })

        const resultado = [];
        const auxData = {};

        dataPrestadores.forEach((item) => {
            const { codigoPrestacion, nombrePrestacion, nombreCiudad, codigoCiudad, nombreInstitucion, idInstitucion, valorCosto, aplicaIva } = item;

            if (!auxData[codigoPrestacion]) {
                auxData[codigoPrestacion] = {
                    codigoPrestacion,
                    nombrePrestacion,
                    listadoCiudades: [],
                };
                resultado.push(auxData[codigoPrestacion]);
            }

            const indexCiudad = auxData[codigoPrestacion].listadoCiudades.findIndex((ciudad) => ciudad.codigoCiudad === codigoCiudad);

            if (indexCiudad === -1) {
                auxData[codigoPrestacion].listadoCiudades.push({
                    nombreCiudad,
                    codigoCiudad,
                    listadoPrestadores: [{ nombreInstitucion, idInstitucion, valorCosto, aplicaIva }],
                });
            } else {
                auxData[codigoPrestacion].listadoCiudades[indexCiudad].listadoPrestadores.push({ nombreInstitucion, idInstitucion, valorCosto, aplicaIva });
            }
        });

        return resultado;
    }

    function resizeGridItem(item){
        let extendible = 2;
        if($(window).width() <= 600){
            extendible = 2
        }
        grid = document.getElementsByClassName("grid")[0];
        rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
        rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
        rowSpan = Math.ceil((item.querySelector('.content').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
        item.style.gridRowEnd = "span "+(rowSpan + extendible);
    }

    function resizeAllGridItems(){
        allItems = document.getElementsByClassName("item");
        for(x=0;x<allItems.length;x++){
            resizeGridItem(allItems[x]);
        }
    }

    function resizeInstance(instance){
        item = instance.elements[0];
        resizeGridItem(item);
    }

    async function showModalPrestadores(){
        obtenerPrestadores();
    }

    async function getCiudadesDeLocalidades(){
        let ciudadesArr = [];
        $.each(dataPrestaciones, function(key,value){
            if($.inArray(value.codigoCiudad, ciudadesArr) === -1){
                ciudadesArr.push(value.codigoCiudad)
            }
        })
        return ciudadesArr;
    }

    async function obtenerPrestadores(id = null){
        //let ciudades = getInput('ciudadChequeo','select2');
        let ciudades = await getCiudadesDeLocalidades();
        if(ciudades == ""){
            showMessage('warning','Atención',"Debe elegir una ciudad del listado.");
            return;
        }
        let prestaciones = [];
        if(id == null){
            $.each(dataPrestaciones, function(key, value){
                $.each(value.grupos, function(k, v){
                    $.each(v.prestaciones, function(k1, v1){
                        let id = v1.codigoPrestacion;
                        if ($.inArray(id, prestaciones) !== -1) {
                            var indice = $.inArray(id, prestaciones);
                            prestaciones[indice] = id;
                        } else {
                            prestaciones.push(id);
                        }
                    })
                })
            })
        }else{
            prestaciones.push(id);
        }

        let args = [];
        args["endpoint"] = api_url+"/empresarial/v1/util/costos_prestadores?codigoEmpresa=1";
        args["method"] = "POST";
        args["bodyType"] = "json";
        args["showLoader"] = false;
        args["data"] = JSON.stringify({
            "ciudades": ciudades,
            "prestaciones": prestaciones
        })

        const data = await call(args);
        // console.log(data);
        drawTablePrestadores(data);
    }

    async function obtenerEntidadesAfiliadas(){
        $('#entidadAfiliada').empty().trigger('change');
        let args = [];
        args["endpoint"] = api_url+"/comercial/v1/entidadesAfiliadas/entidades_por_cliente?page=1&perPage=100&estado=ACTIVO&codigoCliente="+getInput('cliente');
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;

        const data = await call(args);
        
        $.each(data.data.rows, function(key, value){
            // console.log(value);
            $('#entidadAfiliada').append(`<option value="${value.codigoEntidadAfiliada}">${value.nombreEntidadAfiliada}</option>`);
        })

        $('#entidadAfiliada').trigger('change');
    }

    async function obtenerServiciosCostos(){
        let args = [];
        args["endpoint"] = api_url+"/empresarial/v1/util/costos_adicionales?estado=ACTIVO";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;

        const data = await call(args);
        let elem = "";
        // console.log(data)

        $('#servicioCosto').append(`<option value=""></option>`);
        $.each(data.data, function(key, value){
            let descripcion = "";
            if(value.descripcion != null){
                descripcion = value.descripcion;
            }
            $('#servicioCosto').append(`<option value="${value.idCosto}" title="${descripcion}">${value.nombreCosto}</option>`);
        })
    }

    function obtenerCostoPorId(idPrestacion) {
        // Utilizamos el método find() para buscar el objeto que tenga el idPrestacion específico
        let prestacionEncontrada = costosPrestadores.find(function(prestacion) {
            return prestacion.idPrestacion === idPrestacion;
        });

        // Si encontramos la prestación, devolvemos su costo; de lo contrario, devolvemos null o un valor predeterminado
        return prestacionEncontrada ? prestacionEncontrada.costo : null;
    }

    function search(){
        let searchInput = document.getElementById('searchInputPrestacion');

        searchInput.addEventListener('input', function(event) {
            let cards = $('#box-prestaciones .item').filter(':visible');
            if(getInput('searchInputPrestacion').length > 0){
                cards.each(function(index, item) {
                    let cardId = item.id;
                    let searchText = event.target.value.toLowerCase();
                    let qty = 0;
                    // console.log(cardId)
                    let labels = $('#'+cardId + ' label');
                    // console.log(labels)
                    labels.each(function(index, label) {
                        let labelContent = label.textContent.toLowerCase();
                        //let codRel = label.getAttribute('cod-rel');
                        if (labelContent.includes(searchText) ) {
                            qty++;
                            $(label).parent().show();
                        } else {
                            $(label).parent().hide();
                        }
                    });
                    
                    if(qty == 0){
                        $('#'+cardId).hide();
                    }else{
                        $('#'+cardId).show();
                    }
                })
            }else{
                $('#box-prestaciones .item li').show();
                $('.servicio-'+$('.item-selected').attr('codigoServicio-rel')).show();
                resizeAllGridItems();
            }
        });
    }

    function showPrestaciones(){
        $('.servicio').hide();
        $('.servicio-'+$('.item-selected').attr('codigoServicio-rel')).show();
        resizeAllGridItems();
    }

    async function agregarComentario(idComentario = null){
        $('#btnAgregarComentario').prop('disabled',true);
        @if(isset($edit))
        idComentario = {{ $data->idCotizacion }};
        @endif
        let args = [];
        args["endpoint"] = api_url+"/empresarial/v1/comentarios?idCotizacion="+idComentario;
        args["method"] = "POST";
        args["bodyType"] = "json";
        args["showLoader"] = true;
        args["data"] = JSON.stringify({
            "comentario": getInput('nuevoComentario'),
        });

        const data = await call(args);
        $('#btnAgregarComentario').prop('disabled',false);
        if(data.code == 200){
            $('#nuevoComentario').val("").trigger("change")
            //showMessage('success','Atención',"Comentario agregado");
            loadComentarios();
        }else{
            showMessage('warning','Atención',data.message);
            $('#btn-crear-cotizacion').prop('disabled',false);
        }
    }

    async function loadComentarios(){
        let idCotizacion = getInput('idCotizacion');
        let args = [];
        args["endpoint"] = api_url+"/empresarial/v1/comentarios?idCotizacion="+idCotizacion;
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = true;
        const data = await call(args);
        let numeroComentarios = 0;
        if(data.code == 200){
            let elem = ``;
            let comentarios = data.data;
            comentarios.sort((a, b) => a.secuenciaComentario - b.secuenciaComentario);
            numeroComentarios = comentarios.length;
            $.each(comentarios, function(key, value){
                elem += `<div class="row rounded pt-2 pb-2 ps-1 pe-1 mb-1 fs-12">
                    <div class="col-6 fw-bold fs-10 mb-2">${value.usuarioIngreso}</div>
                    <div class="col-6 text-end fs-10 mb-2"><span class="badge bg-light text-dark fw-bold">${calcularTiempoTranscurrido(value.fechaIngreso)}</span></div>
                    <div class="col-12">${value.comentario}</div>
                </div>`;
            })
            if(numeroComentarios == 0){
                $('.box-comentarios').html(`<div class="row bg-white rounded pt-2 pb-2 ps-1 pe-1 mb-1 fs-12">
                    <div class="col-12 fw-bold text-center mb-2">No existen comentarios que mostrar</div></div>`);
            }else{
                $('.box-comentarios').html(elem);
            }
        }else{
            showMessage('warning','Atención',data.message);
        }

        $('#numeroComentarios').html(numeroComentarios);
    }

    function calcularTiempoTranscurrido(fecha) {
        // Convierte la fecha proporcionada en formato "dd/mm/yyyy hh:mm" en un objeto Date
        const fechaIngreso = new Date(fecha.replace(/(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2})/, '$3-$2-$1T$4:$5'));

        // Obtiene la fecha actual
        const fechaActual = new Date();

        // Calcula la diferencia en milisegundos
        const diferencia = fechaActual - fechaIngreso;

        // Calcula el tiempo transcurrido en minutos, horas, días, meses y años
        const minutos = Math.floor(diferencia / (1000 * 60));
        const horas = Math.floor(diferencia / (1000 * 60 * 60));
        const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        const meses = Math.floor(diferencia / (1000 * 60 * 60 * 24 * 30.44)); // Asumiendo un promedio de 30.44 días por mes
        const anos = Math.floor(diferencia / (1000 * 60 * 60 * 24 * 365.25)); // Asumiendo un año bisiesto cada 4 años

        // Determina y devuelve el tiempo transcurrido en el formato deseado
        if (anos > 0) {
            return `Hace ${anos} ${anos === 1 ? 'año' : 'años'}`;
        } else if (meses > 0) {
            return `Hace ${meses} ${meses === 1 ? 'mes' : 'meses'}`;
        } else if (dias > 0) {
            return `Hace ${dias} ${dias === 1 ? 'día' : 'días'}`;
        } else if (horas > 0) {
            return `Hace ${horas} ${horas === 1 ? 'hora' : 'horas'}`;
        } else {
            return `Hace ${minutos} ${minutos === 1 ? 'minuto' : 'minutos'}`;
        }
    }
</script>
<style>
    textarea{
        resize: none;
    }

    .box-comentarios .row:nth-child(even) {
        background: rgb(192 192 192 / 10%);
    }

    .box-comentarios .row:nth-child(odd) {
        background: rgb(164 114 58 / 10%);
    }

    .item-selected {
        background: rgb(97 145 234 / 20%) !important;
        color: #3962e6 !important;
    }

    .scroll-btn:hover{
        opacity: 0.8;
    }

    .swiper-container {
      width: 100%;
      height: 50px;
      overflow: hidden;
    }
    
    .swiper-container {
        width: 100%;
        /*border: 1px solid #dbdade;*/
    }

    .swiper-slide {
        cursor: pointer;
        padding: 0.9rem !important;
        width: auto !important;
        background: rgb(219 224 228 / 50%);
        border: 1px solid #DBE0E4;
        color: #8B97A3;
        border-radius: 25px;
        font-size: 13px;
        font-weight: bold;
    }

    .swiper-slide-active2 {
        background-color: #95D5B2;
        border-radius: 25px;
    }

    .swiper-container ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .swiper-container a {
        color: black;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        width: 100%;
        height: 100%;
    }

    .swiper-button-next {
        right: -5px;
        top: 35px;
        color: #3962e6 !important;
        /*opacity: 1 !important;*/
    }

    .swiper-button-prev {
        left: -5px;
        top: 35px;
        color: #3962e6 !important;
        /*opacity: 1 !important;*/
    }

    .swiper-button-prev.custom-icon::after, 
    .swiper-button-next.custom-icon::after{
        font-size: 16px;
    }

    .input-price{
        width: 85px;
        flex-shrink: 0;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
    .servicio {
        display: none;
    }
    .prestaciones-item .card-body{
        max-height: 400px;
        overflow: hidden;
        overflow-y: auto;
    }

    ul.typeahead {
        margin: 0px;
        padding: 10px 0px;
    }

    ul.typeahead.dropdown-menu li a {
        padding: 10px !important;
        border-bottom: #CCC 1px solid;
        color: #FFF;
    }

    ul.typeahead.dropdown-menu li:last-child a {
        border-bottom: 0px !important;
    }

    #busquedaCliente:hover {
        color: #3962e6;
        cursor: pointer;
    }

    .box-row-modal-clientes{
        max-height: 400px;
        overflow: hidden;
        overflow-y: auto;
    }

    .modal-fullscreen .modal-body{
        overflow-x: hidden;
    }

    .sticky-top {
        position: sticky;
        top: 0;
        background-color: #fff; /* Opcional: si deseas un fondo blanco para el encabezado */
        z-index: 999; /* Opcional: si deseas que el encabezado esté por encima de otros elementos */
    }

    div.card-datatable [class*=col-md-]{
        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    .grid {
        display: grid;
        grid-gap: 10px;
        grid-template-columns: repeat(auto-fill, minmax(400px,1fr));
        grid-auto-rows: 20px;
    }

    .prestaciones-item input[type="number"] {
        padding-top: 3px;
        padding-bottom: 3px;
    }
    .prestaciones-item label{
        line-height: 14px;
        color: #5E5E5D;
    }

    .tr_second th {
        background: #3962E61A !important;
        color: #171D49 !important;
        border-radius: 0px !important;
    }

    #box-prestadores th, #box-prestadores td {
        border-left: 1px solid silver;
        border-right: 1px solid silver;
    }

    #box-prestadores th:first-child, #box-prestadores td:first-child {
        border-left: 0;
    }

    #box-prestadores th:last-child, #box-prestadores td:last-child {
        border-right: 0;
    }

    .label-prestador{
        min-height: 30px;
    }

    .input-group i{
        font-size: 10px !important;
    }

    .tr_costo_0{
        background: rgb(255 0 0 / 10%) !important;
    }

    @media only screen and (max-width: 600px) {
        .grid {
            display: grid;
            grid-gap: 10px;
            grid-template-columns: repeat(auto-fill, minmax(100%,1fr));
            grid-auto-rows: 20px;
        }
    }

</style>
@endsection


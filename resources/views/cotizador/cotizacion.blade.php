@extends('template.dashboard')
@section('title')
    Veris - Cotizacion
@endsection
@section('title-section')
    Cotizador
@endsection

@section('content')
    <div class="row mb-3">
    <!-- Accordion with Icon -->
        <div class="col-md mb-4 mb-md-2">
            <div class="accordion mt-3" id="accordionWithIcon">
                <div class="card accordion-item active">
                    <h2 class="accordion-header d-flex align-items-center">
                        <button type="button"
                            class="accordion-button text-primary"
                            data-bs-toggle="collapse"
                            data-bs-target="#accordionWithIcon-1"
                            aria-expanded="true">
                        Paso1. Seccion de Cliente
                        </button>
                    </h2>
                    <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <div class="input-group input-group-merge">
                                        <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Buscar"
                                        aria-label="Search..."
                                        aria-describedby="busquedaCliente"
                                        />
                                        <span class="input-group-text" id="busquedaCliente"><i class="ti ti-search"></i></span>
                                    </div>
                                    <label for="busquedaCliente" class="form-label mt-3">Unicomer del Ecuador S.A</label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="text">Ruc: </label>
                                            <label for="ruc">092561470001</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="text">Razón Social: </label>
                                            <label for="razonSocial">Unicomer dEL Ecuador S.A.</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="text">Usuario Creador: </label>
                                            <label for="usuarioCreador">Usuario2</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="button" id="continuarFormulario" class="btn bg-veris">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item card">
                    <h2 class="accordion-header d-flex align-items-center">
                        <button
                        type="button"
                        class="accordion-button collapsed text-primary"
                        data-bs-toggle="collapse"
                        data-bs-target="#accordionWithIcon-2"
                        aria-expanded="false"
                        >
                        Paso 2. Selección de tipos de servicios
                        </button>
                    </h2>
                    <div id="accordionWithIcon-2" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="tipoServicio" class="form-label">¿Qué servico deseas cotizar?</label>
                                    <div class="select2-dark">
                                        <select id="tipoServicio" class="select2 form-select" multiple>
                                            <option value="1" >Servicio de chequeo Ocupacional</option>
                                            <option value="2" >Servicio de chequeo Preocupacional</option>
                                            <option value="3">Servicio de chequeo Postocupacional</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="lugarServicio" class="form-label">¿Dónde deseas el servico?</label>
                                    <div class="select2-dark">
                                        <select id="lugarServicio" class="select2 form-select" multiple>
                                            <option value="1" >En el lugar de la empresa</option>
                                            <option value="2" >En el centro medico Veris</option>
                                            <option value="3">Otros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="detalleLugar" class="form-label">Por favor detallar el lugar</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="detalleLugar"
                                        placeholder=""
                                        />
                                </div>
                                <div class="col-12 text-end">
                                    <button type="button" id="continuarFormulario" class="btn btn-primary">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item card">
                    <h2 class="accordion-header d-flex align-items-center">
                        <button
                        type="button"
                        class="accordion-button collapsed text-primary"
                        data-bs-toggle="collapse"
                        data-bs-target="#accordionWithIcon-3"
                        aria-expanded="false"
                        >
                        Paso 3. Planificación del Chequeo
                        </button>
                    </h2>
                    <div id="accordionWithIcon-3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="inicioChequeo" class="form-label">¿Cuándo deseas que inicie el chequeo?</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="date" value="2021-06-18" id="inicioChequeo" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="diasServicio" class="form-label">¿En cuántos días quieres que finalice el servicio?</label>
                                    <input
                                    type="text"
                                    class="form-control text-center"
                                    id="diasServicio"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 text-end">
                                    <button type="button" id="continuarFormulario" class="btn btn-primary">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item card">
                    <h2 class="accordion-header d-flex align-items-center">
                        <button
                            type="button"
                            class="accordion-button collapsed text-primary"
                            data-bs-toggle="collapse"
                            data-bs-target="#accordionWithIcon-4"
                            aria-expanded="false"
                        >
                        Paso 4. Selección del grupo de Perfil
                        </button>
                    </h2>
                    <div id="accordionWithIcon-4" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12 text-end">
                                    <button
                                        type="button"
                                        class="btn btn-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalNuevoGrupo"
                                        title="Agregar Grupo"
                                        >
                                        Agregar Grupos
                                    </button>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-datatable table-responsive">
                                            <table class="dt-multilingual table">
                                                <thead>
                                                    <tr>
                                                        <th>Razón de Grupo</th>
                                                        <th>Descriptión</th>
                                                        <th>Origen Creado</th>   
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item card">
                    <h2 class="accordion-header d-flex align-items-center">
                        <button
                            type="button"
                            class="accordion-button collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#accordionWithIcon-5"
                            aria-expanded="false"
                        >
                        Paso 5. Cotización
                        </button>
                    </h2>
                    <div id="accordionWithIcon-5" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            
                        </div>
                    </div>
                </div>
                <div class="accordion-item card">
                    <h2 class="accordion-header d-flex align-items-center">
                        <button
                            type="button"
                            class="accordion-button collapsed"
                            data-bs-toggle="collapse"
                            data-bs-target="#accordionWithIcon-6"
                            aria-expanded="false"
                        >
                        Paso 6. Resumen de la Cotización
                        </button>
                    </h2>
                    <div id="accordionWithIcon-6" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Accordion with Icon -->
    <!-- MODAL GIRO NEGOCIO -->
    <!-- Modal -->
    <div class="modal fade" id="modalNuevoGrupo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Agregar Grupos</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="input-group input-group-merge">
                                <input
                                type="text"
                                class="form-control"
                                placeholder="Buscar"
                                aria-label="Search..."
                                aria-describedby="busquedaCliente"
                                />
                                <span class="input-group-text" id="busquedaCliente"><i class="ti ti-search"></i></span>
                            </div>
                        </div>
                        <div class="col-12 mb-3 text-center">
                            <div class="row">
                                <label for="nombreGrupo"> Nombre el grupo: Grupo A</label>
                                <label for="numMiembrosServicio" class="form-label">¿Para cuántos miembros deseas el servicio?</label>
                            </div>
                            <input
                            type="text"
                            id="numMiembrosServicio"
                            class="form-control"
                            placeholder=""
                            />
                        </div>
                    </div>
                </div>
                <div class="modal-footer"> 
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary">Agregar</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


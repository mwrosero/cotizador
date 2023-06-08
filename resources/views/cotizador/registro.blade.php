@extends('dashboard')
@extends('panels/sidebar')

@section('title')
    Veris-Registro
@endsection
@section('content')

    <h4 class="fw-bold"> Registrar Empresa</h4>
    <h5 class="fw-bold">Agregar clientes en tu cartera de ventas</h5>
    <div class="row">
        <div class="col-12">
            <div class="accordion mt-3" id="formRegistro">
                <div class="card accordion-item active">
                    <h2 class="accordion-header d-flex align-items-center">
                        <button
                        type="button"
                        class="accordion-button"
                        data-bs-toggle="collapse"
                        data-bs-target="#formRegistro-1"
                        aria-expanded="true"
                        >
                        <span>Paso 1.</span> Datos de la Empresa
                        </button>
                    </h2>
                    <div id="formRegistro-1" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="ruc" class="form-label">Ruc</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="ruc"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="codigoCiiu" class="form-label">Código CIIU</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="codigoCiiu"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="razonSocial" class="form-label">Razón Social</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="razonSocial"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-11 col-sm-5 col-md-3 mb-3">
                                    <label for="giroNegocio" class="form-label">Giro de Negocio</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="giroNegocio"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-1 col-sm-1 col-md-1 pt-4 mb-3">
                                    <button
                                        type="button"
                                        class="btn btn-primary w-100"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalGiroNegocio"
                                        title="Agregar"
                                        >
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="grupoEmpresa" class="form-label">Grupo de Empresa 
                                        <i type="button"
                                            class="fa-solid fa-circle-info"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Si la empresa  no pertenece  a ningún grupo asociado por favor  dejelo vacio">
                                        </i>
                                    </label>
                                    <select id="grupoEmpresa" class="form-select w-100" data-style="btn-default">
                                      <option>Lorem</option>
                                      <option>lorem</option>
                                      <option>lorem</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="tipoEmpresa" class="form-label">Tipo de Empresa</label>
                                    <select id="tipoEmpresa" class="form-select w-100" data-style="btn-default">
                                      <option>Natural</option>
                                      <option>Natural</option>
                                      <option>Natural</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="razonCoemrcial" class="form-label">Razón Comercial</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="razonCoemrcial"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="representacionLegal" class="form-label">Representación Legal</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="representacionLegal"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="razonSocial2" class="form-label">Razón Social</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="razonSocial2"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-primary">Continuar</button>
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
                        data-bs-target="#formRegistro-2"
                        aria-expanded="true"
                        >
                        Paso 2. Datos de contacto
                        </button>
                    </h2>
                    <div id="formRegistro-2" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="telefonoEmpresa" class="form-label">Teléfono Empresa</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="telefonoEmpresa"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="correoEmpresa" class="form-label">Correo Empresa</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="correoEmpresa"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="personaContacto" class="form-label">Persona Contacto</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="personaContacto"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="telefonoContacto" class="form-label">Teléfono Contacto</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="telefonoContacto"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="correoContacto" class="form-label">Correo Contacto</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="correoContacto"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <label for="cargoPersonaContacto" class="form-label">Cargo Persona Contacto</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="cargoPersonaContacto"
                                    placeholder=""
                                    />
                                </div>
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-primary">Crear Empresa</button>
                                    <button type="button" class="btn btn-outline-primary">Continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL GIRO NEGOCIO -->
    <!-- Modal -->
    <div class="modal fade" id="modalGiroNegocio" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Registrar Giro de Negocio</h5>
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
                            <label for="gironNegocio" class="form-label">Giro de Negocio</label>
                            <input type="text" id="gironNegocio" class="form-control" placeholder="" />
                        </div>
                        <div class="col-12 mb-3">
                            <label for="descripcionGiroNegocio" class="form-label">Descripción</label>
                            <input
                            type="text"
                            id="descripcionGiroNegocio"
                            class="form-control"
                            placeholder=""
                            />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary ">Guardar</button>
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection


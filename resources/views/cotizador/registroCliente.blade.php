@extends('template.dashboard')
@section('title')
    Veris - Registro Cliente
@endsection
@section('title-section')
    Registro Cliente
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <form class="card-body" id="form-registro" action="/guardar-empresa" method="POST">
                    <h6>1. Datos de la Empresa</h6>
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="ruc" class="form-label">Ruc</label>
                            <input type="text"
                            class="form-control"
                            id="ruc"
                            name="ruc" 
                            placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="codigoCiiu" class="form-label">Código CIIU</label>
                            <input type="text"
                            class="form-control"
                            id="codigoCiiu"
                            name="codigoCiiu" 
                            placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="razonSocial" class="form-label">Razón Social</label>
                            <input type="text"
                            class="form-control"
                            id="razonSocial"
                            name="razonSocial" 
                            placeholder="" />
                        </div>
                        <div class="col-11 col-sm-5 col-md-3 mb-3">
                            <label for="giroNegocio" class="form-label">Giro de Negocio</label>
                            <input type="text"
                            class="form-control"
                            id="giroNegocio"
                            name="giroNegocio" 
                            placeholder="" />
                        </div>
                        <div class="col-1 col-sm-1 col-md-1 pt-4 mb-3">
                            <button type="button"
                                class="btn bg-veris w-100"
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
                            <select id="grupoEmpresa" name="grupoEmpresa" class="form-select select2 w-100" data-style="btn-default">
                                <option>Lorem</option>
                                <option>lorem</option>
                                <option>lorem</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="tipoEmpresa" class="form-label">Tipo de Empresa</label>
                            <select id="tipoEmpresa" name="tipoEmpresa" class="form-select select2 w-100" data-style="btn-default">
                                <option value="N">Natural</option>
                                <option value="J">Juridica</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="razonComercial" class="form-label">Razón Comercial</label>
                            <input type="text"
                            class="form-control"
                            id="razonComercial"
                            name="razonComercial"
                            placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="representacionLegal" class="form-label">Representación Legal</label>
                            <input type="text"
                            class="form-control"
                            id="representacionLegal"
                            name="representacionLegal"
                            placeholder=""/>
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6>2. Datos de Contacto</h6>
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="telefonoEmpresa" class="form-label">Teléfono Empresa</label>
                            <input
                            type="text"
                            class="form-control"
                            id="telefonoEmpresa"
                            name="telefonoEmpresa"
                            placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="correoEmpresa" class="form-label">Correo Empresa</label>
                            <input
                            type="text"
                            class="form-control"
                            id="correoEmpresa"
                            name="correoEmpresa"
                            placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="personaContacto" class="form-label">Persona Contacto</label>
                            <input
                            type="text"
                            class="form-control"
                            id="personaContacto"
                            name="personaContacto"
                            placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="telefonoContacto" class="form-label">Teléfono Contacto</label>
                            <input
                            type="text"
                            class="form-control"
                            id="telefonoContacto"
                            name="telefonoContacto"
                            placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="correoContacto" class="form-label">Correo Contacto</label>
                            <input
                            type="text"
                            class="form-control"
                            id="correoContacto"
                            name="correoContacto"
                            placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 mb-3">
                            <label for="cargoPersonaContacto" class="form-label">Cargo Persona Contacto</label>
                            <input
                            type="text"
                            class="form-control"
                            id="cargoPersonaContacto"
                            name="cargoPersonaContacto"
                            placeholder=""/>
                        </div>
                        <div class="col-12 text-end">
                            <button type="button" class="btn bg-veris">Crear Empresa</button>
                        </div>
                    </div>
                </form>
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
                    <button type="button" class="btn bg-veris">Guardar</button>
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection


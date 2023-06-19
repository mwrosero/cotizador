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
                    <h6 class="txt-veris">Datos de la Empresa</h6>
                    {{-- <i class="fa-regular fa-building f-12"></i> --}}
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="ruc" class="form-label">Ruc</label>
                            <input type="number"
                                inputmode="numeric" 
                                pattern="[0-9]*"
                                step="1"
                                class="form-control"
                                id="ruc"
                                name="ruc" 
                                required 
                                placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="codigoCiiu" class="form-label">Código CIIU</label>
                            <input type="number"
                                inputmode="numeric" 
                                pattern="[0-9]*"
                                step="1"
                                class="form-control"
                                id="codigoCiiu"
                                name="codigoCiiu" 
                                required 
                                placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="razonSocial" class="form-label">Razón Social</label>
                            <input type="text"
                                class="form-control"
                                id="razonSocial"
                                name="razonSocial" 
                                required 
                                placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="tipoPersona" class="form-label">Tipo de Persona</label>
                            <select id="tipoPersona" name="tipoPersona" required class="form-select select2 w-100" data-style="btn-default">
                                <option value="N">Natural</option>
                                <option value="J">Juridica</option>
                            </select>
                        </div>
                        <div class="col-10 col-sm-5 col-md-3">
                            <label for="giroNegocio" class="form-label">Giro de Negocio</label>
                            <select id="giroNegocio" name="giroNegocio" required class="form-select select2 w-100" data-style="btn-default">
                            </select>
                        </div>
                        <div class="col-2 col-sm-1 col-md-1 pt-4">
                            <button type="button"
                                class="btn bg-veris w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#modalGiroNegocio"
                                title="Agregar"
                                >
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="grupoEmpresa" class="form-label">Grupo de Empresa 
                                <i type="button"
                                    class="fa-solid fa-circle-info"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="right"
                                    title="Si la empresa  no pertenece  a ningún grupo asociado por favor  dejelo vacio">
                                </i>
                            </label>
                            <select id="grupoEmpresa" name="grupoEmpresa" required class="form-select select2 w-100" data-style="btn-default">
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="razonComercial" class="form-label">Razón Comercial</label>
                            <input type="text"
                                class="form-control"
                                id="razonComercial"
                                name="razonComercial"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="representacionLegal" class="form-label">Representación Legal</label>
                            <input type="text"
                                class="form-control"
                                id="representacionLegal"
                                name="representacionLegal"
                                required 
                                placeholder=""/>
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="txt-veris">Datos de Contacto</h6>
                    {{-- <i class="fa-regular fa-id-badge"></i> --}}
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="telefonoEmpresa" class="form-label">Teléfono Empresa</label>
                            <input type="number"
                                inputmode="numeric" 
                                pattern="[0-9]*"
                                step="1"
                                class="form-control"
                                id="telefonoEmpresa"
                                name="telefonoEmpresa"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="correoEmpresa" class="form-label">Correo Empresa</label>
                            <input type="email"
                                class="form-control"
                                id="correoEmpresa"
                                name="correoEmpresa"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="personaContacto" class="form-label">Persona Contacto</label>
                            <input type="text"
                                class="form-control"
                                id="personaContacto"
                                name="personaContacto"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="telefonoContacto" class="form-label">Teléfono Contacto</label>
                            <input type="number"
                                inputmode="numeric" 
                                pattern="[0-9]*"
                                step="1"
                                class="form-control"
                                id="telefonoContacto"
                                name="telefonoContacto"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="correoContacto" class="form-label">Correo Contacto</label>
                            <input type="email"
                                class="form-control"
                                id="correoContacto"
                                name="correoContacto"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="cargoPersonaContacto" class="form-label">Cargo Persona Contacto</label>
                            <input type="text"
                                class="form-control"
                                id="cargoPersonaContacto"
                                name="cargoPersonaContacto"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn bg-veris">Crear Empresa</button>
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
                            <label for="giroNegocioNuevo" class="form-label">Giro de Negocio</label>
                            <input type="text" id="giroNegocioNuevo" class="form-control" placeholder="" />
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
    <script>
        window.onload = async () => {
            obtenerGirosNegocio();
            obtenerGrupoEmpresa();
        }

        async function obtenerGirosNegocio(){
            let args = [];
            args["endpoint"] = api_url+"/empresarial/v1/util/giros_negocio?estado=ACTIVO";
            args["method"] = "GET";
            args["bodyType"] = "json";
            args["showLoader"] = false;

            const data = await call(args);
            $('#giroNegocio').empty();
            $.each(data.data, function(key, value){
                $('#giroNegocio').append(`<option value="${value.idGiroNegocio}">${value.nombreGiro}</option>`);
            })
        }

        async function obtenerGrupoEmpresa(){
            let args = [];
            args["endpoint"] = api_url+"/empresarial/v1/util/grupos_empresa?estado=ACTIVO";
            args["method"] = "GET";
            args["bodyType"] = "json";
            args["showLoader"] = false;

            const data = await call(args);
            $('#grupoEmpresa').empty();
            // $('#grupoEmpresa').append(`<option value="">No asociado</option>`);
            $.each(data.data, function(key, value){
                $('#grupoEmpresa').append(`<option value="${value.idGrupoEmpresa}">${value.nombreGrupo}</option>`);
            })
        }

        
    </script>
@endsection


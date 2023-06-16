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
                <h6 class="txt-veris">Seleccionar Cliente</h6>
                <div class="row g-3">
                    <div class="col-11 col-md-6">
                        <div class="input-group input-group-merge">
                            <input type="text"
                                class="form-control"
                                placeholder="Buscar"
                                aria-label="Search..."
                                aria-describedby="infoCliente"/>
                            <span class="input-group-text" id="busquedaCliente"><i class="ti ti-search"></i></span>
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
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-6 col-md-4">
                                <label class="form-label fs-12">Cliente</label>
                                <p>Michael Rosero Peralta</p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
                                <label class="form-label fs-12">Cédula/RUC</label>
                                <p>0923796304001</p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4">
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
                            </div>
                        </div>                            
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <h6 class="txt-veris">Tipos de Servicios</h6>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="tipoServicio" class="form-label">¿Qué servico deseas cotizar?</label>
                        <div class="select2-dark">
                            <select id="tipoServicio" class="select2 form-select" multiple>
                                <option value="1" >Ocupacional</option>
                                <option value="2" >Pre-Ocupacional</option>
                                <option value="3">Post-Ocupacional</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="lugarServicio" class="form-label">¿Dónde deseas el servico?</label>
                        <div class="select2-dark">
                            <select id="lugarServicio" class="select2 form-select" multiple>
                                <option value="1" >En el lugar de la empresa</option>
                                <option value="2" >En el centro medico Veris</option>
                                <option value="3">Otros</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="centroMedico" class="form-label">Centrales Médicas</label>
                        <div class="select2-dark">
                            <select id="centroMedico" class="select2 form-select" multiple>
                                <option value="1" >Mall del Sol</option>
                                <option value="2" >CC El Dorado</option>
                                <option value="3">Kennedy</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="detalleLugar" class="form-label">Por favor detallar el lugar</label>
                        <input type="text"
                            class="form-control"
                            id="detalleLugar"
                            placeholder="" />
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <h6 class="txt-veris">Planificación del Chequeo</h6>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="inicioChequeo" class="form-label">¿Cuándo deseas que inicie el chequeo?</label>
                        <input type="date" 
                            class="form-control" 
                            id="inicioChequeo"/>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="diasServicio" class="form-label">¿En cuántos días quieres que finalice el servicio?</label>
                        <input type="text"
                            class="form-control"
                            id="diasServicio"
                            placeholder=""/>
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <h6 class="txt-veris">Prestaciones</h6>
                <div class="row g-3">
                    <div class="col-12">
                        <button type="button"
                            id="btn-prestaciones"
                            class="btn bg-veris"
                            data-bs-toggle="modal"
                            data-bs-target="#modalPrestaciones"
                            title="Seleccionar Prestaciones"
                            >
                            <i class="fa-solid fa-laptop-medical me-2"></i>
                            Seleccionar Prestaciones
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PRESTACIONES -->
<!-- Modal -->
<div class="modal fade" id="modalPrestaciones" aria-labelledby="modalPrestacionesLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        {{-- <div class="modal-dialog modal-fullscreen modal-fullscreen-md-down"> --}}
        <div class="modal-content p-2">
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            <div class="modal-header">
                <div class="col-12">
                    <label for="grupoPerfil" class="form-label">Grupo Perfil</label>
                    <div class="select2-dark">
                        <select id="grupoPerfil" class="select2 form-select">
                            <option value="1" >Grupo 1</option>
                            <option value="2" >Grupo 2</option>
                            <option value="3" >Grupo 3</option>
                            <option value="4" >Grupo 4</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-body">
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
        obtenerNivel1();
    }

    async function obtenerNivel1(){
        let args = [];
        args["endpoint"] = api_url+"/comercial/v1/convenios/consulta_servicios_primer_nivel/?idTarifario=1-1-4";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;

        const data = await call(args);
        console.log(data);
        $.each(data.data, function(key, value){
        })
    }
</script>
@endsection


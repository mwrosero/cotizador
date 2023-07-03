@extends('template.dashboard')
@section('title')
    Veris - Registro Cliente
@endsection
@section('title-section')
    Registro Cliente
@endsection
@section('content')
    <div class="row">
        @if ($errors->any())
        <div class="col-12">
            <div class="alert alert-danger">
                Error al crear Cliente, verifique los datos e intente nuevamente
            </div>
        </div>
        @endif
        <div class="col-12">
            <div class="card mb-4">
                <form class="card-body" id="form-registro" action="/cotizador/crear-cliente" method="POST">
                    <h6 class="txt-veris">Datos de la Empresa</h6>
                    @csrf
                    <input type="hidden" name="codigoTipoIdentificacion" value="1">
                    {{-- <i class="fa-regular fa-building f-12"></i> --}}
                    <?php /*dd($cliente);*/ ?>
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="numeroIdentificacion" class="form-label">Ruc<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <input type="number"
                                inputmode="numeric" 
                                pattern="[0-9]*"
                                step="1"
                                minlength="13"
                                maxlength="13"
                                size="13" 
                                class="form-control"
                                id="numeroIdentificacion"
                                name="numeroIdentificacion" 
                                value="{{ old('numeroIdentificacion', isset($cliente) ? $cliente->datosCliente->numeroIdentificacion : '') }}"
                                required 
                                placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="codigoCiiu" class="form-label">Código CIIU<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <input type="number"
                                inputmode="numeric" 
                                pattern="[0-9]*"
                                step="1"
                                class="form-control"
                                id="codigoCiiu"
                                name="codigoCiiu" 
                                value="{{ old('codigoCiiu', '' ) }}"
                                required 
                                placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="razonSocial" class="form-label">Razón Social<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <input type="text"
                                class="form-control"
                                id="razonSocial"
                                name="razonSocial" 
                                value="{{ old('razonSocial', isset($cliente) ? $cliente->datosCliente->razonSocial : '' ) }}"
                                required 
                                placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="tipoPersona" class="form-label">Tipo de Persona<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <select id="tipoPersona" name="tipoPersona" required class="form-select select2 w-100" data-style="btn-default">
                                <option value="N">Natural</option>
                                <option value="J">Juridica</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="razonComercial" class="form-label">Razón Comercial<span class="badge badge-sm bg-info fs-8 ms-1">Opcional</span></label>
                            <input type="text"
                                class="form-control"
                                id="razonComercial"
                                name="razonComercial"
                                value="{{ old('razonComercial', isset($cliente) ? $cliente->datosCliente->nombreComercial : '' ) }}"
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="representanteLegal" class="form-label">Representante Legal<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <input type="text"
                                class="form-control"
                                id="representanteLegal"
                                name="representanteLegal"
                                value="{{ old('representanteLegal', '' ) }}"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-10 col-sm-5 col-md-3">
                            <label for="giroNegocio" class="form-label">Giro de Negocio<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <select id="giroNegocio" name="giroNegocio" required class="form-select select2 w-100" data-style="btn-default">
                            </select>
                        </div>
                        <div class="col-2 col-sm-1 col-md-1 pt-4">
                            <button type="button"
                                class="btn bg-veris w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#modalGiroNegocio"
                                title="Agregar">
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
                                <span class="badge badge-sm bg-info fs-8 ms-1">Opcional</span>
                            </label>
                            <select id="grupoEmpresa" name="grupoEmpresa" class="form-select select2 w-100" data-style="btn-default">
                            </select>
                        </div>
                        <div class="col-10 col-sm-5 col-md-3">
                            <label for="esGrupoEmpresa" class="form-label">Es Grupo Empresa<span class="badge badge-sm bg-info fs-8 ms-1">Opcional</span></label>
                            <div class="form-check form-switch mb-2 mt-2">
                                <input class="form-check-input" type="checkbox" id="esGrupoEmpresa" name="esGrupoEmpresa" />
                            </div>
                            </select>
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="txt-veris">Datos de Localidad</h6>
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="pais" class="form-label">País<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <select id="pais" name="pais" required class="form-select select2 w-100" data-style="btn-default">
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="provincia" class="form-label">Provincia<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <select id="provincia" name="provincia" required class="form-select select2 w-100" data-style="btn-default">
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="ciudad" class="form-label">Ciudad<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <select id="ciudad" name="ciudad" required class="form-select select2 w-100" data-style="btn-default">
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="direccion" class="form-label">Dirección<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <input type="text"
                                class="form-control"
                                id="direccion"
                                name="direccion"
                                value="{{ old('direccion', isset($cliente) ? $cliente->datosResidencia->direccion : '' ) }}"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="correoEmpresa" class="form-label">Correo Empresa<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <input type="email"
                                class="form-control"
                                id="correoEmpresa"
                                name="correoEmpresa"
                                value="{{ old('correoEmpresa', isset($cliente) ? $cliente->datosContacto->correoElectronico : '' ) }}"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="telefonoMovilOficina" class="form-label">Teléfono Celular Oficinas<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <div class="row">
                                <div class="col-4 col-sm-6 col-md-6 col-lg-4">
                                    <select id="telefonoMovilOficinaCode" name="telefonoMovilOficinaCode" required class="form-select select2 w-100 fs-12" data-style="btn-default">
                                    </select>
                                </div>
                                <div class="col-8 col-sm-6 col-md-6 col-lg-8">
                                    <input type="number"
                                        inputmode="numeric" 
                                        pattern="[1-9][0-9]{8}"
                                        oninput="removeLeadingZero(this,9)"
                                        step="1"
                                        class="form-control"
                                        id="telefonoMovilOficina"
                                        name="telefonoMovilOficina"
                                        value="{{ old('telefonoMovilOficina', isset($cliente) ? $cliente->datosContacto->telefonoCelular : '' ) }}"
                                        required 
                                        placeholder=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="telefonoFijoOficina" class="form-label">Teléfono Fijo Oficinas<span class="badge badge-sm bg-info fs-8 ms-1">Opcional</span></label>
                            <div class="row">
                                <div class="col-4 col-sm-6 col-md-6 col-lg-4">
                                    <select id="telefonoFijoOficinaCode" name="telefonoFijoOficinaCode" required class="form-select select2 w-100 fs-12" data-style="btn-default">
                                    </select>
                                </div>
                                <div class="col-8 col-sm-6 col-md-6 col-lg-8">
                                    <input type="number"
                                        inputmode="numeric" 
                                        pattern="[1-9][0-9]{8}"
                                        oninput="removeLeadingZero(this,8)"
                                        step="1"
                                        class="form-control"
                                        id="telefonoFijoOficina"
                                        name="telefonoFijoOficina"
                                        value="{{ old('telefonoFijoOficina', isset($cliente) ? $cliente->datosContacto->telefonoConvencional : '' ) }}"
                                        placeholder=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="txt-veris">Datos de Contacto</h6>
                    {{-- <i class="fa-regular fa-id-badge"></i> --}}
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="personaContacto" class="form-label">Nombre Contacto<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <input type="text"
                                class="form-control"
                                id="personaContacto"
                                name="personaContacto"
                                value="{{ old('personaContacto', isset($cliente) ? $cliente->datosContacto->contactoCliente : '' ) }}"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="telefonoMovilContacto" class="form-label">Teléfono Celular Contacto<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <div class="row">
                                <div class="col-4 col-sm-6 col-md-6 col-lg-4">
                                    <select id="telefonoMovilContactoCode" name="telefonoMovilContactoCode" required class="form-select select2 w-100 fs-12" data-style="btn-default">
                                    </select>
                                </div>
                                <div class="col-8 col-sm-6 col-md-6 col-lg-8">
                                    <input type="number"
                                        inputmode="numeric" 
                                        pattern="[1-9][0-9]{8}"
                                        oninput="removeLeadingZero(this,9)"
                                        step="1"
                                        class="form-control"
                                        id="telefonoMovilContacto"
                                        name="telefonoMovilContacto"
                                        value="{{ old('telefonoMovilContacto', isset($cliente) ? $cliente->datosContacto->telefonoCelular : '' ) }}"
                                        required 
                                        placeholder=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="telefonoFijoContacto" class="form-label">Teléfono Fijo Contacto<span class="badge badge-sm bg-info fs-8 ms-1">Opcional</span></label>
                            <div class="row">
                                <div class="col-4 col-sm-6 col-md-6 col-lg-4">
                                    <select id="telefonoFijoContactoCode" name="telefonoFijoContactoCode" class="form-select select2 w-100 fs-12" data-style="btn-default">
                                    </select>
                                </div>
                                <div class="col-8 col-sm-6 col-md-6 col-lg-8">
                                    <input type="number"
                                        inputmode="numeric" 
                                        pattern="[1-9][0-9]{8}"
                                        oninput="removeLeadingZero(this,8)"
                                        step="1"
                                        class="form-control"
                                        id="telefonoFijoContacto"
                                        name="telefonoFijoContacto"
                                        value="{{ old('telefonoFijoContacto', isset($cliente) ? $cliente->datosContacto->telefonoConvencional : '' ) }}"
                                        placeholder=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="correoContacto" class="form-label">Correo Contacto<span class="badge badge-sm bg-warning fs-8 ms-1">Requerido</span></label>
                            <input type="email"
                                class="form-control"
                                id="correoContacto"
                                name="correoContacto"
                                value="{{ old('correoContacto', isset($cliente) ? $cliente->datosContacto->correoElectronico : '' ) }}"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="cargoPersonaContacto" class="form-label">Cargo Contacto<span class="badge badge-sm bg-info fs-8 ms-1">Opcional</span></label>
                            <input type="text"
                                class="form-control"
                                id="cargoPersonaContacto"
                                name="cargoPersonaContacto"
                                value="{{ old('cargoPersonaContacto', '' ) }}"
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
                    <button type="button" class="btn bg-veris" onclick="crearGiroNegocio();">Crear</button>
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let modalGiroNegocio;
        window.onload = async () => {
            modalGiroNegocio = new bootstrap.Modal('#modalGiroNegocio');

            await obtenerGirosNegocio();
            await obtenerGrupoEmpresa();

            await cargarPaises();
            await cargarProvincias();
            //await cargarCiudades();

            $('body').on('change','#pais',function(){
                cargarProvincias();
            });

            $('body').on('change','#provincia',function(){
                cargarCiudades();
            });

            let tipoPersona = "{{ old('tipoPersona', isset($cliente) ? $cliente->datosCliente->tipoPersona : '' ) }}";
            if(tipoPersona != ""){
                $('#tipoPersona').val(tipoPersona).trigger('change');
            }

            let giroNegocio = "{{ old('giroNegocio', '' ) }}";
            if(giroNegocio != ""){
                $('#giroNegocio').val(giroNegocio).trigger('change');
            }

            let grupoEmpresa = "{{ old('grupoEmpresa', '' ) }}";
            if(grupoEmpresa != ""){
                $('#grupoEmpresa').val(grupoEmpresa).trigger('change');
            }
            
            let pais = "{{ old('pais', isset($cliente) ? $cliente->datosResidencia->codigoPais : '' ) }}";
            if(pais != ""){
                $('#pais').val(pais).trigger('change');
                let provincia = "{{ old('provincia', isset($cliente) ? $cliente->datosResidencia->codigoProvincia : '' ) }}";
                if(provincia != ""){
                    $('#provincia').val(provincia).trigger('change');
                    let ciudad = "{{ old('ciudad', isset($cliente) ? $cliente->datosResidencia->codigoCiudad : '' ) }}";
                }
            }
        }

        async function crearGiroNegocio(){
            if(getInput('giroNegocioNuevo').length > 0){
                let args = [];
                args["endpoint"] = api_url+"/empresarial/v1/util/giros_negocio";
                args["method"] = "POST";
                args["bodyType"] = "json";
                args["showLoader"] = true;
                args["data"] = JSON.stringify({
                    "nombreGiro": getInput('giroNegocioNuevo'),
                    "observacion": getInput('descripcionGiroNegocio')
                });

                const data = await call(args);
                modalGiroNegocio.hide();
                obtenerGirosNegocio();
            }else{
                showMessage('warning','Atención','El Nombre del Giro de Negocio es obligatorio')
            }
        }

        async function cargarPaises(){
            let args = [];
            args["endpoint"] = api_url+"/general/v1/paises";
            args["method"] = "GET";
            args["bodyType"] = "json";
            args["showLoader"] = false;

            const data = await call(args);
            $('#pais').empty();
            $('#telefonoMovilOficinaCode').empty();
            $('#telefonoFijoOficinaCode').empty();
            $('#telefonoMovilContactoCode').empty();
            $('#telefonoFijoContactoCode').empty();
            $.each(data.data, function(key, value){
                var classSel = "";
                if(value.esDefault){
                    classSel = "selected";
                }
                $('#pais').append(`<option value="${value.codigoPais}" ${classSel}>${value.nombrePais}</option>`);
                $('#telefonoMovilOficinaCode').append(`<option title='${value.nombrePais}' value="${value.codigoPais}" ${classSel}>${value.codigoISO}</option>`);
                $('#telefonoFijoOficinaCode').append(`<option title='${value.nombrePais}' value="${value.codigoPais}" ${classSel}>${value.codigoISO}</option>`);
                $('#telefonoMovilContactoCode').append(`<option title='${value.nombrePais}' value="${value.codigoPais}" ${classSel}>${value.codigoISO}</option>`);
                $('#telefonoFijoContactoCode').append(`<option title='${value.nombrePais}' value="${value.codigoPais}" ${classSel}>${value.codigoISO}</option>`);
            })
        }

        async function cargarProvincias(){
            let args = [];
            args["endpoint"] = api_url+"/general/v1/provincias?codigoPais="+getInput('pais');
            args["method"] = "GET";
            args["bodyType"] = "json";
            args["showLoader"] = false;

            const data = await call(args);
            $('#provincia').empty();
            $.each(data.data, function(key, value){
                var classSel = "";
                if(value.esDefault){
                    classSel = "selected";
                }
                $('#provincia').append(`<option value="${value.codigoProvincia}" ${classSel}>${value.nombreProvincia}</option>`);
            });
            cargarCiudades();
        }

        async function cargarCiudades(){
            let args = [];
            args["endpoint"] = api_url+"/general/v1/ciudades?codigoPais="+getInput('pais')+"&codigoProvincia="+getInput('provincia');
            args["method"] = "GET";
            args["bodyType"] = "json";
            args["showLoader"] = false;

            const data = await call(args);
            $('#ciudad').empty();
            $.each(data.data, function(key, value){
                var classSel = "";
                if(value.esDefault){
                    classSel = "selected";
                }
                $('#ciudad').append(`<option value="${value.codigoCiudad}" ${classSel}>${value.nombreCiudad}</option>`);
            })
        }

        async function obtenerGirosNegocio(){
            let args = [];
            args["endpoint"] = api_url+"/empresarial/v1/util/giros_negocio?estado=ACTIVO";
            args["method"] = "GET";
            args["bodyType"] = "json";
            args["showLoader"] = false;

            const data = await call(args);
            $('#giroNegocio').empty();
            $('#giroNegocio').append(`<option value="---">No asociado</option>`);
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
            $('#grupoEmpresa').append(`<option value="---">No asociado</option>`);
            $.each(data.data, function(key, value){
                $('#grupoEmpresa').append(`<option value="${value.idGrupoEmpresa}">${value.nombreGrupo}</option>`);
            })
        }

        /*HEPERS*/
        function getInput(idElem, type = 'input'){
            let valor;
            switch(type){
                case 'input':
                case 'select':
                    valor = document.getElementById(idElem).value
                break;
                case 'radio':
                    valor = $("input[name='"+idElem+"']:checked").val();
                break;
                case 'fecha':
                    valor = document.getElementById(idElem)._flatpickr.getDate();
                break;
                case 'hora':
                    valor = document.getElementById(idElem)._flatpickr.getDate();
                break;
                case 'select2':
                    //console.log(value);
                    valor = $('#'+idElem).val();
                break;
                case 'button':
                    // console.log("."+idElem+".active");
                    $("."+idElem+".active").attr("id-rel");
                break;
                case 'checkbox':
                    // console.log('#'+idElem)
                    valor = "I";
                    if($('#'+idElem).is(":checked")){
                        valor = "A";
                    }
                break;
            }
            return valor;
        }

        
    </script>
@endsection


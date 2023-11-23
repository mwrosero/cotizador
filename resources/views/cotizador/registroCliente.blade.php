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
                {{-- Error al crear Cliente, verifique los datos e intente nuevamente --}}
                @if (session()->has('mensaje'))
                    {{ session('mensaje') }}
                @endif
            </div>
        </div>
        @endif
        <div class="col-12">
            <div class="card mb-4">
                @if(isset($edit) && $edit === true)
                <form class="card-body" id="form-registro" action="/cotizador/actualizar-cliente" method="POST">
                    <input type="hidden" name="codigoCliente" id="codigoCliente" value="{{ $codigoCliente }}">
                    @if(isset($cliente->infoEmpresarial->contactoEmpresarial))
                    <input type="hidden" name="idContacto" id="idContacto" value="{{ $cliente->infoEmpresarial->contactoEmpresarial->idContacto }}">
                    @else
                    <input type="hidden" name="idContacto" id="idContacto" value="null">
                    @endif
                @else
                <form class="card-body" id="form-registro" action="/cotizador/crear-cliente" method="POST">
                @endif
                    <h6 class="txt-veris">Datos de la Empresa</h6>
                    @csrf
                    <input type="hidden" name="codigoTipoIdentificacion" value="1">
                    {{-- <i class="fa-regular fa-building f-12"></i> --}}
                    <?php /*dd($cliente);*/ ?>
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="numeroIdentificacion" class="form-label">Ruc<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                            <input type="number"
                                inputmode="numeric" 
                                pattern="[1-9][0-9]{13}"
                                oninput="maxLengthNumber(this,13)"
                                step="1"
                                minlength="13"
                                maxlength="13"
                                size="13" 
                                class="form-control"
                                id="numeroIdentificacion"
                                name="numeroIdentificacion" 
                                value="{{ old('numeroIdentificacion', isset($cliente) ? $cliente->datosCliente->numeroIdentificacion : '') }}"
                                @if(isset($edit) && $edit === true)
                                readonly
                                @else
                                required
                                @endif
                                placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="codigoCiiu" class="form-label">Código CIIU<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                            <input type="text"
                                class="form-control"
                                id="codigoCiiu"
                                name="codigoCiiu" 
                                value="{{ old('codigoCiiu', isset($cliente) ? $cliente->infoEmpresarial->codigoCiiu : '') }}"
                                required 
                                placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="razonSocial" class="form-label">Razón Social<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                            <input type="text"
                                class="form-control"
                                id="razonSocial"
                                name="razonSocial" 
                                value="{{ old('razonSocial', isset($cliente) ? $cliente->datosCliente->razonSocial : '' ) }}"
                                required 
                                placeholder="" />
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="tipoPersona" class="form-label">Tipo de Persona<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                            <select id="tipoPersona" name="tipoPersona" required class="form-select select2 w-100" data-style="btn-default">
                                <option value="N">Natural</option>
                                <option value="J">Juridica</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="razonComercial" class="form-label">Razón Comercial</label>
                            <input type="text"
                                class="form-control"
                                id="razonComercial"
                                name="razonComercial"
                                value="{{ old('razonComercial', isset($cliente) ? $cliente->datosCliente->nombreComercial : '' ) }}"
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="representanteLegal" class="form-label">Representante Legal<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                            <input type="text"
                                class="form-control"
                                id="representanteLegal"
                                name="representanteLegal"
                                value="{{ old('representanteLegal', isset($cliente) ? $cliente->infoEmpresarial->representanteLegal : '' ) }}"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-10 col-sm-5 col-md-3">
                            <label for="giroNegocio" class="form-label">Giro de Negocio<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
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
                                
                            </label>
                            <select id="grupoEmpresa" name="grupoEmpresa" class="form-select select2 w-100" data-style="btn-default">
                            </select>
                        </div>
                        <div class="col-10 col-sm-5 col-md-3">
                            <label for="esGrupoEmpresa" class="form-label">Es Grupo Empresa</label>
                            <div class="form-check form-switch mb-2 mt-2">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    id="esGrupoEmpresa" 
                                    name="esGrupoEmpresa" 
                                    @if(isset($esGrupoEmpresa) === true)
                                        disabled checked
                                    @endif
                                />
                            </div>
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="txt-veris d-flex justify-content-between align-items-center">
                        Datos de Localidad
                        <input type="hidden" name="dataLocalidades" id="dataLocalidades">
                        <button 
                            type="button" 
                            class="btn btn-sm bg-orange ms-auto"
                            data-bs-toggle="offcanvas" 
                            data-bs-target="#offcanvasLocalidades" 
                            aria-controls="offcanvasLocalidades" >
                            <i class="fa-solid fa-plus me-2"></i>Nueva localidad
                        </button>
                    </h6>
                    <div class="row g-3 d-none" id="box-localidades">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre Localidad</th>
                                        <th>Principal</th>
                                        {{-- <th>País</th>
                                        <th>Provincia</th>
                                        <th>Ciudad</th> --}}
                                        <th>Dirección</th>
                                        <th>Correo Empresa</th>
                                        <th>Teléfono Celular</th>
                                        <th>Teléfono Fijo</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="data-localidades">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="my-4 mx-n4" />
                    <h6 class="txt-veris">Datos de Contacto</h6>
                    {{-- <i class="fa-regular fa-id-badge"></i> --}}
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="personaContacto" class="form-label">Nombre Contacto<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                            <input type="text"
                                class="form-control"
                                id="personaContacto"
                                name="personaContacto"
                                value="{{ old('personaContacto', isset($cliente->infoEmpresarial->contactoEmpresarial) ? $cliente->infoEmpresarial->contactoEmpresarial->nombre : '' ) }}"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="telefonoMovilContacto" class="form-label">Teléfono Celular Contacto<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
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
                                        value="{{ str_replace('+593', '', old('telefonoMovilContacto', isset($cliente->infoEmpresarial->contactoEmpresarial) ? $cliente->infoEmpresarial->contactoEmpresarial->telefonoMovil : '')) }}"
                                        required 
                                        placeholder="999999999"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="telefonoFijoContacto" class="form-label">Teléfono Fijo Contacto</label>
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
                                        value="{{ str_replace('+593', '', old('telefonoFijoContacto', isset($cliente->infoEmpresarial->contactoEmpresarial) ? $cliente->infoEmpresarial->contactoEmpresarial->telefonoFijo : '')) }}"
                                        placeholder="99999999"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="correoContacto" class="form-label">Correo Contacto<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                            <input type="email"
                                class="form-control"
                                id="correoContacto"
                                name="correoContacto"
                                value="{{ old('correoContacto', isset($cliente->infoEmpresarial->contactoEmpresarial) ? $cliente->infoEmpresarial->contactoEmpresarial->mail : '' ) }}"
                                required 
                                placeholder=""/>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="cargoPersonaContacto" class="form-label">Cargo Contacto</label>
                            <input type="text"
                                class="form-control"
                                id="cargoPersonaContacto"
                                name="cargoPersonaContacto"
                                value="{{ old('cargoPersonaContacto', isset($cliente->infoEmpresarial->contactoEmpresarial) ? $cliente->infoEmpresarial->contactoEmpresarial->cargo : '' ) }}"
                                placeholder=""/>
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn bg-veris">
                                @if(isset($edit) && $edit === true)
                                Actualizar Empresa
                                @else
                                Crear Empresa
                                @endif
                            </button>
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

    <!-- Offcanvas Localidades -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLocalidades" aria-labelledby="offcanvasLocalidadesLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasLocalidadLabel">Localidad</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row g-3">
                <input type="hidden" name="secuenciaLocalidad" id="secuenciaLocalidad">
                <input type="hidden" name="idLocalidadTmp" id="idLocalidadTmp">
                <div class="col-12 mt-1 mb-1">
                    <label for="nombreLocalidad" class="form-label">Nombre de Localidad<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                    <input type="text"
                        class="form-control"
                        id="nombreLocalidad"
                        name="nombreLocalidad"
                        placeholder=""/>
                </div>
                <div class="col-6 mt-1 mb-1">
                    <label for="esPrincipal" class="form-label">Localidad Principal</label>
                    <div class="form-check form-switch mb-2 mt-2">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            id="esPrincipal" 
                            name="esPrincipal"
                        />
                    </div>
                </div>
                <div class="col-12 mt-1 mb-1">
                    <label for="pais" class="form-label">País<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                    <select id="pais" name="pais" class="form-select select2 w-100" data-style="btn-default">
                    </select>
                </div>
                <div class="col-12 mt-1 mb-1">
                    <label for="provincia" class="form-label">Provincia<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                    <select id="provincia" name="provincia" class="form-select select2 w-100" data-style="btn-default">
                    </select>
                </div>
                <div class="col-12 mt-1 mb-1">
                    <label for="ciudad" class="form-label">Ciudad<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                    <select id="ciudad" name="ciudad" class="form-select select2 w-100" data-style="btn-default">
                    </select>
                </div>
                <div class="col-12 mt-1 mb-1">
                    <label for="direccion" class="form-label">Dirección<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                    <input type="text"
                        class="form-control"
                        id="direccion"
                        name="direccion"
                        placeholder=""/>
                </div>
                <div class="col-12 mt-1 mb-1">
                    <label for="correoEmpresa" class="form-label">Correo Empresa<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                    <input type="email"
                        class="form-control"
                        id="correoEmpresa"
                        name="correoEmpresa"
                        placeholder=""/>
                </div>
                <div class="col-12 mt-1 mb-1">
                    <label for="telefonoMovilOficina" class="form-label">Teléfono Celular Oficinas<i class="fa-solid fa-asterisk fs-10 text-danger ms-2"></i></label>
                    <div class="row">
                        <div class="col-4 col-sm-6 col-md-6 col-lg-4">
                            <select id="telefonoMovilOficinaCode" name="telefonoMovilOficinaCode" class="form-select select2 w-100 fs-12" data-style="btn-default">
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
                                {{-- value="{{ str_replace('+593', '', old('telefonoMovilOficina', isset($cliente) ? $cliente->localidades->telefonoCelular : '')) }}" --}}
                                placeholder="999999999"/>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-1 mb-1">
                    <label for="telefonoFijoOficina" class="form-label">Teléfono Fijo Oficinas</label>
                    <div class="row">
                        <div class="col-4 col-sm-6 col-md-6 col-lg-4">
                            <select id="telefonoFijoOficinaCode" name="telefonoFijoOficinaCode" class="form-select select2 w-100 fs-12" data-style="btn-default">
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
                                {{-- value="{{ str_replace('+593', '', old('telefonoFijoOficina', isset($cliente) ? $cliente->localidades->telefonoConvencional : '')) }}" --}}
                                placeholder="99999999"/>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-3 mb-2">
                    <button type="button"
                        class="btn btn-secondary w-100" 
                        data-bs-dismiss="offcanvas">
                        Cancelar
                    </button>
                </div>
                <div class="col-6 mt-3 mb-2">
                    <button type="button"
                        id="btnAgregarLocalidad"
                        class="btn bg-veris w-100"
                        onclick="agregarLocalidad()" 
                        title="Agregar Localidad">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let modalGiroNegocio;
        let localidades = [];
        @if(!isset($edit))
        let dataLocalidades = "{{ old('dataLocalidades', isset($cliente) ? $cliente->localidades : '' ) }}";
        @endif
        
        let allowCall = true;
        window.onload = async () => {
            modalGiroNegocio = new bootstrap.Modal('#modalGiroNegocio');
            @if(!isset($edit))
            if(dataLocalidades != ""){
                $('#dataLocalidades').val(dataLocalidades).trigger('change');
                localidades = JSON.parse(decodeURIComponent($("#dataLocalidades").val()).replace(/&quot;/g, '"'));
                drawTableLocalidades();
            }
            @endif

            await obtenerGirosNegocio();
            await obtenerGrupoEmpresa();

            await cargarPaises();
            await cargarProvincias();
            //await cargarCiudades();

            $('body').on('change','#numeroIdentificacion',function(){
                buscarCliente();
            });

            $('body').on('change','#pais',function(){
                if(allowCall){
                    cargarProvincias();
                }
            });

            $('body').on('change','#provincia',function(){
                if(allowCall){
                    cargarCiudades();
                }
            });

            allowCall = false;

            let tipoPersona = "{{ old('tipoPersona', isset($cliente) ? $cliente->datosCliente->tipoPersona : '' ) }}";
            if(tipoPersona != ""){
                $('#tipoPersona').val(tipoPersona).trigger('change');
            }
            
            // let pais = ;
            // if(pais != ""){
            //     $('#pais').val(pais).trigger('change');
            //     await cargarProvincias();
            //     let provincia = "";
            //     if(provincia != ""){
            //         $('#provincia').val(provincia).trigger('change');
            //         await cargarCiudades();
            //         let ciudad = "";
            //         if(ciudad != ""){
            //             $('#ciudad').val(ciudad).trigger('change');
            //         }
            //     }
            // }

            let idGiroNegocio = "{{ old('giroNegocio', isset($cliente) ? $cliente->infoEmpresarial->idGiroNegocio : '' ) }}";
            if(idGiroNegocio != null){
                $('#giroNegocio').val(idGiroNegocio).trigger('change');;
            }

            let idGrupoEmpresa = "{{ old('grupoEmpresa', isset($cliente) ? $cliente->infoEmpresarial->idGrupoEmpresa : '' ) }}";
            if(idGrupoEmpresa != null){
                $('#grupoEmpresa').val(idGrupoEmpresa).trigger('change');;
            }

            @if(isset($edit) && isset($cliente->localidades) )
                localidades = {!! json_encode($cliente->localidades) !!};
                if(localidades.length > 0){
                    $('#box-localidades').removeClass('d-none');
                    drawTableLocalidades();
                }
            @endif

            allowCall = true;
        }

        async function buscarCliente(){
            if($('#numeroIdentificacion').val().length > 0){
                let args = [];
                let tipoFiltro = "numeroIdentificacion";
                args["endpoint"] = api_url+"/comercial/v1/clientes?page=1&perPage=100&estado=TODOS&infoEmpresarial=true&tipoFiltro="+tipoFiltro+"&valorFiltro="+$('#numeroIdentificacion').val();
                args["method"] = "GET";
                args["bodyType"] = "json";
                args["showLoader"] = true;

                const data = await call(args);
                console.log(data);
                if(data.data.totalRows == 1){
                    console.log(0)
                    if($('#numeroIdentificacion').val() == data.data.row[0].numeroIdentificacion){
                        console.log(1)
                        showMessage('warning','Atención','El RUC: '+$('#numeroIdentificacion').val()+" ya se encuentra registrado.")
                    }
                }

            }
        }

        async function validarLocalidad(){
            if(getInput('nombreLocalidad') == "" ||
                getInput('direccion') == "" ||
                getInput('correoEmpresa') == "" ||
                getInput('telefonoMovilOficina') == "" ||
                getInput('telefonoFijoOficina') == ""){
                    showMessage('warning','Atención','Campos con <i class="fa-solid fa-asterisk fs-10 text-danger"></i> son obligatorios');
                    return false;
            }else{
                return true;
            }

        }

        let idLocalidadTmp = 1;
        async function agregarLocalidad(){
            let valida = await validarLocalidad();
            if(valida){
                if(getInput('secuenciaLocalidad') == ''){
                    secuenciaLocalidad = idLocalidadTmp;
                    idLocalidadTmp++;
                    localidades.push({
                        @if(isset($edit) && $edit === true)
                        "activo": true,
                        "status": "edit",
                        @endif
                        "idLocalidadTmp": secuenciaLocalidad,
                        "secuenciaLocalidad": null,
                        "nombreLocalidad": getInput('nombreLocalidad'),
                        "esPrincipal": getInput('esPrincipal','checkbox'),
                        "codigoPais": parseInt(getInput('pais')),
                        "codigoProvincia": parseInt(getInput('provincia')),
                        "codigoCiudad": parseInt(getInput('ciudad')),
                        "nombrePais": getHtmlSelect('pais'),
                        "nombreProvincia": getHtmlSelect('provincia'),
                        "nombreCiudad": getHtmlSelect('ciudad'),
                        "direccion": getInput('direccion'),
                        "email": getInput('correoEmpresa'),
                        "codigoPaisMovil": getInput('telefonoMovilOficinaCode'),
                        "telefonoMovil": getInput('telefonoMovilOficina'),
                        "codigoPaisFijo": getInput('telefonoFijoOficinaCode'),
                        "telefonoFijo": getInput('telefonoFijoOficina')
                    });
                }else{
                    secuenciaLocalidad = getInput('secuenciaLocalidad');

                }
                
                $('#offcanvasLocalidades').offcanvas('hide');
                $('#offcanvasLocalidades').find('input').val("");
                $('#esPrincipal').prop('checked',false);
                $('#box-localidades').removeClass('d-none');
                drawTableLocalidades();
            }
        }

        async function drawTableLocalidades(){
            let elem = ``;
            $.each(localidades, function(key, value){
                elem += `<tr>
                            <td>${value.nombreLocalidad}</td>
                            <td>${(value.esPrincipal) ? "SI" : "NO"}</td>
                            <!--td>${value.nombrePais}</td>
                            <td>${value.nombreProvincia}</td>
                            <td>${value.nombreCiudad}</td-->
                            <td>${value.direccion}</td>
                            <td>${value.email}</td>
                            <td>${value.codigoPaisMovil} ${value.telefonoMovil}</td>
                            <td>${value.codigoPaisFijo} ${value.telefonoFijo}</td>
                            <td>
                                <button type="button" 
                                    data-bs-toggle="offcanvas" 
                                    data-bs-target="#offcanvasLocalidades" 
                                    aria-controls="offcanvasLocalidades"
                                    class="btn btn-sm d-inline-block me-2 shadow-none" 
                                    idLocalidadTmp-rel="${ value.idLocalidadTmp }" 
                                    secuenciaLocalidad-rel="${ value.secuenciaLocalidad }"
                                    onclick="cargarLocalidad(${ value.idLocalidadTmp },${ value.secuenciaLocalidad })">
                                    <img class="action-ico" src="{{ asset('assets/img/veris/edit-ico.svg') }}" alt="" title="Editar">
                                </button>
                            </td>
                        </tr>`;
            });
            $('.data-localidades').empty();
            $('.data-localidades').append(elem);
            $("#dataLocalidades").val(JSON.stringify(localidades));
        }

        async function cargarLocalidad(idLocalidadTmp,secuenciaLocalidad){
            allowCall = false;
            let data = buscarPorIdLocalidadOSequencia(idLocalidadTmp,secuenciaLocalidad);
            console.log(data);
            if(data){
                $('#secuenciaLocalidad').val(data.secuenciaLocalidad);
                $('#idLocalidadTmp').val(data.idLocalidadTmp);
                $('#nombreLocalidad').val(data.nombreLocalidad);
                $('#telefonoFijoOficinaCode').val(data.codigoPaisFijo);
                $('#telefonoFijoOficina').val(data.telefonoFijo);
                $('#telefonoMovilOficinaCode').val(data.codigoPaisMovil);
                $('#telefonoMovilOficina').val(data.telefonoMovil);
                $('#direccion').val(data.direccion);
                $('#correoEmpresa').val(data.email);
                if(data.esPrincipal){
                    $('#esPrincipal').prop('checked',true);
                }

                $('#pais').val(data.codigoPais).trigger('change');
                await cargarProvincias();
                $('#provincia').val(data.codigoProvincia).trigger('change');
                await cargarCiudades();
                $('#ciudad').val(data.codigoCiudad).trigger('change');

            }
            allowCall = true;
        }

        function buscarPorIdLocalidadOSequencia(idLocalidad, secuenciaLocalidad) {
            if (idLocalidad === null && secuenciaLocalidad === null) {
                return null;
            }

            for (let i = 0; i < localidades.length; i++) {
                const objeto = localidades[i];

                if ( (idLocalidad === null || objeto.idLocalidadTmp === idLocalidad) &&
                  (secuenciaLocalidad === null || objeto.secuenciaLocalidad === secuenciaLocalidad)) {
                    return objeto;
                }
            }

            return null; // Devuelve null si no se encontraron coincidencias
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
                if(data.code == 200){
                    obtenerGirosNegocio(data.data.idGiroNegocio);
                }else{
                    showMessage('warning','Atención',data.message);
                }
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

        async function obtenerGirosNegocio(idGiroNegocio = null){
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
            });
            if(idGiroNegocio != null){
                $('#giroNegocio').val(idGiroNegocio);
            }
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


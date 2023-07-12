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
                @if(!isset($numeroIdentificacion))
                <h6 class="txt-veris">Seleccionar Cliente</h6>
                @else
                <h6 class="txt-veris">Cliente</h6>
                @endif
                <div class="row g-3">
                    @if(!isset($numeroIdentificacion))
                    <div class="col-11 col-md-6">
                        <div class="input-group input-group-merge">
                            <input type="text"
                                id="searchInput"
                                class="form-control"
                                placeholder="Buscar"
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
                    @else
                    <input type="hidden" id="searchInput" value="{{ $numeroIdentificacion }}" />
                    @endif
                    <div class="col-12 d-none" id="box-info-cliente">
                        <input type="hidden" id="cliente">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <label class="form-label fs-12">Cliente</label>
                                <p id="nombreCliente"></p>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label fs-12">Cédula/RUC</label>
                                <p id="numeroIdentificacion"></p>
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label fs-12">Tipo de persona</label>
                                <p id="tipoPersona"></p>
                            </div>
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
                <h6 class="txt-veris">Tipos de Servicios</h6>
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="tipoServicio" class="form-label">¿Qué servico deseas cotizar?</label>
                        <div class="select2-dark">
                            <select id="tipoServicio" class="select2 form-select">
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="lugarServicio" class="form-label">¿Dónde deseas el servico?</label>
                        <div class="select2-dark">
                            <select id="lugarServicio" class="select2 form-select" multiple>
                                <option value="1" >En el lugar de la empresa</option>
                                <option value="2" >En el centro médico Veris</option>
                                <option value="3">Otros</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="centroMedico" class="form-label">Centrales Médicas</label>
                        <div class="select2-dark">
                            <select id="centroMedico" class="select2 form-select">
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
                            {{-- min="{{ date('Y-m-d') }}" --}}
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
                            onclick="cargarDataPrestaciones()" 
                            title="Seleccionar Prestaciones"
                            >
                            <i class="fa-solid fa-laptop-medical me-2"></i>
                            Seleccionar Prestaciones
                        </button>
                    </div>
                </div>
                <hr class="my-4 mx-n4 box-resumen d-none" />
                <h6 class="txt-veris box-resumen d-none">Resumen de la Cotización</h6>
                <div class="row g-3 box-resumen d-none">
                    <div class="col-12">
                        <!-- Responsive Datatable -->
                        <div class="card shadow-none">
                            <div class="card-datatable table-responsive">
                                <table class="dt-responsive-prestaciones table table-prestaciones border">
                                    <thead>
                                        <tr>
                                            <th>Grupo</th>
                                            <th>Cód. Prestación</th>
                                            <th>Cód. Servicio</th>
                                            <th>Servicio</th>
                                            <th>Prestación</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unit.</th>
                                            <th>Precio Total</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="prestaciones-seleccionadas">
                                        {{-- <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>Servicio</td>
                                            <td>Presta</td>
                                            <td>1</td>
                                            <td>12</td>
                                            <td>12</td>
                                            <td>
                                                <!--div class="d-inline-block">
                                                    <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="text-primary ti ti-dots-vertical"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end m-0" style="">
                                                        <li>
                                                            <a href="javascript:;" class="dropdown-item"><i class="text-primary ti ti-trash"></i>Editar</a>
                                                        </li>
                                                        <div class="dropdown-divider"></div>
                                                        <li>
                                                            <a href="javascript:;" class="dropdown-item text-danger delete-record">
                                                                <i class="ti ti-pencil"></i>Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div-->
                                                <a title="Editar" href="javascript:;" class="btn btn-sm btn-icon item-delete d-inline-block">
                                                    <i class="text-primary ti ti-pencil"></i>
                                                </a>
                                                <a title="Eliminar" href="javascript:;" class="btn btn-sm btn-icon item-edit d-inline-block">
                                                    <i class="text-danger ti ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>   --}}                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/ Responsive Datatable -->
                    </div>
                </div>
                <div class="row g-3 box-resumen d-none">
                    <div class="col-12">
                        <button type="button"
                            id="btn-crear-cotizacion"
                            class="btn bg-veris"
                            onclick="crearCotizacion()" 
                            title="Seleccionar Prestaciones"
                            >
                            <i class="fa-regular fa-floppy-disk me-2"></i>
                            Crear Cotización
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PRESTACIONES -->
<div class="modal fade" id="modalPrestaciones" aria-labelledby="modalPrestacionesLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    {{-- <div class="modal-dialog modal-xl"> --}}
    <div class="modal-dialog modal-fullscreen modal-fullscreen-md-down">
        <div class="modal-content p-2">
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            <div class="modal-header">
                <div class="col-12">
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
                            <ul class="swiper-wrapper" id="list-nivel-1"></ul>
                            <div class="swiper-button-next swiper-button-white custom-icon"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-6 offset-lg-3">
                        <div class="input-group input-group-merge">
                            <input type="text"
                                id="searchInputPrestacion"
                                class="form-control fs-12"
                                placeholder="Buscar prestación"
                                aria-label="Buscar prestación"/>
                            <span title="BUSCAR" class="input-group-text">
                                <i class="ti ti-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3" id="box-prestaciones"></div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn bg-veris">Guardar</button> --}}
                <button type="button" class="btn bg-veris" onclick="drawTable()" data-bs-dismiss="modal">
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

<!-- Offcanvas to add new user -->
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
                <span class="d-block">Grupo Perfil:</span>
                <h6 class="txt-veris fs-14 mb-0" id="grupoPerfilEdit"></h6>
            </div>
            <input type="hidden" id="idItemEdit">
            <div class="col-12">
                <label for="precioUnitarioEdit" class="form-label">Precio Unitario</label>
                <input type="number"
                    inputmode="numeric" 
                    pattern="[0-9]*"
                    class="form-control"
                    id="precioUnitarioEdit"
                    name="precioUnitarioEdit" 
                    placeholder="" />
            </div>
            <div class="col-12">
                <label for="cantidadEdit" class="form-label">Cantidad Pacientes</label>
                <input type="number"
                    inputmode="numeric" 
                    pattern="[0-9]*"
                    step="1" 
                    class="form-control"
                    id="cantidadEdit"
                    name="cantidadEdit" 
                    placeholder="" />
            </div>
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

<script>
    let modalCliente;
    let dataPrestaciones = [];

    window.onload = async () => {
        @if(isset($numeroIdentificacion))
        buscarCliente();
        @endif
        modalCliente = new bootstrap.Modal('#modalCliente');
        obtenerTiposContrato();
        obtenerCentralesMedicas();
        obtenerGruposPerfiles();
        await obtenerNivel1();
        await obtenerPrestaciones();
        showPrestaciones();

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

        $('body').on('change', '#grupoPerfil', function() {
            let codigoGrupo = $(this).val();
            cargarDataPrestaciones(codigoGrupo);

            // $('.swiper-wrapper li').removeClass('item-selected');
            // $('.swiper-wrapper li:first-child').addClass('item-selected');
            // showPrestaciones();
        });

        $('body').on('change', '.input-prestacion', function() {
            let grupo = getInput('grupoPerfil');
            let nombreGrupo = $('#grupoPerfil option:selected').html();
            let prestacion = $.parseJSON($(this).attr("prestacion-rel"));

            // Obtener el índice del grupo en el arreglo dataPrestaciones
            let grupoIndex = dataPrestaciones.findIndex(function(item) {
                return item.codigoGrupo === grupo;
            });

            if($(this).val() != ''){
                $('#ck_'+$(this).attr("id")).prop('checked',true);
            }else{
                $('#ck_'+$(this).attr("id")).prop('checked',false);
            }

            // Si el grupo no existe en dataPrestaciones y el valor del input es vacío, no se realiza ninguna acción
            if (grupoIndex === -1 && $(this).val() === '') {
                return;
            }

            // Crear el objeto de la prestación
            let prestacionObj = {
                "idItem":grupo+"_"+$(this).attr("codigoServicio-rel")+"_"+prestacion.codigoPrestacion,
                "codigoPrestacion": parseInt(prestacion.codigoPrestacion),
                "nombrePrestacion": prestacion.nombrePrestacion,
                "codigoServicio": parseInt($(this).attr("codigoServicio-rel")),
                "nombreServicio": $(this).attr("nombreServicio-rel"),
                "cantidadPacientes": $(this).val(),
                "costoUnitario": prestacion.valorCosto,
                "precioUnitario": prestacion.valorCosto,
                "aplicaIva": prestacion.aplicaIva,
                "id": $(this).attr("id")
            };

            // Si el valor del input es vacío, eliminar la prestación del grupo
            if ($(this).val() === '') {
                // Si el grupo existe en dataPrestaciones
                if (grupoIndex !== -1) {
                    let grupoExistente = dataPrestaciones[grupoIndex];
                    let prestacionExistenteIndex = grupoExistente.prestaciones.findIndex(function(item) {
                        return item.codigoPrestacion === prestacionObj.codigoPrestacion;
                    });

                    // Si la prestación existe en el grupo, se elimina
                    if (prestacionExistenteIndex !== -1) {
                        grupoExistente.prestaciones.splice(prestacionExistenteIndex, 1);
                    }

                    // Si no quedan más prestaciones en el grupo, eliminar el grupo
                    if (grupoExistente.prestaciones.length === 0) {
                        dataPrestaciones.splice(grupoIndex, 1);
                    }
                }
            } else {
                // Si el grupo existe en dataPrestaciones
                if (grupoIndex !== -1) {
                    let grupoExistente = dataPrestaciones[grupoIndex];
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
                    // Crear un nuevo grupo y agregar la prestación
                    let nuevoGrupo = {
                        "codigoGrupo": grupo,
                        "nombreGrupo": nombreGrupo,
                        "prestaciones": [prestacionObj]
                    };
                    dataPrestaciones.push(nuevoGrupo);
                }
            }
        });

        $('body').on('click', '.item-edit', function(){
            cargarItem($(this).attr('idItem-rel'));
        })

        $('body').on('click', '.item-delete', function(){
            eliminarItem($(this).attr('idItem-rel'));
            /*let confirmText = document.querySelector('#confirm-text')
            confirmText.onclick = function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                });
            };*/
        });

    }

    let tabla;
    function drawTable(){
        if(tabla){
            $('.dt-responsive-prestaciones').DataTable().clear().destroy();
        }

        if(dataPrestaciones.length > 0){
            $('.box-resumen').removeClass('d-none');
            let elem = ``;
            $.each(dataPrestaciones, function(key, value){
                $.each(value.prestaciones, function(k, v){
                    elem += `
                    <tr>
                        <td>${ value.nombreGrupo }</td>
                        <td>${ v.codigoPrestacion }</td>
                        <td>${ v.codigoServicio }</td>
                        <td>${ v.nombreServicio }</td>
                        <td>${ v.nombrePrestacion }</td>
                        <td id="cantidad_${ v.idItem }">${ v.cantidadPacientes }</td>
                        <td id="precioUnitario_${ v.idItem }">$${ v.precioUnitario }</td>
                        <td id="total_${ v.idItem }">$${ v.precioUnitario*v.cantidadPacientes }</td>
                        <td>
                            <a idItem-rel="${ v.idItem }" title="Editar" href="javascript:;" class="btn btn-sm btn-icon item-edit d-inline-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasPrestacion" aria-controls="offcanvasPrestacion">
                                <i class="text-primary ti ti-pencil"></i>
                            </a>
                            <a idItem-rel="${ v.idItem }" title="Eliminar Prestación" href="javascript:;" class="btn btn-sm btn-icon item-delete d-inline-block">
                                <i class="text-danger ti ti-trash"></i>
                            </a>
                        </td>
                    </tr>       
                    `;
                });
            });

            $('#prestaciones-seleccionadas').empty();
            $('#prestaciones-seleccionadas').append(elem);

            tabla = $('.dt-responsive-prestaciones').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json',
                },
                responsive: true,
                columnDefs: [
                    {
                        targets: [0, 4, 8], // Índices de las columnas que deseas mantener visibles
                        responsivePriority: 1, // Establece una prioridad alta para mantener estas columnas visibles
                    },
                    {
                        targets: '_all',
                        responsivePriority: 2, // Establece una prioridad baja para el resto de las columnas
                    }
                ]
            });
        }else{
            $('.box-resumen').addClass('d-none');
        }
    }

    function cargarDataPrestaciones(codigoGrupo = null) {
        if(codigoGrupo == null){
            codigoGrupo = $('#grupoPerfil option:selected').val();
        }
        // Obtener el grupo correspondiente desde dataPrestaciones
        let grupoExistente = dataPrestaciones.find(function(grupo) {
            return grupo.codigoGrupo === codigoGrupo;
        });

        console.log(grupoExistente)

        let dataPrestacionesTmp = dataPrestaciones;
        // Blanquear todos los inputs
        $('.input-prestacion').val('');
        $('.ck-input-prestacion').prop('checked',false);
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

    function cargarItem(idItem){
        for (const elemento of dataPrestaciones) {
            for (const prestacion of elemento.prestaciones) {
                if (prestacion.idItem === idItem) {
                    console.table(prestacion)
                    $('#nombrePrestacionEdit').html(prestacion.nombrePrestacion + ": "+ prestacion.codigoPrestacion );
                    $('#nombreServicioEdit').html(prestacion.nombreServicio );
                    $('#grupoPerfilEdit').html(elemento.nombreGrupo);
                    $('#precioUnitarioEdit').val(prestacion.precioUnitario);
                    $('#cantidadEdit').val(prestacion.cantidadPacientes);
                    $('#idItemEdit').val(prestacion.idItem);
                    return prestacion;
                }
            }
        }
        return null;
    }

    function actualizarPrestacion() {
        let idItem = $('#idItemEdit').val();
        for (const elemento of dataPrestaciones) {
            for (const prestacion of elemento.prestaciones) {
                if (prestacion.idItem === idItem) {
                    prestacion.cantidadPacientes = getInput('cantidadEdit');
                    prestacion.precioUnitario = getInput('precioUnitarioEdit');
                    $('#cantidad_'+idItem).html(getInput('cantidadEdit'));
                    $('#precioUnitario_'+idItem).html("$"+getInput('precioUnitarioEdit'));
                    $('#total_'+idItem).html("$"+(getInput('precioUnitarioEdit') * getInput('cantidadEdit')));
                    $('#offcanvasPrestacion').offcanvas('hide');
                    return true;
                }
            }
        }

        return false; // Si no se encuentra el elemento, retorna false
    }

    // Eliminar item desde tabla
    function eliminarItem(idItem) {
        // Buscar el elemento con el idItem dado
        const elemento = dataPrestaciones.find(item => item.prestaciones.some(prestacion => prestacion.idItem === idItem));

        if (elemento) {
            // Filtrar las prestaciones y eliminar la que tiene el idItem
            elemento.prestaciones = elemento.prestaciones.filter(prestacion => prestacion.idItem !== idItem);

            // Verificar si prestaciones[] está vacío
            if (elemento.prestaciones.length === 0) {
                // Eliminar el elemento superior
                dataPrestaciones = dataPrestaciones.filter(item => item.codigoGrupo !== elemento.codigoGrupo);
            }
        }

        drawTable();

        //return dataPrestaciones;
    }

    async function crearCotizacion(){
        let msg = "";
        let cliente = getInput('cliente');
        let tipoServicio = getInput('tipoServicio');
        let lugarServicio = getInput('lugarServicio');
        let centroMedico = getInput('centroMedico');
        let detalleLugar = getInput('detalleLugar');
        let inicioChequeo  = getInput('inicioChequeo');
        let diasServicio  = getInput('diasServicio');

        if(cliente == ""){
            msg += "<span class='fs-12'>Seleccionar un cliente</span><br>";
        }

        if(tipoServicio == ""){
            msg += "<span class='fs-12'>Seleccionar un Tipo de Servicio</span><br>";
        }

        if(lugarServicio == ""){
            msg += "<span class='fs-12'>Seleccionar un lugar</span><br>";
        }

        if(centroMedico == ""){
            msg += "<span class='fs-12'>Seleccionar un Centro Médico</span><br>";
        }

        if(detalleLugar == ""){
            msg += "<span class='fs-12'>Seleccionar un detalle del lugar</span><br>";
        }

        if(inicioChequeo == ""){
            msg += "<span class='fs-12'>Seleccionar una fecha de inicio del chequeo</span><br>";
        }

        if(diasServicio == ""){
            msg += "<span class='fs-12'>Indicar los días que tomará</span><br>";
        }

        if(msg != ""){
            showMessage('warning','Atención',msg);
        }else{
            let args = [];
            args["endpoint"] = api_url+"/empresarial/v1/cotizacion";
            args["method"] = "POST";
            args["bodyType"] = "json";
            args["showLoader"] = true;
            args["data"] = JSON.stringify({
                "codigoCliente": parseInt(cliente),
                "codigoTipoContrato": parseInt(tipoServicio),
                "codigoEmpresa":parseInt($('#centroMedico option:selected').attr('codigoEmpresa-rel')),
                "codigoSucursal": parseInt(centroMedico),
                "direccionServicio": detalleLugar,
                "fechaInicio": inicioChequeo,
                "cantidadDias": parseInt(diasServicio),
                "porcentajeRentabilidad": 20,
                "detalle": dataPrestaciones,
                "costosAdicionales": []
            });

            const data = await call(args);
            if(data.code == 200){
                showMessage('success','Atención',"Cotización creada");
            }else{
                showMessage('warning','Atención',data.message);
            }
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

            const data = await call(args);
            console.log(data);
            if(data.data.totalRows == 0 ){
                showMessage('warning','Atención','No se encontró información de Clientes con esos datos')
            }else if(data.data.totalRows == 1) {
                $('#nombreCliente').html(data.data.row[0].nombreCliente);
                $('#numeroIdentificacion').html(data.data.row[0].numeroIdentificacion);
                $('#tipoPersona').html(data.data.row[0].nombreTipoPersona);
                $('#box-info-cliente').removeClass('d-none');
                $('#cliente').val(data.data.row[0].codigoCliente);
                $('#cliente').attr("cliente-rel",JSON.stringify(data.data.row[0]));
            }else{
                let elem;
                $('#clienteSearch').html($('#searchInput').val() +" ("+data.data.totalRows+" clientes encontrados)");
                $.each(data.data.row, function(key, value){
                    let data_attr = JSON.stringify(value)
                    elem += `<tr>
                                <td class="fs-12">${value.numeroIdentificacion}</td>
                                <td class="fs-12">${value.nombreCliente}</td>
                                <td class="fs-12">${value.nombreTipoPersona}</td>
                                <td class="fs-12">
                                    <button type="button" data-rel='${data_attr}' class="btn btn-sm bg-veris btn-seleccionar-cliente">Seleccionar</button>
                                </td>
                            </tr>`;
                })
                $('#box-clientes-list').append(elem);
                modalCliente.show();
            }
        }
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
            elem += `<li codigoServicio-rel='${value.codigoServicio}' class="swiper-slide ${_class}">${value.nombreServicio}</li>`;
        })
        $('#list-nivel-1').append(elem);
        var swiper = new Swiper(".swiper-container", {
            slidesPerView: "auto",
            freeMode: {
                enabled: true,
                sticky: true,
            },
            spaceBetween: 10,
            mousewheel: true,
            navigation: {
                prevEl: '.swiper-button-prev',
                nextEl: '.swiper-button-next'
            }
        });
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
                    elem += `<div class="col-12 col-md-6 col-lg-6 col-xl-4 mb-2 pt-1 pb-1 servicio servicio-${ value.codigoServicio }">
                            <div class="shadow bg-white prestaciones-item">
                            <div class="card shadow-none">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="card-title mb-0">
                                        <h6 class="mb-0 text-white">${ v1.nombreServicio }</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="p-0 m-0">`
                    $.each(v1.prestaciones, function(k2, v2){
                        elem += `       <li class="mb-1 d-flex align-items-center">
                                            <input type="checkbox" id="ck_prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="me-2 ck-input-prestacion">
                                            <label for="ck_prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="flex-fill fs-10">${ v2.nombrePrestacion }</label>
                                            <div class="align-self-start input-group input-price ms-2">
                                                <span class="input-group-text ps-1 pe-1 pt-1 pb-1 fw-bold"><i class="fa-solid fa-hashtag"></i></span>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" step="1" id="prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="form-control text-center fs-12 ps-1 pe-1 input-prestacion" placeholder="" codigoServicio-rel="${v1.codigoServicio}" nombreServicio-rel='${v1.nombreServicio}' prestacion-rel='${JSON.stringify(v2)}''>
                                            </div>
                                        </li>`;
                    })
                elem += `           </ul>
                                </div>
                            </div>
                            </div>
                        </div>`;
                $('#box-prestaciones').append(elem);
                })
            });
            /*$('.prestaciones-item').each(function() {
                new PerfectScrollbar(this);
            });*/
        })
    }

    function showPrestaciones(){
        $('.servicio').hide();
        $('.servicio-'+$('.item-selected').attr('codigoServicio-rel')).show();
    }
</script>
<style>
    .item-selected {
        background: #3962e6;
        color: #fff;
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
        border: 1px solid #dbdade;
    }

    .swiper-slide {
        cursor: pointer;
        padding: 0.9rem !important;
        width: auto !important;
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

    .table-prestaciones thead{
        background: #DBDADE;
    }

    .table-prestaciones th{
        font-size: 12px !important;
        color: #000 !important;
    }

    #prestaciones-seleccionadas td{
        font-size: 12px !important;
    }

</style>
@endsection


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
                            <select id="tipoServicio" class="select2 form-select" multiple>
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
                <button type="button" class="btn bg-veris">Guardar</button>
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Cerrar
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
<script>
    let modalCliente;

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
            modalCliente.hide();
        })

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

            const data = await call(args);
            console.log(data);
            if(data.data.totalRows == 0 ){
                showMessage('warning','Atención','No se encontró información de Clientes con esos datos')
            }else if(data.data.totalRows == 1) {
                $('#nombreCliente').html(data.data.row[0].nombreCliente);
                $('#numeroIdentificacion').html(data.data.row[0].numeroIdentificacion);
                $('#tipoPersona').html(data.data.row[0].nombreTipoPersona);
                $('#box-info-cliente').removeClass('d-none');
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
        const data = await call(args);
        $.each(data.data, function(key, value){
            $('#centroMedico').append(`<option value="${value.codigoSucursal}">${value.nombreSucursal}</option>`);
        })
    }

    async function obtenerTiposContrato(){
        let args = [];
        args["endpoint"] = api_url+"/comercial/v1/tipos_contratos?codigoTipoProducto=2&estado=ACTIVO";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;
        $('#tipoServicio').empty();
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
                                <div class="card-header d-flex sticky-top justify-content-between">
                                    <div class="card-title mb-0">
                                        <h6 class="mb-0 text-white">${ v1.nombreServicio }</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="p-0 m-0">`
                    $.each(v1.prestaciones, function(k2, v2){
                        elem += `       <li class="mb-1 d-flex align-items-center">
                                            <input type="checkbox" id="ck_prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="me-2">
                                            <label for="ck_prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="flex-fill fs-10">${ v2.nombrePrestacion }</label>
                                            <div class="align-self-start input-group input-price ms-2">
                                                <span class="input-group-text ps-1 pe-1 pt-1 pb-1 fw-bold"><i class="fa-solid fa-hashtag"></i></span>
                                                <input type="number" inputmode="numeric" pattern="[0-9]*" step="1" id="prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="form-control text-center fs-12 ps-1 pe-1" placeholder="">
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
    .prestaciones-item{
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

</style>
@endsection


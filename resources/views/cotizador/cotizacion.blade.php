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
                <div class="row mt-3" id="box-prestaciones">
                    <!--div class="col-12 col-sm-6 col-md-4 mb-2">
                        <div class="card">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="card-title mb-0">
                                        <h5 class="mb-0">Hematología</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="p-0 m-0">
                                        <li class="mb-1 d-flex align-items-center">
                                            <input type="checkbox" id="ck_input_1" class="me-2">
                                            <label for="ck_input_1" class="flex-fill fs-12">HEMOGLOBINA</label>
                                            <div class="align-self-start input-group input-price ms-2">
                                                <span class="input-group-text ps-1 pe-1 pt-1 pb-1 fs-12">$</span>
                                                <input type="text" id="input_1" class="form-control text-center fs-12 ps-1 pe-1" placeholder="0.00">
                                            </div>
                                        </li>
                                        <li class="mb-1 d-flex align-items-center">
                                            <input type="checkbox" id="ck_input_2" class="me-2">
                                            <label for="ck_input_2" class="flex-fill fs-12">HEMATOCRITO</label>
                                            <div class="align-self-start input-group input-price ms-2">
                                                <span class="input-group-text ps-1 pe-1 pt-1 pb-1 fs-12">$</span>
                                                <input type="text" id="input_2" class="form-control text-center fs-12 ps-1 pe-1" placeholder="0.00">
                                            </div>
                                        </li>
                                        <li class="mb-1 d-flex align-items-center">
                                            <input type="checkbox" id="ck_input_3" class="me-2">
                                            <label for="ck_input_3" class="flex-fill fs-12">FROTIS SANGRE PERIFERICA</label>
                                            <div class="align-self-start input-group input-price ms-2">
                                                <span class="input-group-text ps-1 pe-1 pt-1 pb-1 fs-12">$</span>
                                                <input type="text" id="input_3" class="form-control text-center fs-12 ps-1 pe-1" placeholder="0.00">
                                            </div>
                                        </li>
                                        <li class="mb-1 d-flex align-items-center">
                                            <input type="checkbox" id="ck_input_4" class="me-2">
                                            <label for="ck_input_4" class="flex-fill fs-12">I. RETICULOCITARIO + HB. RETICULOCITARIA</label>
                                            <div class="align-self-start input-group input-price ms-2">
                                                <span class="input-group-text ps-1 pe-1 pt-1 pb-1 fs-12">$</span>
                                                <input type="text" id="input_4" class="form-control text-center fs-12 ps-1 pe-1" placeholder="0.00">
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div-->
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
        await obtenerNivel1();
        await obtenerPrestaciones();
        showPrestaciones();

        $('body').on('click touch', '.swiper-slide', function(){
            $('.swiper-slide').removeClass('item-selected');
            $(this).addClass('item-selected');
            showPrestaciones();
        })

    }

    async function obtenerNivel1(){
        let args = [];
        args["endpoint"] = api_url+"/comercial/v1/convenios/consulta_servicios_primer_nivel/?idTarifario=1-1-4";
        args["method"] = "GET";
        args["bodyType"] = "json";
        args["showLoader"] = false;

        const data = await call(args);
        console.log(data);
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
                    elem += `<div class="col-12 col-sm-6 col-md-4 mb-2 pt-1 pb-1 servicio servicio-${ value.codigoServicio }">
                            <div class="shadow bg-white prestaciones-item">
                            <div class="card shadow-none">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="card-title mb-0">
                                <h6 class="mb-0">${ v1.nombreServicio }</h6>
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
                                                <input type="text" id="prestacion_${value.codigoServicio}_${v1.codigoServicio}_${ v2.codigoPrestacion }" class="form-control text-center fs-12 ps-1 pe-1" placeholder="">
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
            $('.prestaciones-item').each(function() {
                new PerfectScrollbar(this);
            });
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
    }
</style>
@endsection


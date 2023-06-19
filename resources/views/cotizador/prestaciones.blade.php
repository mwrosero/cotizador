@extends('template.dashboard')
@section('title')
    Veris - Prestaciones
@endsection
@section('title-section')
    Prestaciones
@endsection
@section('content')
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <div class="d-flex align-items-center">
                <label class="text-primary me-2 " for="tipoGrupo">Grupo Perfil</label>
                <div class="select2-dark">
                    <select id="tipoGrupo" class="select2 form-select form-select-lg" data-allow-clear="true">
                        <option value="1">Grupo 1</option>
                        <option value="2">Grupo 2</option>
                        <option value="3">Grupo 3</option>
                        <option value="4">Grupo 4</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-4">
            <div class="text-end">
                <label class="text-primary me-2" for="tipoGrupo">Grupo Perfil: 2</label>
            </div>
        </div>
    
        <div class="col-12 mb-4">
            <div class="swiper" id="swiper-multiple-slides">
                <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <button class="border btn btn- btn-lg" type="button" id="laboratorio">Laboratorio</button>
                        </div>
                        <div class="swiper-slide">
                            <button type="button" id="laboratorio" class="btn btn-primary">Laboratorio</button>
                        </div>
                        <div class="swiper-slide">
                           <p class="border">loremp isum</p>
                        </div>
                        <div class="swiper-slide">
                            Slide 4
                        </div>
                        <div class="swiper-slide">
                            Slide 5
                        </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
         <div class="col-12 col-sm-4 d-flex justify-content-center">
            <input
                type="text"
                class="form-control"
                placeholder="Buscar"
                aria-label="Search..."
                aria-describedby="busquedaTipoGrupo"
            />
        </div>

        <div>

        </div>
        
        
    </div>
@endsection
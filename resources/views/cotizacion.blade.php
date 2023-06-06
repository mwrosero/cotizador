@extends('welcome')
@section('title')
    Veris - Cotizacion
@endsection

@section('content')
<h4 class="fw-bold">Cotizador</h4>
<h5>Cotizaciones de servicios veris</h5>
<div class="row mb-3">
    <!-- Accordion with Icon -->
    <div class="col-md mb-4 mb-md-2">
      <div class="accordion mt-3" id="accordionWithIcon">
        <div class="card accordion-item active">
          <h2 class="accordion-header d-flex align-items-center">
            <button
              type="button"
              class="accordion-button text-primary"
              data-bs-toggle="collapse"
              data-bs-target="#accordionWithIcon-1"
              aria-expanded="true"
            >
              Paso1. Seccion de Cliente
            </button>
          </h2>

          <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="input-group input-group-merge">
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Buscar"
                              aria-label="Search..."
                              aria-describedby="busquedaCliente"
                            />
                            <span class="input-group-text" id="busquedaCliente"><i class="ti ti-search"></i></span>
                        </div>
                        <label for="busquedaCliente" class="form-label mt-3">Unicomer del Ecuador S.A</label>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <label for="text">Ruc: </label>
                                <label for="ruc">092561470001</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="text">Razón Social: </label>
                                <label for="razonSocial">Unicomer dEL Ecuador S.A.</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="text">Usuario Creador: </label>
                                <label for="usuarioCreador">Usuario2</label>
                            </div>
                        </div>
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
                class="accordion-button collapsed text-primary"
                data-bs-toggle="collapse"
                data-bs-target="#accordionWithIcon-2"
                aria-expanded="false"
                >
                Paso 2. Selección de tipos de servicios
                </button>
            </h2>
            <div id="accordionWithIcon-2" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 mb-3">
                                <label for="select2Dark" class="form-label">¿Qué servico deseas cotizar?</label>
                                <div class="select2-dark">
                                  <select id="select2Dark" class="select2 form-select" multiple>
                                    <option value="1" >Servicio de chequeo Ocupacional</option>
                                    <option value="2" >Servicio de chequeo Preocupacional</option>
                                    <option value="3">Servicio de chequeo Postocupacional</option>
                                  </select>
                                </div>
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
              data-bs-target="#accordionWithIcon-3"
              aria-expanded="false"
            >
             Paso 3. Planificación del Chequeo
            </button>
          </h2>
          <div id="accordionWithIcon-3" class="accordion-collapse collapse">
            <div class="accordion-body">
              Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
              gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
              dragée caramels. Ice cream wafer danish cookie caramels muffin.
            </div>
          </div>
        </div>
        <div class="accordion-item card">
            <h2 class="accordion-header d-flex align-items-center">
              <button
                type="button"
                class="accordion-button collapsed"
                data-bs-toggle="collapse"
                data-bs-target="#accordionWithIcon-4"
                aria-expanded="false"
              >
               Paso 4. Selección del grupo de Perfil
              </button>
            </h2>
            <div id="accordionWithIcon-4" class="accordion-collapse collapse">
              <div class="accordion-body">
                Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                dragée caramels. Ice cream wafer danish cookie caramels muffin.
              </div>
            </div>
          </div>

        <div class="accordion-item card">
            <h2 class="accordion-header d-flex align-items-center">
              <button
                type="button"
                class="accordion-button collapsed"
                data-bs-toggle="collapse"
                data-bs-target="#accordionWithIcon-5"
                aria-expanded="false"
              >
               Paso 5. Cotización
              </button>
            </h2>
            <div id="accordionWithIcon-5" class="accordion-collapse collapse">
              <div class="accordion-body">
                Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                dragée caramels. Ice cream wafer danish cookie caramels muffin.
              </div>
            </div>
          </div>
          <div class="accordion-item card">
            <h2 class="accordion-header d-flex align-items-center">
              <button
                type="button"
                class="accordion-button collapsed"
                data-bs-toggle="collapse"
                data-bs-target="#accordionWithIcon-6"
                aria-expanded="false"
              >
               Paso 6. Resumen de la Cotización
              </button>
            </h2>
            <div id="accordionWithIcon-6" class="accordion-collapse collapse">
              <div class="accordion-body">
                Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                dragée caramels. Ice cream wafer danish cookie caramels muffin.
              </div>
            </div>
          </div>
      </div>
    </div>
    <!--/ Accordion with Icon -->
  </div>

@endsection


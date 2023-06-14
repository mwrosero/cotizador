@extends('template.dashboard')
@section('title')
    Veris - Consulta de Clientes
@endsection
@section('title-section')
    Consulta de Clientes
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row g-3">
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <label for="codigoCliente" class="form-label">Código Cliente</label>
                        <input type="text"
                        class="form-control"
                        id="codigoCliente"
                        name="codigoCliente" 
                        placeholder="" />
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <label for="tipoEmpresa" class="form-label">Tipo de Empresa</label>
                        <select id="tipoEmpresa" name="tipoEmpresa" class="form-select select2 w-100" data-style="btn-default">
                            <option value="N">Natural</option>
                            <option value="J">Juridica</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <label for="tipoFiltro" class="form-label">Filtrar por </label>
                        <select id="tipoFiltro" name="tipoFiltro" class="form-select select2 w-100" data-style="btn-default">
                            <option value="numeroIdentificacion">Número de Identificación</option>
                            <option value="nombreCliente">Nombre del Cliente</option>
                            <option value="razonSocial">Razón Social</option>
                            <!-- <option value="nombreCliente_razonSocial">nombreCliente_razonSocial</option> -->
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table>sdasd</table>
            </div>
        </div>
    </div>
</div>
@endsection


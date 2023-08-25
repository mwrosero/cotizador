@extends('template.external')
@section('title')
    Veris - Aprobar Cotización
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between">
                <h5 class="fw-bold m-0">Cotización</h5>
                <button class="btn bg-orange" id="btnAprobar">Aprobar</button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="txt-veris">Empresa</h6>
                <div class="row g-3">
                    <div class="col-12 col-md-3">
                        <label class="form-label fs-12">Cliente</label>
                        <p>{{ $data->nombreCliente }}</p>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2">
                        <label class="form-label fs-12">Fecha Inicio</label>
                        <p>{{ $data->fechaInicio }}</p>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2">
                        <label class="form-label fs-12">Cantidad días</label>
                        <p>{{ $data->cantidadDias }}</p>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2">
                        <label class="form-label fs-12">Tipo de Contrato</label>
                        <p>{{ $data->nombreTipoContrato }}</p>
                    </div>
                    <div class="col-12 col-md-3 col-lg-2">
                        <label class="form-label fs-12">Total</label>
                        <p>${{ number_format(floatval(ltrim($data->total, '0')), 2, '.', ',') }}</p>
                    </div>
                </div>
                <hr class="my-4 mx-n4" />
                <h6 class="txt-veris">Prestaciones</h6>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card shadow-none">
                            <div class="card-datatable table-responsive">
                                <table class="dt-responsive-prestaciones table table-prestaciones table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Grupo</th>
                                            <th>Servicio</th>
                                            <th>Prestación</th>
                                            <th>Cód. Prestación</th>
                                            <th>Precio Unit.</th>
                                            <th>Cantidad</th>
                                            <th>Precio Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="prestaciones-seleccionadas">
                                    @foreach ($data->detalle as $detalle)
                                        @foreach ($detalle->prestaciones as $prestacion)
                                        <tr>
                                            <td>{{ $detalle->nombreGrupo }}</td>
                                            <td>
                                                @if(isset($prestacion->nombreServicio))
                                                {{ $prestacion->nombreServicio }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($prestacion->nombrePrestacion))
                                                {{ $prestacion->nombrePrestacion }}
                                                @endif
                                            </td>
                                            <td>{{ $prestacion->codigoPrestacion }}</td>
                                            <td>${{ number_format(floatval(ltrim($prestacion->precioUnitario, '0')), 2, '.', ',') }}</td>
                                            <td>{{ $prestacion->cantidadPacientes }}</td>
                                            <td>${{ number_format(floatval(ltrim($prestacion->precioUnitario * $prestacion->cantidadPacientes, '0')), 2, '.', ',') }}</td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .swal2-deny {
        display: none !important;
    }
</style>
<script>
    document.getElementById('btnAprobar').addEventListener('click', function() {
        // Muestra una alerta de verificación
        Swal.fire({
            title: '¿Estás seguro de aceptar la cotización?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, estoy seguro',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#FF9E19',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                aprobarCotizacion()
            }
        });
    });

    async function  aprobarCotizacion() {
        let args = [];
        https://api-phantomx.veris.com.ec/empresarial/v1/cotizacion/aceptacion?idCotizacion=122
        args["endpoint"] = api_url+"/empresarial/v1/cotizacion/aceptacion?idCotizacion={{ $idCotizacion }}";
        args["method"] = "POST";
        args["bodyType"] = "json";
        args["showLoader"] = true;
        //args["data"] = [];

        const data = await call(args);

        if(data.code == 200){
            $('#btnAprobar').hide();
            showMessage('success','Atención',data.message);
            // Swal.fire(
            //     '¡Aprobada!',
            //     'La cotización ha sido aprobada.',
            //     'success'
            // );
        }else{
            showMessage('warning','Atención',data.message);
        }
    }
</script>
@endsection
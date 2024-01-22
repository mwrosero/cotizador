@php
// dump($cotizacion->detalle);
// foreach ($cotizacion->detalle as $item):
//     dump($item);
// endforeach;
@endphp
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PDF</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet"
    />
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 text-center">
				<img src="{{ public_path('assets/img/veris/favicon.png') }}" class="logo mb-2">
				<h2 class="bg-orange p-2">Cotización N° {{ $cotizacion->idCotizacion }}</h2>
			</div>
			<div class="col-12">
				<table width="100%">
					<tr>
						<td width="50%">
							<p class="fw-bold mb-1">Datos Cliente</p>
							<p class="mb-1">{{ $cliente->datosCliente->nombreCliente }}</p>
							<p class="mb-1">{{ $cliente->datosCliente->numeroIdentificacion }}</p>
							<p class="mb-1">{{ $cliente->datosCliente->nombreTipoPersona }}</p>
						</td>
						<td width="50%">
							<p class="fw-bold mb-1">Datos Contacto</p>
							<p class="mb-1">{{ $cliente->infoEmpresarial->contactoEmpresarial->nombre }}</p>
							<p class="mb-1">0{{ $cliente->infoEmpresarial->contactoEmpresarial->telefonoMovil }}</p>
							<p class="mb-1">{{ $cliente->infoEmpresarial->contactoEmpresarial->mail }}</p>
						</td>
					</tr>
				</table>
				<div class="bg-orange p-1 ps-2 pe-2 mt-2">
					<table width="100%">
						<tr>
							<td><p class="fw-bold mb-1">Fecha Cotización:</p></td>
							<td>{{ $cotizacion->fechaIngreso }}</td>
							{{-- <td><p class="fw-bold mb-1">Vigencia Cotización:</p></td>
							<td>30 días</td> --}}
							<td><p class="fw-bold mb-1">Vendedor:</p></td>
							<td>{{ $cotizacion->nombreUsuarioIngreso }}</td>
						</tr>
						<tr>
							<td><p class="fw-bold mb-1">Tipo Contrato:</p></td>
							<td><p class="mb-1">{{ $cotizacion->nombreTipoContrato }}</p></td>
							<td><p class="fw-bold mb-1">Fecha inicio:</p></td>
							<td><p class="mb-1">{{ $cotizacion->fechaInicio }}</p></td>
							<td><p class="fw-bold mb-1">Días planificados:</p></td>
							<td><p class="mb-1">{{ $cotizacion->cantidadDias }}</p></td>
						</tr>
						@if($cotizacion->observacion != "")
						<tr>
							<td><p class="fw-bold mb-1">Observación:</p></td>
							<td colspan="5"><p class="mb-1">{{ $cotizacion->observacion }}</p></td>
						</tr>
						@endif
					</table>
				</div>
			</div>
			<div class="col-12 mt-2" style="page-break-after:auto;">
				<table width="100%" class="table">
					<thead>
						<tr class="bg-menu-theme">
							<th valign="middle">Nivel</th>
							<th valign="middle">Localidad</th>
							<th valign="middle">Grupo Perfil</th>
							<th valign="middle">Descripción</th>
							<th valign="middle">Cantidad</th>
							<th valign="middle">Precio Unitario</th>
							<th valign="middle">Precio Total</th>
						</tr>
					</thead>
					<tbody>
						@php
							$totalPresupuestadoCostos = 0;
						@endphp
						@foreach ($cotizacion->costosAdicionales as $localidad)
							@foreach ($localidad->costos as $costo)
								@if($costo->activo)
									<tr>
										<td>COSTO</td>
										<td>{{ strtoupper($localidad->nombreLocalidad) }}</td>
										<td>SERVICIO</td>
										<td>{{ strtoupper($costo->nombreCosto) }}</td>
										<td class="text-center">{{ $costo->cantidad }}</td>
										<td class="text-center">${{ number_format($costo->valorUnitario, 2, '.', ',') }}</td>
										<td class="text-center">${{ number_format($costo->cantidad * $costo->valorUnitario, 2, '.', ',') }}</td>
									</tr>
								@php
									$totalPresupuestadoCostos += ($costo->cantidad * $costo->valorUnitario);
								@endphp
								@endif
							@endforeach
						@endforeach
						@php
							$totalPresupuestado = 0;
						@endphp
						@foreach ($cotizacion->detalle as $localidad)
							@foreach ($localidad->grupos as $grupos)
								@foreach ($grupos->prestaciones as $prestacion)
									@if($prestacion->activo)
										<tr>
											<td>PRESTACIÓN</td>
											<td>{{ $localidad->nombreLocalidad }}</td>
											<td>{{ $grupos->nombreGrupo }}</td>
											<td>{{ $prestacion->nombrePrestacion }}</td>
											<td class="text-center">{{ $prestacion->cantidadPacientes }}</td>
											<td class="text-center">${{ number_format($prestacion->precioUnitario, 2, '.', ',') }}</td>
											<td class="text-center">${{ number_format($prestacion->cantidadPacientes * $prestacion->precioUnitario, 2, '.', ',') }}</td>
										</tr>
									@php
										$totalPresupuestado += ($prestacion->cantidadPacientes * $prestacion->precioUnitario);
									@endphp
									@endif
								@endforeach
							@endforeach
						@endforeach
						<tr class="bg-orange">
							<td colspan="6" class="text-end fw-bold">Total Costos</td>
							<td class="text-center fw-bold">${{ number_format($totalPresupuestadoCostos, 2, '.', ',') }}</td>
						</tr>
						<tr class="bg-orange">
							<td colspan="6" class="text-end fw-bold">Total Cotización</td>
							<td class="text-center fw-bold">${{ number_format($totalPresupuestado, 2, '.', ',') }}</td>
						</tr>
						{{-- <tr>
							<td colspan="6" class="text-end fw-bold">Rentabilidad</td>
							<td class="text-center fw-bold">{{ $cotizacion->porcentajeRentabilidad }}%</td>
						</tr> --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<style>
		body{
			font-family: "Public Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
		}
		p{
			font-size: 12px;
		}
		th, td{
			font-size: 12px;
		}
		th{
			line-height: 12px;
			font-weight: 700;
		}
		.table, .table th, .table td {
		  	border: 1px solid #aeb8b1;
		  	padding: 2px;
		  	border-collapse: collapse;
		}
		.bg-menu-theme{
		    background: #171D49 !important;
		    color: #fff !important;
		}
		.bg-orange {
		    background: #FF9E19;
		    color: #fff !important;
		}
		.logo{
			display: block;
			height: 75px;
			margin: 0 auto;
		}
		.page-break {
    		page-break-before: always;
		}
		.invoice-articles-table {
    		padding-bottom: 20px; //height of your footer
		}
	</style>
</body>
</html>
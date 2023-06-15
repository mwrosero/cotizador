@if (!$datosPaginados->isEmpty())
<h6 class="m-0 text-end">
	Mostrando {{ $datosPaginados->firstItem() }} - {{ $datosPaginados->lastItem() }} de {{ $datosPaginados->total() }} registros
</h6>
@endif
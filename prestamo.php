<div class="row mt-2 mx-2 py-2 pr-3">
	<strong>Alumno</strong>
</div>
<div class="row border mx-2 py-2 pr-3">

	<div class="col col-md-10">
		<input id="in-buscar-alumno" class="pl-3 form-control input-number" placeholder="Rut del alumno (sin puntos ni digito verificador)" title="Rut sin digito verificador">
	</div>
	<div class="col text-left col-md-2">
		<button id="btn-buscar-alumno" class="btn btn-outline-info" type="submit"><i class="fa fa-search"></i></button>	
	</div>
</div>

<div class="row mx-2 pt-2">
	<div class="col">
		<div id="alert-alumno-danger" class="col col-md-4 alert alert-danger alert-block" role="alert" style="display: none;">Sin resultados.</div>
		<div id="alert-alumno-success" class="col col-md-5 alert alert-success" role="alert" style="display: none;" data-rutalumno=-1> </div>		
	</div>
</div>

<div class="row mx-2 pb-2">
	<strong>Libro</strong>
</div>

<div class="row border mx-2 py-2">
	<div class="col col-md-9">
		<input id="in-codigo-barra" class="pl-3 form-control" placeholder="Codigo de barra del libro" data-toggle="tooltip" data-placement="top" title="Seleccione este campo antes de utilizar la pistola">		
	</div>
	<div class="col col-md-3">
		<img src="background-images/codigobarra.png" style="width: 90px;">
	</div>
</div>

<div class="row mx-2 py-2 mt-3 px-2">
	<strong>Ejemplares disponibles</strong>
</div>

<div class="row mt-2 border mx-2 py-2 px-2" style="overflow-x: auto;overflow-y: auto;">
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th>Copia</th>
				<th>Libro</th>
				<th>Autor</th>
				<th>Fecha Limite</th>
				<th></th>
			</tr>			
		</thead>
		<tbody id="tbody-libros">
			
		</tbody>

	</table>
</div>

<div class="row mx-2 py-2 mt-3 px-2">
	<strong>Prestamos actuales del alumno</strong>
</div>

<div class="row mt-2 border mx-2 py-2 px-2" style="overflow-x: auto;overflow-y: auto;">
	<table class="table pr-3">
		<thead class="thead-light">
			<tr>
				<th>Copia</th>
				<th>Libro</th>
				<th>Autor</th>
				<th>Dias de atraso</th>
				<th>Confirmar Devolucion</th>
			</tr>			
		</thead>
		<tbody id="tbody-prestamos">
			
		</tbody>
	</table>
</div>



<script src="prestamo.js?v=1"></script>

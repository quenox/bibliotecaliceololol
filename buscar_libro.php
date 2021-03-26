<div class="row mt-2 mx-2 py-3 pr-3 border">
	<div class="col">
		<div class="row">
			<div class="col col-md-3">
				<strong>Codigo de barra</strong>
			</div>
			<div class="col">
				<input id="in-busqueda-codigobarra" class="form-control input-number" placeholder="Busqueda por codigo de barra" title="asdasd">
			</div>
		</div>
		<div class="row mt-2">
			<div class="col col-md-3">
				<strong>Titulo del libro</strong>
			</div>
			<div class="col">
				<input id="in-busqueda-titulo" class="form-control input-number" placeholder="Busqueda por titulo del libro" title="asdasd">
			</div>
		</div>
		<div class="row mt-2">
			<div class="col col-md-3">
				<strong>Nombre Autor</strong>
			</div>
			<div class="col">
				<input id="in-busqueda-autor" class="form-control input-number" placeholder="Busqueda por nombre de autor" title="dsadsa">
			</div>
		</div>
	</div>
</div>

<div class="row mt-3 mb-4 mx-2 border" style="overflow-y: auto; height: 600px;">
	<table class="table border">
		<thead>
			<tr>
				<th>Copia</th>
				<th>Titulo</th>
				<th>Autor</th>
				<th>Editorial</th>
				<th>Edicion</th>
			</tr>			
		</thead>
		<tbody id="tbody-libros">
			
		</tbody>
	</table>
</div>

<script src="buscar_libro.js"></script>
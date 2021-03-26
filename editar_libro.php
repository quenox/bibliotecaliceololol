<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong title="">Buscar Libro</strong>
	</div>
	<div class="col col-md-6">
    	<input class="form-control" id="in-codigobarra" placeholder="Codigo de barra" title="Seleccione este campo y a continuación use el lector laser de codigos de barra">
	</div>
	<div class="col col-md-3">
		<img src="https://www.capital.cl/wp-content/uploads/2012/12/codigo-de-barra-foto-flickr.png" style="width: 90px;">
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong style="color: red">*</strong><strong title="campo obligatorio">Autor principal</strong>		
	</div>
	<div class="col">
    	<input type="text" class="form-control" id="in-autor">	
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong style="color: red">*</strong><strong title="campo obligatorio">Titulo</strong>		
	</div>
	<div class="col">
    	<input type="text" class="form-control" id="in-titulo">	
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong>Editorial</strong>		
	</div>
	<div class="col">
    	<input type="text" class="form-control" id="in-editorial">	
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong>Nro. de edicion</strong>		
	</div>
	<div class="col">
    	<input type="number" min=1 class="form-control w-50" id="in-edicion">	
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong>ISBN</strong>		
	</div>
	<div class="col">
    	<input type="number" class="form-control" id="in-isbn">	
	</div>
</div>

<div class="row px-4 py-2">
	<button id="btn-editarlibro" class="btn btn-primary btn-block">Guardar Cambios<i class="fa fa-edit pl-3"></i></button>
</div>

<script src="editar_libro.js"></script>

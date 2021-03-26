<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong style="color: red">*</strong><strong title="campo obligatorio">Codigo de barra</strong>
	</div>
	<div class="col">
    	<input class="form-control" id="in-codigobarra" placeholder="Codigo de barra">
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong style="color: red">*</strong><strong title="campo obligatorio">Autor principal</strong>		
	</div>
	<div class="col">
    	<input type="text" class="form-control" id="in-autor" placeholder="Autor principal">	
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong style="color: red">*</strong><strong title="campo obligatorio">Titulo</strong>		
	</div>
	<div class="col">
    	<input type="text" class="form-control" id="in-titulo" placeholder="Titulo del libro">	
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong>Editorial</strong>		
	</div>
	<div class="col">
    	<input type="text" class="form-control" id="in-editorial" placeholder="Editorial del libro" value="">	
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong>Nro. de edicion</strong>		
	</div>
	<div class="col">
    	<input type="number" min=1 class="form-control w-50" id="in-edicion" placeholder="Ejemplo: 1,2,..,etc" value="1">	
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong>ISBN</strong>		
	</div>
	<div class="col">
    	<input type="number" class="form-control" id="in-isbn" placeholder="ISBN" value="">	
	</div>
</div>

<div class="row px-4 py-2">
	<div class="col text-left col-md-3">
		<strong style="color: red">*</strong><strong title="campo obligatorio">Copias</strong>		
	</div>
	<div class="col">
    	<input type="number" min=1 value="1" class="form-control w-50" id="in-cantidad" placeholder="Cantidad">	
	</div>
</div>

<div class="row px-4 py-2">
	<button id="btn-registrarlibro" class="btn btn-primary btn-block">Registrar<i class="fa fa-save pl-3"></i></button>
</div>


<script src="registrar_libro.js?v=2"></script>
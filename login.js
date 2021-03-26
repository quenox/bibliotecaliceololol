$(document).ready(function()
{
	//permitir solo numeros en la clase input-number
	$('.input-number').on('input', function () { 
	    this.value = this.value.replace(/[^0-9]/g,'');
	});


	$("#form-login").hide().fadeIn(2000);


});
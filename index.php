<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="text-center" style="background-image: url('background-images/biblioteca.jpg');">

	<div style="display: flex;align-items: center;justify-content: center;min-height: 100vh;">
		<form id="form-login" method="POST" action="validar_login.php" class="border px-3 py-3" style="background-color: rgba(255, 255, 111, 0.75); display: none;">
		  <div class="form-group" style="width: 400px;">
		    <label id="lb-rut" for="exampleInputEmail1" style="color: black; font-size: 25px;font-family: Courier New, Courier, monospace"><strong>Rut</strong></label>
		    <input id="in-login-rut" type="number" class="form-control input-number" name="rut" placeholder="ejemplo: 10887232" required>
		  </div>
		  <div class="form-group">
		    <label id="lb-pass" for="exampleInputPassword1" style="color: black; font-size: 20px;font-size: 25px;font-family: Courier New, Courier, monospace"><strong>Password</strong></label>
		    <input id="in-login-pass" type="password" class="form-control" name="pass" placeholder="Ingrese su password" required>
		  </div>
		  <button id="btn-login" type="submit" class="btn btn-primary btn-block">Ingresar<i class="fa fa-sign-in pl-2"></i></button>
		</form>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<script src="login.js"></script>
</body>
</html>
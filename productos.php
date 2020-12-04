<?php
include('conexion/conexion.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Administracion | Productos</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
	<div class="modal" id="modal-producto" style="display: none;">
		<div class="body-modal">
			<button class="breadcrumb-item active" onclick="hide_modal('modal-producto')"><i class="fa fa-times" aria-hidden="true"></i></button>
			<h3 class="card">Añadir producto</h3>
			<input type="text" id="codigo" style="display: none;">
			<div class="div-flex">
				<label>Nombre</label>
				<input type="text" id="nombre">
			</div>
			<div class="div-flex">
				<label>Descripción</label>
				<input type="text" id="descripcion">
			</div>
			<div class="div-flex">
				<label>Precio</label>
				<input type="number" id="precio">
			</div>
			<div class="div-flex">
				<label>Estado</label>
				<select id="estado">
					<option value="1">Activo</option>
					<option value="0">Inactivo</option>
				</select>
			</div>
			<div class="div-flex">
				<input type="file" id="imagen">
			</div>
			<button class="btn btn-primary btn-lg btn-block" onclick="save_producto()">Guardar</button>
		</div>
	</div>
	<div class="main-container">
		<?php include("layout/_directorios.php"); ?>
		<div class="table table-bordered">
			<h2 class="progress-bar">Mis productos</h2>
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th>Código</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Precio</th>
						<th class="td-option">Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT * from producto";
					$resultado = mysqli_query($con, $sql);
					while ($row = mysqli_fetch_array($resultado)) {
						echo
							'<tr>
						<td>' . $row['codpro'] . '</td>
						<td>' . $row['nompro'] . '</td>
						<td>' . $row['despro'] . '</td>
						<td>' . $row['prepro'] . '</td>
						<td class="td-option">
							<div class="div-flex div-td-button">
								<button class="btn btn-primary"><i class="far fa-edit" aria-hidden="true"></i></button>
								<button class="btn btn-primary"><i class="far fa-trash-alt" aria-hidden="true"></i></button>
							</div>
						</td>
					</tr>';
					}
					?>
				</tbody>
			</table>
			<button class="btn btn-primary btn-lg" onclick="show_modal('modal-producto')">Agregar nuevo</button>
		</div>
	</div>
	<script type="text/javascript">
		function show_modal(id) {
			document.getElementById(id).style.display = "block";
		}

		function hide_modal(id) {
			document.getElementById(id).style.display = "none";
		}

		function save_producto() {
			let fd = new FormData();
			fd.append('codigo', document.getElementById('codigo').value);
			fd.append('nombre', document.getElementById('nombre').value);
			fd.append('descripcion', document.getElementById('descripcion').value);
			fd.append('precio', document.getElementById('precio').value);
			fd.append('estado', document.getElementById('estado').value);
			fd.append('imagen', document.getElementById('imagen').files[0]);
			let request = new XMLHttpRequest();
			request.open('POST', 'api/producto_save.php', true);
			request.onload = function() {
				if (request.readyState == 4 && request.status == 200) {
					let response = JSON.parse(request.responseText);
					console.log(response);
					if (response.state) {
						alert("CORRECTO");
					} else {
						alert(response.detail);
					}
				}
			}
			request.send(fd);
		}
	</script>
</body>

</html>
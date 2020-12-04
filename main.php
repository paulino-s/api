<?php
	include('conexion/conexion.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administracion | Productos</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css" integrity="sha512-kJ30H6g4NGhWopgdseRb8wTsyllFUYIx3hiUwmGAkgA9B/JbzUBDQVr2VVlWGde6sdBVOG7oU8AL35ORDuMm8g==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>
	<div class="main-container">
		<?php include("layout/_directorios.php"); ?>
		<div class="table table-bordered">
			<h2 class="progress-bar">Inicio / Pendiente para despachar</h2>
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th>Código</th>
						<th>Usuario</th>
						<th>Producto</th>
						<th>Fecha</th>
						<th>Estado</th>
						<th>Dirección</th>
						<th>Teléfono</th>
						<th>Opciones</th>
					</tr>
				</thead>				
				<tbody>
					<?php
						$sql="SELECT ped.*,usu.*,pro.*,
						CASE WHEN ped.estado=2 THEN 'Pendiente' ELSE 'Otro' END estadotexto
						from pedido ped
						inner  join usuario usu
						on ped.codusu=usu.codusu
						inner  join producto pro
						on ped.codpro=pro.codpro
						where ped.estado=2";
						$resultado=mysqli_query($con,$sql);
						while ($row=mysqli_fetch_array($resultado)) {
							echo 
					'<tr>
						<td>'.$row['codped'].'</td>
						<td>'.$row['codusu'].' - '.$row['nomusu'].'</td>
						<td>'.$row['codpro'].' - '.$row['nompro'].'</td>
						<td>'.$row['fecped'].'</td>
						<td>'.$row['estadotexto'].'</td>
						<td>'.$row['dirusuped'].'</td>
						<td>'.$row['telusuped'].'</td>
						<td class="td-option">
							<button class="btn btn-danger" onclick="despachado('.$row['codped'].')">Despachado</button>
						</td>
					</tr>';
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">
		function show_modal(id){
			document.getElementById(id).style.display="block";
		}
		function hide_modal(id){
			document.getElementById(id).style.display="none";
		}
		function despachado(codped){
			let fd=new FormData();
			fd.append('codped',codped);
			let request=new XMLHttpRequest();
			request.open('POST','api/pedido_confirm.php',true);
			request.onload=function(){
				if (request.readyState==4 && request.status==200) {
					let response=JSON.parse(request.responseText);
					console.log(response);
					if (response.state) {
						window.location.reload();
					}else{
						alert(response.detail);
					}
				}
			}
			request.send(fd);
		}
	</script>
</body>
</html>
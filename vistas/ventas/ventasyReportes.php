<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$obj= new ventas();

	$sql="SELECT 
				fechaCompra,
				nombreP,
				cantidad,
				precio
			from ventas ";
	$result=mysqli_query($conexion,$sql); 

	?>
<br>
<h4>Historial de Ventas</h4>
<br>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-7">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
				
				<tr>
					<td>Fecha</td>
					<td>Producto</td>
					<td>Cantidad Productos</td>
					<td>Total de compra</td>
					
				</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0] ?></td>
					<td><?php echo $ver[1] ?></td>
					<td><?php echo $ver[2] ?></td>
					<td><?php echo $ver[3] ?></td>

				</tr>
		<?php endwhile; ?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>
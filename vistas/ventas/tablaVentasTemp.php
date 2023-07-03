<?php 

	session_start();
	//print_r($_SESSION['tablaComprasTemp']);
 ?>

 <h4>Hacer venta</h4>
 <h4><strong><div id="nombreclienteVenta"></div></strong></h4>
 <table class="table table-bordered table-hover table-condensed" style="text-align: center;">
 	
 	<tr>
 		<td>Nombre</td>
 		<td>Precio</td>
 		<td>Stock</td>
 		<td>Cantidad Compra</td>
 		<td>Quitar</td>
 	</tr>
 	<?php 
 	$total=0;//esta variable tendra el total de la compra en dinero
 		if(isset($_SESSION['tablaComprasTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tablaComprasTemp'] as $key) {

 				$d=explode("||", @$key);
 	 ?>
<caption>
 	<tr>
 		<td><?php echo $d[1] ?></td>
 		<td><?php echo "$".$d[2] ?></td>
 		<td><?php echo $d[3] ?></td>
 		<td><?php echo $d[4]; ?></td>
 		<td>
 			<span class="btn btn-danger btn-xs" onclick="quitarP('<?php echo $i; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>
 	</tr>

 <?php 
 		$total=$total + $d[2]*$d[4];
 		$i++;
 	}
 	endif; 
 ?>

 	<tr>
 		<td>Total de venta: <?php echo "$".$total; ?></td>
 	</tr>

 </table>

 		<span class="btn btn-success" onclick="crearVenta()"> Generar venta
 			<span class="glyphicon glyphicon-usd"></span>
 		</span>
 	</caption>

 </script>
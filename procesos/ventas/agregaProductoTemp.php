<?php 
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$idproducto=$_POST['productoVenta'];
	$cantidad=$_POST['cantidadV'];
	$precio=$_POST['precioV'];
	$cantidadCompra=$_POST['cantidadCompraV'];	

	$sql="SELECT nombre 
			from articulos 
			where id_producto='$idproducto'";
	$result=mysqli_query($conexion,$sql);

	$nombreproducto=mysqli_fetch_row($result)[0];

	$articulo=$idproducto."||".
				$nombreproducto."||".
				$precio."||".
				$cantidad."||".

				$cantidadCompra;

	$_SESSION['tablaComprasTemp'][]=$articulo;

 ?>
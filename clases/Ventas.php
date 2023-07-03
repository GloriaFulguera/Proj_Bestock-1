<?php 

class ventas{

	public function obtenDatosProducto($idproducto){
		$c=new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_producto, cantidad, precio from articulos where id_producto='$idproducto'";
		$result=mysqli_query($conexion,$sql);
		$ver=mysqli_fetch_row($result);
		$datos=array(	'cantidad'=>$ver[1], 
			'precio'=>$ver[2]
		);
		return $datos;
		
	}

	public function crearVenta(){
		$c= new conectar();
		$conexion=$c->conexion();

		$fecha=date('Y-m-d');
	
		$datos=$_SESSION['tablaComprasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;$vS=0;

		for ($i=0; $i < count($datos) ; $i++) { 
			$d=explode("||", $datos[$i]);
			$precio= $d[2]*$d[4];

			$sql="INSERT into ventas (nombreP,
			id_producto,
			id_usuario,
			precio,
			cantidad,
			fechaCompra)
			values ('$d[1]',
			'$d[0]',
			'$idusuario',
			'$precio',
			'$d[4]',
			'$fecha')";

			$r=$r + $result=mysqli_query($conexion,$sql);
			self::descuentaCantidad($d[0],$d[4]);
			
			
			}
		//$idventa++;

		return $r;
	}

	public function descuentaCantidad($idproducto,$cantidad){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT cantidad 
				from articulos 
				where id_producto='$idproducto'";
		$result=mysqli_query($conexion,$sql);

		$cantidad1=mysqli_fetch_row($result)[0];

		$cantidadNueva=abs($cantidad-$cantidad1);

		$sql="UPDATE articulos set cantidad='$cantidadNueva'
			where id_producto='$idproducto'";

		mysqli_query($conexion,$sql);
	}

	public function verificarStock($idproducto){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT cantidad 
				from articulos 
				where id_producto='$idproducto'";
		$result=mysqli_query($conexion,$sql);

		$haber=mysqli_fetch_row($result)[0];

		$sql="SELECT cantidad_min 
				from articulos 
				where id_producto='$idproducto'";
		$result=mysqli_query($conexion,$sql);

		$min=mysqli_fetch_row($result)[0];

		if ($haber<=$min){

		}
	}
}

?>
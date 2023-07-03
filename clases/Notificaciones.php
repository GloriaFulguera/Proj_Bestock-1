<?php
require_once "Conexion.php";

class notificaciones{


    // FUNCION PARA CONTAR LA CANTIDAD DE NOTIFICACIONES ACTIVAS 
    public function countNotificaciones (){

        $c=new conectar();
		$conexion=$c->conexion();
        // PREPARO LA CONSULTA Y LA EJECUTO. SELECCIONO TODAS LAS NOTIFICACIONES ACTIVAS
        $stmt = $conexion->prepare("SELECT * FROM notificaciones  WHERE estado = 1");
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result

        // OBTENGO LA CANTIDAD DE NOTIFICACIONES.
        $cantNotif = mysqli_num_rows($result);

        return $cantNotif;
    }

    // FUNCION PARA GENERAR UNA NUEVA NOTIFICACION
    public function nuevaNotificacion($mensaje,$idProd){
        $c=new conectar();
		$conexion=$c->conexion();

		$sql="INSERT into notificaciones (mensaje,id_producto)
						values ('$mensaje','$idProd')";
		return mysqli_query($conexion,$sql);
    }

    //FUNCION PARA CONTROLAR SI EXISTE O NO UNA NOTIFICACION RELACIONADA A UN ARTICULO.
    public function controlNotificacionArticulo($idArticulo){
		$c=new conectar();
		$conexion=$c->conexion();
        // PREPARO LA CONSULTA Y LA EJECUTO
        $stmt = $conexion->prepare("SELECT * from notificaciones WHERE id_producto = ? AND estado = 1");
        $stmt->bind_param("s", $idArticulo);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        // CONTROLO SI YA EXISTE UNA NOTIFICACION PARA ESE ARTICULO.
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
		
	}

    // FUNCION PARA CONTROLAR EL STOCK DE LOS ARTICULOS
    public function controlarStock(){
        $c=new conectar();
        $conexion=$c->conexion();
        // PREPARO LA CONSULTA Y LA EJECUTO. SELECCIONO AQUELLOS ARTICULOS QUE HAYAN LLEGADO A SU STOCK MINIMO.
        $stmt = $conexion->prepare("SELECT * FROM articulos WHERE cantidad <= cantidad_min");
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        // SI HAY ARTICULOS CON UN STOCK MENOR O IGUAL AL MINIMO REALIZO LA GESTION DE NOTIFICACIONES
        if(mysqli_num_rows($result) > 0){
            // PARA CADA UNO DE LOS ARTICULOS
            while ($articulo = $result->fetch_assoc()) {
                // CONSULTO SI YA EXISTE UNA NOTIFICACION ACTIVA PARA DICHO ARTICULO
                $existe = self::controlNotificacionArticulo($articulo['id_producto']);
                // SI NO EXISTE LA NOTIFICACION, LA CREO.
                if (!$existe){
                    $mensaje = "Advertencia: El articulo $articulo[nombre] ha alcanzado el stock minimo.";
                    $resultado = self::nuevaNotificacion($mensaje,$articulo['id_producto']);

                }


            }
        }else{
            return false;
        }
        
        return true;
        
    }

    // CONTROL DE NOTIFICACIONES, CUANDO EL STOCK SUPERA EL STOCK MINIMO SE DESHABILITA LA NOTIFICACION
    public function controlNotificacionesActivas(){
		$c=new conectar();
		$conexion=$c->conexion();
        // PREPARO LA CONSULTA Y LA EJECUTO. SELECCIONO TODAS LAS NOTIFICACIONES ACTIVAS
        $stmt = $conexion->prepare("SELECT * FROM notificaciones INNER JOIN articulos ON articulos.id_producto = notificaciones.id_producto WHERE estado = 1 ORDER BY notificaciones.id_notificacion");
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        // SI HAY RESULTADOS, LOS RECORRO
        if(mysqli_num_rows($result) > 0){
            // PARA CADA UNA DE LAS NOTIFICACIONES, CONTROLO EL STOCK DEL ARTICULO
            while ($notifArticulo = $result->fetch_assoc()) {
                if($notifArticulo['cantidad'] > $notifArticulo['cantidad_min']){
                    // SI EL STOCK ACTUAL ES MAYOR AL MINIMO, ENTONCES YA FUE ATENDIDA LA NOTIFICACION Y LA DESHABILITO.
                    $stmt = $conexion->prepare("UPDATE notificaciones SET estado = 0 WHERE id_notificacion = ?");
                    $stmt->bind_param("s",$notifArticulo['id_notificacion']);
                    $stmt->execute();
                }
            }
        }
    }
		

}

?>
<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


<!DOCTYPE html>
<html>

<head>
    <title>articulos</title>
    <?php require_once "menu.php"; ?>
    <?php require_once "../clases/Conexion.php"; 
		$c= new conectar();
		$conexion=$c->conexion();
        // CONSULTO POR TODAS LAS NOTIFICACIONES ACTIVAS
		$sql="SELECT * FROM notificaciones INNER JOIN articulos ON articulos.id_producto = notificaciones.id_producto WHERE estado = 1 ORDER BY notificaciones.id_notificacion";
		$result=mysqli_query($conexion,$sql);
        
		?>
</head>

<body>

    <div class="container">
        <h1>Notificaciones</h1>
        <div class="row">

            <div class="col-12">
                <div id="tablaArticulosLoad">
                    <?php if(mysqli_num_rows($result)): ?>
                    <table class="table table-hover table-condensed table-bordered" style="text-align: center;">
                        <caption><label>Notificaciones Activas</label></caption>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Mensaje</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Stock Actual</th>
                            <th class="text-center">Stock minimo</th>
                       <!--      <td>Eliminar</td>  -->
                        </tr>

                        <?php while($notif = $result->fetch_assoc()): ?>

                        <tr>
                            <td><?php echo $notif['id_notificacion']; ?></td>
                            <td><?php echo $notif['mensaje']; ?></td>
                            <td><?php echo $notif['fecha']; ?></td>
                            <td><?php echo $notif['estado']; ?></td>
                            <td><?php echo $notif['nombre']; ?></td>
                            <td><?php echo $notif['cantidad']; ?></td>
                            <td><?php echo $notif['cantidad_min']; ?></td>
                         <!--  <td>
                                <span class="btn btn-danger btn-xs" onclick="eliminarNotif('<?php //echo $notif['id_notificacion'] ?>')">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </span>
                            </td> -->
                        </tr>
                        <?php endwhile; ?>
                    </table>
                    <?php else: ?>
                        <h2 class="bg-danger text-center">No hay notificaciones para mostrar.</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>


<?php 
}else{
	header("location:../index.php");
}
?>
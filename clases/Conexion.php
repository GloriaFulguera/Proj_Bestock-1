<?php 

	class conectar{
		private $servidor="localhost";
		private $usuario="root";
		private $password="fulguera";
		private $bd="bestockbd";

		public function conexion(){
			$conexion=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			return $conexion;
		}
	}


 ?>
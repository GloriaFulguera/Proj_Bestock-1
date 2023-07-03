CREATE database bestockBD ;

use bestockBD;

create table usuarios(
				id_usuario int auto_increment,
				nombre varchar(50),
				apellido varchar(50),
				email varchar(50),
				password text(50),
				fechaCaptura date,
				primary key(id_usuario)
					);

create table categorias (
				id_categoria int auto_increment,
				id_usuario int not null,
				nombreCategoria varchar(150),
				fechaCaptura date,
				primary key(id_categoria)
						);

create table articulos(
				id_producto int auto_increment,
				id_categoria int not null,
				id_usuario int not null,
				nombre varchar(50),
				descripcion varchar(500),
				cantidad int,
                cantidad_min int,
				precio float,
				fechaCaptura date,
				primary key(id_producto)

						);

create table ventas(
				cons_venta int auto_increment,
				id_producto int,
				id_usuario int,
				precio float,
				fechaCompra date,
				nombreP varchar(100),
				primary key(cons_venta)
					);
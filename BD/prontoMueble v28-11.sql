create table PROVEEDOR (
id_proveedor int auto_increment,
nombre varchar (40),
direccion varchar (50),
persona_contacto varchar(40),
primary key(id_proveedor)
);

CREATE TABLE TELEFONO_PROVEEDOR (
    telefono_proveedor VARCHAR(15) NOT NULL,
    id_proveedor INT NOT NULL,
    PRIMARY KEY (telefono_proveedor, id_proveedor),
    FOREIGN KEY (id_proveedor) REFERENCES PROVEEDOR (id_proveedor) ON DELETE CASCADE
);

CREATE TABLE COLOR (
    codigo_color INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) NOT NULL
) AUTO_INCREMENT = 100;

CREATE TABLE MATERIAL (
    codigo_material INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
) AUTO_INCREMENT = 1000;

CREATE TABLE TIPO_MUEBLE (
    codigo_tipo_mueble INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
)AUTO_INCREMENT = 500;

-- Crear tabla MUEBLE
CREATE TABLE MUEBLE (
    id_mueble INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR (50),
    dimension VARCHAR(50) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    cod_tipo_mueble INT,
    cod_color INT ,
    cod_material INT,
    FOREIGN KEY (cod_tipo_mueble) REFERENCES TIPO_MUEBLE(codigo_tipo_mueble),
    FOREIGN KEY (cod_color) REFERENCES COLOR(codigo_color),
    FOREIGN KEY (cod_material) REFERENCES MATERIAL(codigo_material)
)AUTO_INCREMENT = 1500;

CREATE TABLE VENDEDORES (
    id_vendedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    direccion VARCHAR(200),
    email VARCHAR(100)
    genero VARCHAR(20)
);

CREATE TABLE VENTAS (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    id_vendedor INT NOT NULL,
    id_cliente INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_vendedor) REFERENCES vendedores(id_vendedor) ON DELETE CASCADE,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE CASCADE --Modificar segun la tabla de clientes, una vez construida
);

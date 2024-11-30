CREATE TABLE PROVEEDOR (
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
    img VARCHAR(40),
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    cod_tipo_mueble INT,
    cod_color INT ,
    cod_material INT,
    FOREIGN KEY (cod_tipo_mueble) REFERENCES TIPO_MUEBLE(codigo_tipo_mueble),
    FOREIGN KEY (cod_color) REFERENCES COLOR(codigo_color),
    FOREIGN KEY (cod_material) REFERENCES MATERIAL(codigo_material)
)AUTO_INCREMENT = 1500;

--  ------------Andres-------------

CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    identificacion VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    telefono VARCHAR(255) NOT NULL,
    fecha_registro DATE NOT NULL
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('administrador', 'usuario') DEFAULT 'usuario',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);INSERT INTO usuarios (nombre, correo, contrasena, rol) 
VALUES 
('Admin', 'admin@admin.com', MD5('1234567'), 'administrador'),
('Usuario', 'usuario@usuario.com', MD5('1234567'), 'usuario');

-- ------------Julian---------------------------
CREATE TABLE VENDEDORES (
    id_vendedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    direccion VARCHAR(200),
    email VARCHAR(100),
    genero VARCHAR(20)
);
CREATE TABLE VENTAS (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    id_vendedor INT NOT NULL,
    id_cliente INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_vendedor) REFERENCES VENDEDORES(id_vendedor) ON DELETE CASCADE,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id) ON DELETE CASCADE
);

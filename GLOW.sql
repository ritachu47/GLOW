CREATE DATABASE IF NOT EXISTS GLOW;
USE GLOW;


CREATE TABLE TipoCuerpo (
    TipoCuerpoID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL
);


CREATE TABLE Genero (
    GeneroID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL
);


CREATE TABLE Usuario (
    UsuarioID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    Email VARCHAR(50) NOT NULL UNIQUE,
    Celular VARCHAR(20) NOT NULL,
    FechaRegistro DATE NOT NULL
);


CREATE TABLE Avatar (
    AvatarID INT AUTO_INCREMENT PRIMARY KEY,
    UsuarioID INT NOT NULL,
    Altura DECIMAL(5,2) NOT NULL,
    Peso DECIMAL(5,2) NOT NULL,
    TipoCuerpoID INT NOT NULL,
    TonoPiel VARCHAR(50) NOT NULL,
    GeneroID INT NOT NULL,
    CONSTRAINT fk_avatar_usuario FOREIGN KEY (UsuarioID) REFERENCES Usuario(UsuarioID),
    CONSTRAINT fk_avatar_tipocuerpo FOREIGN KEY (TipoCuerpoID) REFERENCES TipoCuerpo(TipoCuerpoID),
    CONSTRAINT fk_avatar_genero FOREIGN KEY (GeneroID) REFERENCES Genero(GeneroID)
);


CREATE TABLE Categoria (
    CategoriaID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL
);


CREATE TABLE Producto (
    ProductoID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Descripcion VARCHAR(100),
    Precio DECIMAL(10,2) NOT NULL,
    CategoriaID INT NOT NULL,
    Marca VARCHAR(20) NOT NULL,
    CONSTRAINT fk_producto_categoria FOREIGN KEY (CategoriaID) REFERENCES Categoria(CategoriaID)
);


CREATE TABLE Talla (
    TallaID INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    UsuarioID INT NOT NULL,
    CONSTRAINT fk_talla_usuario FOREIGN KEY (UsuarioID) REFERENCES Usuario(UsuarioID)
);


CREATE TABLE Inventario (
    InventarioID INT AUTO_INCREMENT PRIMARY KEY,
    ProductoID INT NOT NULL,
    TallaID INT NOT NULL,
    CantidadID INT NOT NULL,
    CONSTRAINT fk_inventario_producto FOREIGN KEY (ProductoID) REFERENCES Producto(ProductoID),
    CONSTRAINT fk_inventario_talla FOREIGN KEY (TallaID) REFERENCES Talla(TallaID)
);

CREATE TABLE Administrador (
    AdministradorID INT AUTO_INCREMENT PRIMARY KEY,
    UsuarioID INT NOT NULL UNIQUE,
    FechaRegistro DATE NOT NULL,
    CONSTRAINT fk_administrador_usuario 
        FOREIGN KEY (UsuarioID) REFERENCES Usuario(UsuarioID)
);

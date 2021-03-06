CREATE TABLE productos(
id              int(255) auto_increment not null,
categoria_id    int(255) not null,
nombre          varchar(100) not null,
descripcion     text,
precio          int(100) not null,
stock           int(255) not null,
oferta          varchar(2),
creado_en           date not null,
imagen          varchar(255),
CONSTRAINT pk_categorias PRIMARY KEY(id),
CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;

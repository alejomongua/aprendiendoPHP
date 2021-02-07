CREATE TABLE pedidos(
id              int(255) auto_increment not null,
usuario_id      int(255) not null,
departamento       varchar(100) not null,
ciudad       varchar(100) not null,
direccion       varchar(255) not null,
coste           float(200,2) not null,
estado          varchar(20) not null,
creado_en       timestamp,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;

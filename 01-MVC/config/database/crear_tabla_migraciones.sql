create table migraciones (
  id int auto_increment not null,
  titulo varchar(12) not null,
  creada_en timestamp not null,
  constraint pk_migraciones primary key(id)
) engine=InnoDB;
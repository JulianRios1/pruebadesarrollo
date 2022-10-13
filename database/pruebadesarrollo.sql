CREATE DATABASE pruebadesarrollo;

-- public.categorias definition

-- Drop table

-- DROP TABLE public.categorias;

CREATE TABLE public.categorias (
	id serial4 NOT NULL,
	nombre varchar NULL,
	descripcion text NULL,
	estado int4 NULL,
	slug text NULL,
	fecha_creacion timestamp NULL,
	fecha_update timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT caterorias_pkey PRIMARY KEY (id)
);

-- Permissions

ALTER TABLE public.categorias OWNER TO postgres;
GRANT ALL ON TABLE public.categorias TO postgres;


-- public.pedidos definition

-- Drop table

-- DROP TABLE public.pedidos;

CREATE TABLE public.pedidos (
	id serial4 NOT NULL,
	usuario_id int4 NULL,
	tercero_id int4 NULL,
	fecha_creacion date NULL,
	fecha_update timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT pedidos_pkey PRIMARY KEY (id)
);

-- Permissions

ALTER TABLE public.pedidos OWNER TO postgres;


-- public.pedidos_body definition

-- Drop table

-- DROP TABLE public.pedidos_body;

CREATE TABLE public.pedidos_body (
	id serial4 NOT NULL,
	pedidos_id int4 NULL,
	producto_id int4 NULL,
	cantidad int4 NULL,
	precio int4 NULL,
	fecha_creacion timestamp NULL,
	fecha_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT pedidos_body_pkey PRIMARY KEY (id)
);

-- Permissions

ALTER TABLE public.pedidos_body OWNER TO postgres;


-- public.productos definition

-- Drop table

-- DROP TABLE public.productos;

CREATE TABLE public.productos (
	id serial4 NOT NULL,
	nombre varchar NULL,
	referencia varchar NULL,
	precio int4 NULL,
	peso int4 NULL,
	fecha_creacion timestamp NULL,
	fecha_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	categorias_id _int4 NULL,
	estado int4 NULL,
	stock int4 NOT NULL DEFAULT 0,
	CONSTRAINT productos_pkey PRIMARY KEY (id)
);
CREATE INDEX productos_id_idx ON public.productos USING btree (id);
CREATE INDEX productos_nombre_idx ON public.productos USING btree (nombre);
CREATE INDEX productos_referencia_idx ON public.productos USING btree (referencia);

-- Permissions

ALTER TABLE public.productos OWNER TO postgres;


-- public.terceros definition

-- Drop table

-- DROP TABLE public.terceros;

CREATE TABLE public.terceros (
	id serial4 NOT NULL,
	nombres varchar NULL,
	apellidos varchar NULL,
	estado int4 NULL,
	fecha_creacion date NULL,
	fecha_update timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	login varchar NULL,
	clave text NULL,
	tipo int4 NULL DEFAULT 1,
	CONSTRAINT terceros_pkey PRIMARY KEY (id)
);

-- Permissions

ALTER TABLE public.terceros OWNER TO postgres;
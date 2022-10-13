## 
PRUEBA : JULIAN OSWALDO RIOS PIEDRAHITA 
============
Usuario : jrios <br>
Clave : &6um*K4z%b&E

## Creación de pedidos
![img](https://trazosdigitales.tech/sistema-cafeteria.png)

## CRUD Productos
![img](https://trazosdigitales.tech/productos.png)

## CRUD Categorias
![img](https://trazosdigitales.tech/categorias.png)

## 
CONFIGURACIÓN Y REQUERIMIENTOS MINIMOS 
============

## Versiones
```php 
php 7.1
postgres 11 
```

## Configuración variables de entorno
se debe ubicar dentro de la carpeta del proyecto se debe ejecutar <br>
```php 
composer install
```

## Configuración variables de entorno
Se debe configurar la conexión a la base de datos, con las variables de ejemplo

```env
DB_HOST=localhost
DB_PORT=5432
DB_USERNAME=postgres
DB_PASSWORD=postgres
DB_DATABASE=pruebadesarrollo
DB_TYPE=postgres

RUTA_APP= http://localhost/
NOMBRE_SITIO=PRUEBA-JULIAN-RIOS-PHP

```
##  Base de datos
ubicada dentro de carpeta databe se encuentra backup con el siguiente nombre:
```env
dump-pruebadesarrollo-202210131823
```
o Se puede restaurar con los siguientes archivos con el orden : 
```env
1-pruebadesarrollo.sql  Encargado de crear la base de datos y las tablas.
2-prueba-desarrollo_terceros.sql
3-prueba-desarrollo_productos.sql
4-prueba-desarrollo_categorias.sql
5-prueba-desarrollo_pedidos.sql
6-prueba-desarrollo_pedidos_body.sql

```

## Realizar  una  consulta  que  permita  conocer  cuál  es  el  producto  que  más  stock  tiene.
```sql
select
	nombre,
	referencia,
	stock
from
	productos p
order by
	stock desc
limit 1
```

## Realizar una  consulta  que  permita  conocer  cuál  es  el  producto más vendido
```sql
select
	p.nombre,
	p.referencia,
	sum(pb.cantidad) vendidos
from
	productos p
join pedidos_body pb on
	p.id = pb.producto_id
where
	p.estado not in (9)
group by
	1,2
order by 3 desc limit 1
```
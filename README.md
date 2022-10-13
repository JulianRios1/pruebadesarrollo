## 
PRUEBA : JULIAN OSWALDO RIOS PIEDRAHITA 
============
Usuario : jrios <br>
Clave : &6um*K4z%b&E
## 
CONFIGURACIÓN Y REQUERIMIENTOS MINIMOS 
============

## Versiones
```php 
php 7.1
postgres 11 
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
![img](https://avatars.githubusercontent.com/u/58895539?v=4)

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
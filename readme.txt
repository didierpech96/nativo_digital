# Prueba Nativo digital

El portal de la prueba se realizó en codeigniter 3 (originalmente django).

## Installación

Configurar el archivo .htaccess ubicado en la raíz del proyecto. Debe contener la ruta donde se instale ignorando el dominio (en este caso se encuentra en localhost/nativo_digital/) y debe quedar de la siguiente forma:

```bash
RewriteBase /nativo_digital/
```

Congfigurar el archivo database.php ubicado en /web/config/database.php
Debemos añadir unicamente los datos hostname, username, password y database.

Nota: El archivo de base de datos se encuentra en /web/database/nativo_digital.sql y debe llamarse de la misma forma para facilitar su uso.

```php
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'nativo_digital',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```

## Uso del portal

Una vez todo se encuentre correctamente configurado podra acceder a la carpeta del proyecto el cual lo redireccionará automaticamente al login.
Ya existe un agente creado con las credenciales:

Usuario : didierpech96@gmail.com
Password: Didier_123

## Uso de la Api

Recomiendo el uso de soapUI (Es donde hice mis pruebas).

Utilizar la opción de nuevo proyecto tipo rest y en la url poner el dominio seguido de /nativo_digital/api/api que es la ruta del servicio.

Se usará el metodo POST y marcando la opción "post query string"

Metodo login: [Imagen](login.png)
Metodo add_poliza: [Imagen](add_poliza.png)
Metodo get_polizas: [Imagen](get_polizas.png)

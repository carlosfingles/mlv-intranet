# MLV intranet
Web oficial del [Intranet del MLV](https://mlv-intranet.org/)
## Configuración e Instalación del Sitio Web
- Crear una nueva base de datos MySQL.
- Importar los 3 archivos SQL dentro de la carpeta `.\BDs` a la base de datos.
- Modificar la url del sitio web dirigiéndose a la tabla `site_settings`  y cambiando el campo `result` donde el valor de `var` es url. También puede usar esta sentencia:

```SQL
UPDATE site_settings SET result= 'NUEVA URL' WHERE var='url'
```
- Ahora dirígase a la carpeta donde instalará el sitio web y luego a `.\Kernel\Settings.php` y modifique los siguientes datos:
```php
<?php
$MySQL['HOST'] = 'localhost'; // Servidor MySQL
$MySQL['USER'] = 'root'; // Usuario MySQL
$MySQL['PASS'] = 'Contrasena'; // Contraseña MySQL
$MySQL['BASE'] = 'DB'; // Nombre de la base de datos
?>
```
- Seguidamente regístrese en el sitio y después dirígase dentro de dase de datos a la tabla `site_users` y cambie el campo `rank` de 0 a 3 para tener las funciones de administrador. También puede usar esta sentencia:
```SQL
UPDATE site_users SET rank= '3' WHERE id='1'
```
- El sitio web ya se encuentra instalado! en caso de error o cualquier problema contacte a [carlosfingles@gmail.com](mailto:carlosfingles@gmail.com).

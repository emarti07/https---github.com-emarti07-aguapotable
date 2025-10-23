Proyecto: Sistema de cobros de agua potable - Paquete complementario
Contenido del ZIP:
- sql/aguapotable_mysql_dump.sql        -> Dump MySQL con estructura y datos de ejemplo
- app/Models/*.php                     -> Modelos Eloquent (Clientes, Medidor, Lectura, Factura, Pago)
- app/Http/Controllers/*.php           -> Controladores CRUD y Reportes
- resources/views/layouts/app.blade.php -> Layout base con paleta de colores (azul, naranja, verde, rojo)
- resources/views/{clientes,pagos,facturas,medidores,lecturas,reports}/*.blade.php -> Vistas básicas (index, create, edit, show)
- routes/web.php                        -> Rutas para los módulos y reports
- database/seeders/DatabaseSeeder.php   -> Seeder que importa el dump SQL (opcional)
- README-instructions.txt              -> Instrucciones para integrar en tu proyecto Laravel

INSTRUCCIONES RÁPIDAS:
1) Extrae este ZIP dentro del directorio raíz de tu proyecto Laravel starter (merge/overwrite).
2) Copia el archivo sql/aguapotable_mysql_dump.sql y luego en tu servidor MySQL (phpMyAdmin) crea la base de datos `aguapotable` y ejecuta el SQL:
   - CREATE DATABASE aguapotable CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   - usar esa base y ejecutar el SQL dump.
3) Ajusta .env de Laravel con tus credenciales MySQL:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=aguapotable
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
4) Ejecuta migraciones si quieres usar las migraciones propias (opcional):
   php artisan migrate
5) Inicia el servidor:
   php artisan serve
6) Accede a /clientes, /medidores, /lecturas, /facturas, /pagos y /reports

NOTAS:
- Este paquete es un "overlay" pensado para integrarse con tu starter. Si tu starter ya tiene App namespace, ajusta nombres de archivos si es necesario.
- Las vistas usan Bootstrap 5; añade la dependencia en tu layout si aún no existe.

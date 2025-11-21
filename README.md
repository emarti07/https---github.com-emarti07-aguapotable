# AguaPotable - UI refactor and backup models

Breve: se añaden variables SCSS, layout base, vistas iniciales (dashboard, clientes), modelos básicos (ClientModel, BackupModel) y script para generar respaldos.

Requisitos:
- PHP 7.4+ with PDO MySQL
- MySQL/MariaDB
- sass (Dart Sass) para compilar SCSS

Instalación y uso:
1. Configura la conexión en config/database.php o mediante variables de entorno (DB_HOST, DB_NAME, DB_USER, DB_PASS).
2. Compilar CSS:
   - Instala sass (https://sass-lang.com/install)
   - Ejecuta: sass assets/scss/app.scss:assets/css/app.css --style=compressed
3. Iniciar servidor local (ejemplo): php -S localhost:8000 -t public
4. Generar respaldo manual:
   - php scripts/backup.php
   - Los respaldos se guardan en /backups como JSON y SQL.

Próximos pasos sugeridos:
- Añadir validaciones y formularios CRUD completos para clientes, medidores y facturas.
- Plantilla de factura en PDF y envío de emails.
- Tests y CI.

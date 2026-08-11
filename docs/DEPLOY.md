# Deploy en Producción (Bitnami / Apache)

Servidor: `/opt/bitnami/apache/htdocs/wilberth`
Aplicación: Laravel + Vite (Bitnami Linux)

## Pasos para la IA de producción

Ejecuta en orden dentro del directorio del repo:

```bash
cd /opt/bitnami/apache/htdocs/wilberth

# 1. Traer el código más reciente
git fetch origin
git reset --hard origin/master

# 2. Dependencias PHP
composer install --no-interaction --prefer-dist

# 3. Frontend (Vite)
CI=true pnpm install
pnpm run build

# 4. Migraciones (OBLIGATORIO si hay migraciones nuevas)
php artisan migrate --force

# 5. Limpiar y cachear config en producción
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

> Alternativa: abrir `https://<sitio>/deploy.php` en el navegador (el script ahora
> ejecuta también las migraciones automáticamente).

## Verificación post-deploy

- Confirmar que las rutas nuevas existen:
  - `GET /admin/hacienda/import`
  - `POST /admin/hacienda/import`
  - `GET /admin/hacienda/{id}/xml`
- Confirmar que la tabla `hacienda_documents` existe y que `invoices` tiene la columna `hacienda_document_id`:
  ```bash
  php artisan tinker --execute="echo \Illuminate\Support\Facades\Schema::hasTable('hacienda_documents') ? 'tabla OK' : 'FALTA tabla';"
  ```
- Verificar `storage/logs/deploy.log` si el deploy.php reporta errores.

## Requisitos

- PHP >= 8.3 y extensión `simplexml` habilitada (Bitnami la trae por defecto).
- El `.env` de producción debe apuntar a la BD correcta (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`). No sobreescribir el `.env` de producción; solo editar si cambia algo.
- Si se edita `.env` en producción, crear primero una copia de respaldo.

## Notas

- El importador de XML de Hacienda crea facturas y las vincula a cotizaciones por email/cédula.
- Las facturas importadas se pueden descargar en PDF desde el detalle (`/factura/{id}/pdf`).
- No correr `php artisan optimize` con caché de config si el `.env` puede cambiar.

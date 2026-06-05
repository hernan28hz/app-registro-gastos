# Despliegue en Hostinger

Guia rapida para subir esta aplicacion Laravel 12 a Hostinger Business Web Hosting.

## 1. Requisitos

- PHP 8.3 activo en Hostinger.
- MySQL creado desde el panel de Hostinger.
- Composer disponible localmente para preparar dependencias.
- Carpeta `public` apuntando como raiz publica del dominio.

## 2. Preparar el proyecto local

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 3. Variables `.env` en Hostinger

Copia `.env.example` como `.env` y cambia estos valores:

```env
APP_NAME="Registro de Compras"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=base_de_datos_hostinger
DB_USERNAME=usuario_hostinger
DB_PASSWORD=clave_hostinger
```

Genera la clave de la aplicacion si no existe:

```bash
php artisan key:generate --force
```

## 4. Subir archivos

Sube todo el proyecto excepto carpetas innecesarias de desarrollo como:

- `node_modules`
- `.git`
- archivos temporales locales

La carpeta publica del dominio debe apuntar a:

```txt
public
```

Si Hostinger no permite cambiar la raiz publica, coloca el contenido de `public` en `public_html` y ajusta las rutas de `index.php` para apuntar al proyecto real.

## 5. Ejecutar migraciones

Desde la terminal de Hostinger:

```bash
php artisan migrate --force
```

## 6. Optimizar para produccion

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 7. Permisos

Asegura permisos de escritura para:

```txt
storage
bootstrap/cache
```

## 8. Uso

1. Entra al dominio.
2. Crea una cuenta.
3. Registra categorias y compras.
4. Exporta compras desde `Compras > Exportar Excel`.

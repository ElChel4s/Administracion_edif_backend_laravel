# 🏢 Building Administration System - Backend API

## 📋 Descripción

API REST desarrollada en Laravel para la gestión integral de edificios residenciales. Sistema completo de administración que incluye gestión de usuarios, residentes, pagos, reservas de áreas comunes, incidentes y más.

## ✨ Características Principales

- 🔐 **Sistema de Autenticación JWT** - Login/registro seguro con tokens JWT
- 👥 **Gestión de Usuarios** - Administradores, residentes y visitantes
- 🏗️ **Arquitectura Modular** - Módulos separados para mejor organización
- 📚 **Documentación API** - Swagger/OpenAPI integrado
- 🔄 **CORS Configurado** - Listo para integración con frontend
- 🗄️ **Base de Datos** - Soporte para MySQL/SQLite
- 📝 **Migraciones** - Sistema completo de migraciones de BD

## 🚀 Tecnologías Utilizadas

- **Laravel 11.x** - Framework PHP
- **JWT Authentication** - tymon/jwt-auth
- **Swagger** - darkaonline/l5-swagger  
- **MySQL/SQLite** - Base de datos
- **PHP 8.x** - Lenguaje backend

## 📁 Estructura del Proyecto

```
app/
├── Modules/
│   ├── Auth/           # Módulo de autenticación
│   │   ├── Controllers/
│   │   ├── Models/
│   │   ├── Requests/
│   │   └── Routes/
│   ├── Finanzas/       # Módulo de facturación
│   ├── Mantenimiento/  # Módulo de mantenimiento
│   ├── Propiedades/    # Módulo de propiedades
│   ├── Recursos/       # Módulo de recursos
│   └── Seguridad/      # Módulo de seguridad
```

## 🛠️ Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/ElChel4s/Administracion_edif_backend_laravel.git
cd Administracion_edif_backend_laravel
```

2. **Instalar dependencias**
```bash
composer install
```

3. **Configurar entorno**
```bash
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

4. **Configurar base de datos en .env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=administracion_edificios
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

5. **Ejecutar migraciones**
```bash
php artisan migrate
```

6. **Iniciar servidor**
```bash
php artisan serve
```

## 📚 API Endpoints

### 🔐 Autenticación
- `POST /api/v1/auth/login` - Iniciar sesión
- `POST /api/v1/auth/register` - Registrar usuario
- `GET /api/v1/auth/me` - Obtener datos del usuario autenticado
- `POST /api/v1/auth/logout` - Cerrar sesión
- `POST /api/v1/auth/refresh` - Refrescar token JWT

### 📋 Documentación
- `GET /api/documentation` - Documentación Swagger de la API

## 🔧 Configuración adicional

### JWT Configuration
El sistema utiliza JWT para la autenticación. Los tokens tienen una duración configurable en `config/jwt.php`.

### CORS
CORS está configurado en `config/cors.php` para permitir solicitudes desde el frontend.

## 🧩 Módulos del Sistema

- **Auth**: Gestión de usuarios y autenticación
- **Finanzas**: Pagos, facturas y estados de cuenta
- **Mantenimiento**: Reportes y seguimiento de mantenimiento
- **Propiedades**: Gestión de unidades y espacios
- **Recursos**: Reservas de áreas comunes
- **Seguridad**: Control de acceso y visitantes

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-caracteristica`)
3. Commit tus cambios (`git commit -m 'Agregar nueva característica'`)
4. Push a la rama (`git push origin feature/nueva-caracteristica`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.

## 🔗 Enlaces

- **Frontend React**: [Administracion_Edificios](https://github.com/ElChel4s/Administracio_Edificios)
- **Documentación API**: `http://localhost:8000/api/documentation` (cuando el servidor esté ejecutándose)

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

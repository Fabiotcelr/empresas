# Empresas API

Esta es una API RESTful desarrollada con Laravel para gestionar los datos de empresas, cumpliendo con los requisitos del desafío técnico propuesto. La API permite agregar, actualizarong, actualizar, consultar y eliminar empresas, con validaciones y manejo de excepciones robusto.

## Descripción del Proyecto

La API gestiona una tabla de `empresas` con los siguientes campos:
- `nit` (único, string)
- `nombre` (string)
- `direccion` (string)
- `telefono` (string)
- `estado` (enum: "Activo", "Inactivo", por defecto "Activo")

Los endpoints permiten:
- Crear nuevas empresas (estado "Activo" por defecto).
- Actualizar datos de una empresa (`nombre`, `direccion`, `telefono`, `estado`).
- Consultar empresas por NIT.
- Consultar todas las empresas registradas.
- Eliminar empresas con estado "Inactivo".

## Requisitos Previos

- PHP >= 8.0
- Composer
- MySQL (o cualquier motor de base de datos compatible con Laravel)
- Laragon (recomendado para entorno local) o cualquier servidor web (Apache/Nginx)
- Postman o cualquier cliente HTTP para probar los endpoints
- Git (para clonar el repositorio)

## Instalación y Configuración

### 1. Clonar el repositorio
```bash
git clone git@github.com:Fabiotcelr/empresas.git
cd empresas-api
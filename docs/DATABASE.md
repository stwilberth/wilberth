# Base de Datos - wilberth.com

## Esquema Simple

Este es un esquema de base de datos **SIMPLE** y directo, diseñado para ser fácil de mantener por un vendedor independiente.

---

## 📊 Tablas

### 1. `products`
Tabla para almacenar productos que Wilberth vende.

```sql
CREATE TABLE IF NOT EXISTS products (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  price REAL NOT NULL,
  description TEXT,
  image_url TEXT,
  category TEXT CHECK(category IN ('Reloj', 'Auto usado', 'Hogar')) NOT NULL
);
```

**Campos:**
- `id`: Identificador único del producto
- `name`: Nombre del producto
- `price`: Precio del producto
- `description`: Descripción opcional del producto
- `image_url`: URL de la imagen del producto
- `category`: Categoría del producto (tipo ENUM). Valores permitidos:
  - `'Reloj'`: Para productos de relojes
  - `'Auto usado'`: Para vehículos usados
  - `'Hogar'`: Para artículos del hogar

**Restricción CHECK:** El campo `category` tiene una restricción que solo permite estos 3 valores específicos. Cualquier intento de insertar un valor diferente resultará en un error.

**Ejemplo de uso:**
```sql
INSERT INTO products (name, price, description, image_url, category)
VALUES ('Reloj Rolex', 8500.00, 'Reloj de lujo en excelente condición', '/images/reloj-01.jpg', 'Reloj');
```

---

### 2. `services`
Tabla para almacenar servicios que Wilberth ofrece.

```sql
CREATE TABLE IF NOT EXISTS services (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  price REAL NOT NULL,
  description TEXT,
  image_url TEXT
);
```

**Campos:**
- `id`: Identificador único del servicio
- `name`: Nombre del servicio
- `price`: Precio del servicio
- `description`: Descripción opcional del servicio
- `image_url`: URL de la imagen del servicio

**Ejemplo de uso:**
```sql
INSERT INTO services (name, price, description, image_url) 
VALUES ('Asesoría de compra', 50.00, 'Ayuda para encontrar el producto ideal', '/images/service-01.jpg');
```

---

## 🔧 Configuración

### Conexión a la Base de Datos

La aplicación usa **Turso (LibSQL)** con dos clientes:
- **Cliente de lectura**: Para consultas (operaciones SELECT)
- **Cliente de escritura**: Para modificaciones (INSERT, UPDATE, DELETE)

```typescript
// Cliente de solo lectura
const readClient = createClient({
  url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
  authToken: import.meta.env.TURSO_READ_ONLY,
});

// Cliente de lectura/escritura
const writeClient = createClient({
  url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
  authToken: import.meta.env.TURSO_READ_WRITE,
});
```

---

## 📝 Operaciones Comunes

### Obtener todos los productos
```typescript
export async function getProducts(): Promise<Product[]> {
  const result = await readClient.execute('SELECT * FROM products');
  return result.rows as unknown as Product[];
}
```

### Obtener todos los servicios
```typescript
export async function getServices(): Promise<Service[]> {
  const result = await readClient.execute('SELECT * FROM services');
  return result.rows as unknown as Service[];
}
```

### Crear las tablas
```typescript
export async function createTables() {
  await writeClient.execute(`
    CREATE TABLE IF NOT EXISTS products (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      name TEXT NOT NULL,
      price REAL NOT NULL,
      description TEXT,
      image_url TEXT,
      category TEXT CHECK(category IN ('Reloj', 'Auto usado', 'Hogar')) NOT NULL
    )
  `);

  await writeClient.execute(`
    CREATE TABLE IF NOT EXISTS services (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      name TEXT NOT NULL,
      price REAL NOT NULL,
      description TEXT,
      image_url TEXT
    )
  `);
}
```

---

## 🚀 Gestión de Datos

### Agregar un producto
Para agregar un nuevo producto, conecta a la base de datos con el cliente de escritura:

```typescript
import { writeClient } from './src/lib/db';

await writeClient.execute({
  sql: 'INSERT INTO products (name, price, description, image_url, category) VALUES (?, ?, ?, ?, ?)',
  args: ['Reloj Omega', 6500.00, 'Reloj automático', '/images/reloj-omega.jpg', 'Reloj']
});
```

### Actualizar un producto
```typescript
await writeClient.execute({
  sql: 'UPDATE products SET price = ? WHERE id = ?',
  args: [7000.00, 1]
});
```

### Eliminar un producto
```typescript
await writeClient.execute({
  sql: 'DELETE FROM products WHERE id = ?',
  args: [1]
});
```

---

## 🔒 Seguridad

**Variables de entorno necesarias:**
- `TURSO_READ_ONLY`: Token de solo lectura para consultas públicas
- `TURSO_READ_WRITE`: Token de escritura para operaciones administrativas

**NUNCA** incluir los tokens en el código fuente. Siempre usar variables de entorno.

```env
TURSO_READ_ONLY=eyJhbGc...
TURSO_READ_WRITE=eyJhbGc...
```

---

## 💡 Notas

- Este esquema es **intencionalmente simple** para facilitar el mantenimiento
- Solo hay UN vendedor (Wilberth), por lo que no se necesita gestión de usuarios
- La información de contacto (teléfono, email, WhatsApp) se maneja en el código, no en la base de datos
- Las categorías se pueden agregar más tarde si es necesario, pero por ahora mantener simple

---

**Última actualización:** 2025-10-10
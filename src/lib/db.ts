import { createClient } from '@libsql/client';

const readClient = createClient({
  url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
  authToken: import.meta.env.TURSO_READ_ONLY,
});

const writeClient = createClient({
  url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
  authToken: import.meta.env.TURSO_READ_WRITE,
});

export interface Product {
  id: number;
  name: string;
  price: number;
  description: string;
  image_url: string;
}

export interface Service {
  id: number;
  name: string;
  price: number;
  description: string;
  image_url: string;
}

export async function getProducts(): Promise<Product[]> {
  const result = await readClient.execute('SELECT * FROM products');
  return result.rows as unknown as Product[];
}

export async function getServices(): Promise<Service[]> {
  const result = await readClient.execute('SELECT * FROM services');
  return result.rows as unknown as Service[];
}

export async function createTables() {
  await writeClient.execute(`
    CREATE TABLE IF NOT EXISTS products (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      name TEXT NOT NULL,
      price REAL NOT NULL,
      description TEXT,
      image_url TEXT
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

export default readClient;
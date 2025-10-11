import { config } from 'dotenv';
import { createClient } from '@libsql/client';

// Load environment variables
config();

async function createTablesOnly() {
  try {
    console.log('Creating tables...');

    const client = createClient({
      url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
      authToken: process.env.TURSO_READ_WRITE,
    });

    await client.execute(`
      CREATE TABLE IF NOT EXISTS products (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        price REAL NOT NULL,
        description TEXT,
        image_url TEXT,
        category TEXT CHECK(category IN ('Reloj', 'Auto usado', 'Hogar', 'Artículos de pesca')) NOT NULL
      )
    `);

    await client.execute(`
      CREATE TABLE IF NOT EXISTS services (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        price REAL NOT NULL,
        description TEXT,
        image_url TEXT
      )
    `);

    console.log('Tables created successfully');

    client.close();
  } catch (error) {
    console.error('Error creating tables:', error);
  }
}

createTablesOnly();
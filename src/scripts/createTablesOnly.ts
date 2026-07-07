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

    await client.execute(`
      CREATE TABLE IF NOT EXISTS quotes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        client_name TEXT NOT NULL,
        client_email TEXT NOT NULL,
        client_phone TEXT NOT NULL,
        notes TEXT,
        subtotal REAL NOT NULL DEFAULT 0,
        tax_rate REAL NOT NULL DEFAULT 13,
        tax_amount REAL NOT NULL DEFAULT 0,
        total REAL NOT NULL DEFAULT 0,
        status TEXT NOT NULL DEFAULT 'pendiente',
        created_at TEXT NOT NULL DEFAULT (datetime('now', '-6 hours'))
      )
    `);

    await client.execute(`
      CREATE TABLE IF NOT EXISTS quote_items (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        quote_id INTEGER NOT NULL,
        description TEXT NOT NULL,
        quantity INTEGER NOT NULL DEFAULT 1,
        unit_price REAL NOT NULL,
        total_price REAL NOT NULL,
        FOREIGN KEY (quote_id) REFERENCES quotes(id) ON DELETE CASCADE
      )
    `);

    console.log('Tables created successfully');

    client.close();
  } catch (error) {
    console.error('Error creating tables:', error);
  }
}

createTablesOnly();
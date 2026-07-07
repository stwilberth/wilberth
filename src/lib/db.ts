import { createClient } from '@libsql/client';

const readClient = createClient({
  url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
  authToken: import.meta.env?.TURSO_READ_ONLY || process.env.TURSO_READ_ONLY,
});

const writeClient = createClient({
  url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
  authToken: import.meta.env?.TURSO_READ_WRITE || process.env.TURSO_READ_WRITE,
});

export interface Product {
  id: number;
  name: string;
  price: number;
  description: string;
  image_url: string;
  category: 'Reloj' | 'Auto usado' | 'Hogar' | 'Artículos de pesca';
}

export interface Service {
  id: number;
  name: string;
  price: number;
  description: string;
  image_url: string;
}

export interface Quote {
  id: number;
  client_name: string;
  client_email: string;
  client_phone: string;
  notes: string;
  subtotal: number;
  tax_rate: number;
  tax_amount: number;
  total: number;
  status: string;
  created_at: string;
  items: QuoteItem[];
}

export interface QuoteItem {
  id: number;
  quote_id: number;
  description: string;
  quantity: number;
  unit_price: number;
  total_price: number;
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
      image_url TEXT,
      category TEXT CHECK(category IN ('Reloj', 'Auto usado', 'Hogar', 'Artículos de pesca')) NOT NULL
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

  await writeClient.execute(`
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

  await writeClient.execute(`
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
}

export async function addService(
  name: string,
  description: string,
  price: number,
  image_url: string
) {
  await writeClient.execute({
    sql: 'INSERT INTO services (name, description, price, image_url) VALUES (?, ?, ?, ?)',
    args: [name, description, price, image_url],
  });
}

export async function createQuote(
  client_name: string,
  client_email: string,
  client_phone: string,
  notes: string,
  items: { description: string; quantity: number; unit_price: number }[],
  tax_rate: number = 13
): Promise<number> {
  const subtotal = items.reduce((sum, item) => sum + item.quantity * item.unit_price, 0);
  const tax_amount = subtotal * (tax_rate / 100);
  const total = subtotal + tax_amount;

  const result = await writeClient.execute({
    sql: `INSERT INTO quotes (client_name, client_email, client_phone, notes, subtotal, tax_rate, tax_amount, total)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)`,
    args: [client_name, client_email, client_phone, notes, subtotal, tax_rate, tax_amount, total],
  });

  const quoteId = Number(result.lastInsertRowid);

  for (const item of items) {
    const totalPrice = item.quantity * item.unit_price;
    await writeClient.execute({
      sql: 'INSERT INTO quote_items (quote_id, description, quantity, unit_price, total_price) VALUES (?, ?, ?, ?, ?)',
      args: [quoteId, item.description, item.quantity, item.unit_price, totalPrice],
    });
  }

  return quoteId;
}

export async function getQuotes(): Promise<Quote[]> {
  const result = await readClient.execute(
    'SELECT * FROM quotes ORDER BY created_at DESC'
  );
  const quotes = result.rows as unknown as Quote[];

  for (const quote of quotes) {
    const itemsResult = await readClient.execute({
      sql: 'SELECT * FROM quote_items WHERE quote_id = ?',
      args: [quote.id],
    });
    quote.items = itemsResult.rows as unknown as QuoteItem[];
  }

  return quotes;
}

export async function getQuoteById(id: number): Promise<Quote | null> {
  const result = await readClient.execute({
    sql: 'SELECT * FROM quotes WHERE id = ?',
    args: [id],
  });

  if (result.rows.length === 0) return null;

  const quote = result.rows[0] as unknown as Quote;

  const itemsResult = await readClient.execute({
    sql: 'SELECT * FROM quote_items WHERE quote_id = ?',
    args: [quote.id],
  });
  quote.items = itemsResult.rows as unknown as QuoteItem[];

  return quote;
}

export async function updateQuoteStatus(id: number, status: string) {
  await writeClient.execute({
    sql: 'UPDATE quotes SET status = ? WHERE id = ?',
    args: [status, id],
  });
}

export async function deleteQuote(id: number) {
  await writeClient.execute({
    sql: 'DELETE FROM quote_items WHERE quote_id = ?',
    args: [id],
  });
  await writeClient.execute({
    sql: 'DELETE FROM quotes WHERE id = ?',
    args: [id],
  });
}

export default readClient;
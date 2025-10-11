import { config } from 'dotenv';
import { createClient } from '@libsql/client';

// Load environment variables
config();

async function testConnection() {
  try {
    console.log('Testing database connection...');

    const client = createClient({
      url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
      authToken: process.env.TURSO_READ_ONLY,
    });

    const result = await client.execute('SELECT 1 as test');
    console.log('✅ Connection successful:', result.rows);

    client.close();
  } catch (error) {
    console.error('❌ Connection failed:', error);
  }
}

testConnection();
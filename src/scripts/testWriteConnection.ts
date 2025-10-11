import { config } from 'dotenv';
import { createClient } from '@libsql/client';

// Load environment variables
config();

async function testWriteConnection() {
  try {
    console.log('Testing write database connection...');

    const client = createClient({
      url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
      authToken: process.env.TURSO_READ_WRITE,
    });

    const result = await client.execute('SELECT 1 as test');
    console.log('✅ Write connection successful:', result.rows);

    client.close();
  } catch (error) {
    console.error('❌ Write connection failed:', error);
  }
}

testWriteConnection();
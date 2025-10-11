import { config } from 'dotenv';
import { createClient } from '@libsql/client';

// Load environment variables
config();

async function checkServices() {
  try {
    console.log('Checking services table...');

    const client = createClient({
      url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
      authToken: process.env.TURSO_READ_ONLY,
    });

    const result = await client.execute('SELECT * FROM services');
    console.log('Services in database:', result.rows);

    client.close();
  } catch (error) {
    console.error('Error checking services:', error);
  }
}

checkServices();
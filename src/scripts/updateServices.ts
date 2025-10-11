import { config } from 'dotenv';
import { createClient } from '@libsql/client';

// Load environment variables
config();

async function main() {
  const writeClient = createClient({
    url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
    authToken: process.env.TURSO_READ_WRITE,
  });

  // Update Express service price
  await writeClient.execute({
    sql: 'UPDATE services SET price = ? WHERE name = ?',
    args: [500, 'Express'],
  });
  console.log('✓ Servicio Express actualizado');

  // Update Desarrollo de Aplicaciones Web service price
  await writeClient.execute({
    sql: 'UPDATE services SET price = ? WHERE name = ?',
    args: [90000, 'Desarrollo de Aplicaciones Web'],
  });
  console.log('✓ Servicio Desarrollo de Aplicaciones Web actualizado');

  // Update Cortiz service price
  await writeClient.execute({
    sql: 'UPDATE services SET price = ? WHERE name = ?',
    args: [10000, 'Cortiz'],
  });
  console.log('✓ Servicio Cortiz actualizado');

  // Add Páginas web service
  await writeClient.execute({
    sql: 'INSERT INTO services (name, description, price, image_url) VALUES (?, ?, ?, ?)',
    args: ['Páginas web', 'Desarrollo de páginas web personalizadas', 60000, '/images/paginas-web-placeholder.jpg'],
  });
  console.log('✓ Servicio Páginas web agregado');

  writeClient.close();

  console.log('\n✅ Todos los servicios han sido actualizados exitosamente');
  process.exit(0);
}

main().catch((error) => {
  console.error('Error al actualizar servicios:', error);
  process.exit(1);
});
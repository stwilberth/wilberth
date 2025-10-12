import { config } from 'dotenv';
import { createClient } from '@libsql/client';

// Load environment variables
config();

async function main() {
  const writeClient = createClient({
    url: 'libsql://wilberth-stwilberth.aws-us-east-1.turso.io',
    authToken: process.env.TURSO_READ_WRITE,
  });

  // Add Express service
  await writeClient.execute({
    sql: 'INSERT INTO services (name, description, price, image_url) VALUES (?, ?, ?, ?)',
    args: ['Express', 'Servicio de mandados en Puerto Jiménez', 0, '/src/assets/express-placeholder.jpg'],
  });
  console.log('✓ Servicio Express agregado');

  // Add Desarrollo de Aplicaciones Web service
  await writeClient.execute({
    sql: 'INSERT INTO services (name, description, price, image_url) VALUES (?, ?, ?, ?)',
    args: ['Desarrollo de Aplicaciones Web', 'Desarrollo de aplicaciones web personalizadas', 0, '/src/assets/desarrollo-web-placeholder.jpg'],
  });
  console.log('✓ Servicio Desarrollo de Aplicaciones Web agregado');

  // Add Cortiz service
  await writeClient.execute({
    sql: 'INSERT INTO services (name, description, price, image_url) VALUES (?, ?, ?, ?)',
    args: ['Cortiz', 'Sistema de cotizaciones inteligente con IA', 0, '/src/assets/cortiz-placeholder.jpg'],
  });
  console.log('✓ Servicio Cortiz agregado');

  // Add Páginas web service
  await writeClient.execute({
    sql: 'INSERT INTO services (name, description, price, image_url) VALUES (?, ?, ?, ?)',
    args: ['Páginas web', 'Creación de páginas web modernas y responsivas', 0, '/src/assets/paginas-web-placeholder.jpg'],
  });
  console.log('✓ Servicio Páginas web agregado');

  writeClient.close();

  console.log('\n✅ Todos los servicios han sido agregados exitosamente');
  process.exit(0);
}

main().catch((error) => {
  console.error('Error al agregar servicios:', error);
  process.exit(1);
});
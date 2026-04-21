export interface Service {
  name: string;
  description: string;
  price: number;
  image_url: string;
  slug: string;
}

export const services: Service[] = [
  {
    name: 'Express',
    description: 'Servicio de mandados en Puerto Jiménez',
    price: 0,
    image_url: '/src/assets/express.jpg',
    slug: 'express'
  },
  {
    name: 'Cortiz',
    description: 'Sistema de cotizaciones inteligente con IA',
    price: 0,
    image_url: '/src/assets/cortiz.svg',
    slug: 'cortiz'
  },
  {
    name: 'Creación de Páginas Web',
    description: 'Creación de páginas web modernas y responsivas',
    price: 0,
    image_url: '/src/assets/paginas-web.svg',
    slug: 'paginas-web'
  },
  {
    name: 'Mantenimiento de Jardines',
    description: 'Cuidado de patios, jardines y vigilancia de propiedades en Puerto Jiménez.',
    price: 0,
    image_url: '/src/assets/jardineria.svg',
    slug: 'mantenimiento-jardines'
  },
  {
    name: 'Pozos Artesanales',
    description: 'Construcción y mantenimiento de pozos artesanales con técnicas tradicionales.',
    price: 0,
    image_url: '/src/assets/pozos.svg',
    slug: 'pozos-artesanales'
  }
];
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
    price: 800,
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
  }
];
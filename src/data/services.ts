export interface Service {
  name: string;
  description: string;
  price: number;
  image_url: string;
  slug: string;
}

export const services: Service[] = [
  {
    name: "Páginas Web, Apps Web y Tiendas en Línea",
    description:
      "Creación de sitios web, aplicaciones web y tiendas en línea modernas para emprendedores",
    price: 0,
    image_url: "/src/assets/paginas-web.svg",
    slug: "paginas-web",
  },
];

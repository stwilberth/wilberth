const puppeteer = require('puppeteer');
const path = require('path');
const fs = require('fs');

const IMAGES = [
  { type: 'trends', filename: 'tendencias-diseno-web.jpg' },
  { type: 'seo', filename: 'seo-guide.jpg' },
  { type: 'email', filename: 'email-marketing.jpg' },
  { type: 'website', filename: 'website-hero.jpg' }
];

async function generateImage(page, type, filename) {
  const html = `
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
          body {
            margin: 0;
            padding: 0;
            width: 1200px;
            height: 630px;
            overflow: hidden;
          }
          
          .blog-image {
            width: 100%;
            height: 100%;
            border-radius: 0;
          }
        </style>
      </head>
      <body>
        <div id="image"></div>
      </body>
    </html>
  `;

  await page.setContent(html);
  await page.setViewport({ width: 1200, height: 630 });

  // Inject the BlogImages component styles and markup
  const blogImagesContent = fs.readFileSync(
    path.join(__dirname, '..', 'src', 'components', 'BlogImages.astro'),
    'utf8'
  );

  const styleContent = blogImagesContent.match(/<style>([\s\S]*?)<\/style>/)[1];
  const imageMarkup = blogImagesContent.match(new RegExp(`{type === '${type}' && \\(([\s\S]*?)\\)}`));

  await page.addStyleTag({ content: styleContent });
  await page.evaluate((markup) => {
    document.getElementById('image').innerHTML = markup
      .replace(/^\(\s*/, '')
      .replace(/\s*\)$/, '')
      .replace(/^[\s\S]*?>/,'')
      .replace(/<\/[\s\S]*$/,'');
  }, imageMarkup[1]);

  const outputPath = path.join(__dirname, '..', 'public', 'blog', filename);
  await page.screenshot({
    path: outputPath,
    type: 'jpeg',
    quality: 90
  });

  console.log(`Generated ${filename}`);
}

(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();

  for (const image of IMAGES) {
    await generateImage(page, image.type, image.filename);
  }

  await browser.close();
})();

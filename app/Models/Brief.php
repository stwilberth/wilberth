<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    protected $fillable = [
        'brief_link_id',
        'business_name',
        'business_type',
        'business_description',
        'location',
        'contact_name',
        'email',
        'phone',
        'pages_needed',
        'extra_features',
        'content_available',
        'brand_colors',
        'website_examples',
        'budget',
        'timeline',
        'competitors',
        'special_notes',
    ];

    protected $casts = [
        'pages_needed' => 'array',
        'content_available' => 'array',
    ];

    public function link()
    {
        return $this->belongsTo(BriefLink::class, 'brief_link_id');
    }

    public function toMarkdown()
    {
        $pages = is_array($this->pages_needed) ? implode(', ', $this->pages_needed) : $this->pages_needed;
        $content = is_array($this->content_available) ? implode(', ', $this->content_available) : $this->content_available;

        return <<<MARKDOWN
# Brief de Proyecto Web

## Información del Cliente

| Campo | Valor |
|-------|-------|
| **Nombre del Negocio** | {$this->business_name} |
| **Tipo de Negocio** | {$this->business_type} |
| **Ubicación** | {$this->location} |
| **Contacto** | {$this->contact_name} |
| **Email** | {$this->email} |
| **Teléfono** | {$this->phone} |

## Descripción del Negocio

{$this->business_description}

## Páginas Solicitadas

{$pages}

## Funcionalidades Extra

{$this->extra_features}

## Contenido Disponible

{$content}

## Preferencias de Diseño

- **Colores:** {$this->brand_colors}
- **Ejemplos de sitios:** {$this->website_examples}

## Presupuesto y Plazo

- **Presupuesto:** {$this->budget}
- **Plazo:** {$this->timeline}

## Competidores

{$this->competitors}

## Notas Especiales

{$this->special_notes}

---
*Generado el: {$this->created_at->format('d/m/Y H:i')}*
MARKDOWN;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingBrief extends Model
{
    protected $fillable = [
        'marketing_brief_link_id',
        'contact_name',
        'email',
        'phone',
        'offer',
        'target_audience',
        'differentiator',
        'main_goal',
        'first_impression',
        'promoted_service',
    ];

    public function link()
    {
        return $this->belongsTo(MarketingBriefLink::class, 'marketing_brief_link_id');
    }

    public function toMarkdown()
    {
        return <<<MARKDOWN
# Brief de Marketing

## Información del Cliente

| Campo | Valor |
|-------|-------|
| **Contacto** | {$this->contact_name} |
| **Email** | {$this->email} |
| **Teléfono** | {$this->phone} |

## 1. ¿Qué vendes o qué servicio ofreces?

{$this->offer}

## 2. ¿Qué tipo de personas son tus principales clientes?

{$this->target_audience}

## 3. ¿Por qué tus clientes te eligen a ti y no a otro negocio?

{$this->differentiator}

## 4. ¿Qué es lo que más te interesa conseguir con la página?

{$this->main_goal}

## 5. ¿Qué es lo primero que te gustaría que una persona entendiera al entrar a tu página?

{$this->first_impression}

## 6. ¿Hay algún producto o servicio que te interese promocionar especialmente?

{$this->promoted_service}

---
*Generado el: {$this->created_at->format('d/m/Y H:i')}*
MARKDOWN;
    }
}

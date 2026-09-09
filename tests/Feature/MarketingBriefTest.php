<?php

namespace Tests\Feature;

use App\Models\MarketingBriefLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarketingBriefTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_form_loads(): void
    {
        $response = $this->get('/marketing-brief');
        $response->assertStatus(200);
        $response->assertSee('Cuéntame Sobre Tu Negocio');
    }

    public function test_store_marketing_brief_with_token(): void
    {
        $link = MarketingBriefLink::create(['name' => 'Test Client']);

        $response = $this->post('/marketing-brief', [
            'marketing_brief_link_token' => $link->token,
            'contact_name' => 'Juan Perez',
            'email' => 'juan@test.com',
            'phone' => '85008393',
            'offer' => 'Vendo café de especialidad',
            'target_audience' => 'Personas de 25-40 años que trabajan en oficinas',
            'differentiator' => 'Calidad y atención personalizada',
            'main_goal' => 'Conseguir más clientes',
            'first_impression' => 'Negocio familiar de confianza',
            'promoted_service' => 'Mi menú de desayunos',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('marketing_briefs', [
            'marketing_brief_link_id' => $link->id,
            'offer' => 'Vendo café de especialidad',
        ]);
    }

    public function test_store_marketing_brief_with_custom_goal(): void
    {
        $response = $this->post('/marketing-brief', [
            'contact_name' => 'Maria Lopez',
            'email' => 'maria@test.com',
            'phone' => '88888888',
            'offer' => 'Repostería artesanal',
            'target_audience' => 'Familias',
            'differentiator' => 'Ingredientes frescos de la zona',
            'main_goal' => null,
            'main_goal_other' => 'Ganar premios locales',
            'first_impression' => 'Negocio con 15 años de experiencia',
            'promoted_service' => 'Promocionar mis servicios de catering',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('marketing_briefs', [
            'main_goal' => 'Ganar premios locales',
        ]);
    }

    public function test_marketing_brief_link_requires_goal(): void
    {
        $response = $this->post('/marketing-brief', [
            'contact_name' => 'Test',
            'email' => 'test@test.com',
            'phone' => '88888888',
            'offer' => 'Servicio',
            'target_audience' => 'Personas',
            'differentiator' => 'Calidad',
            'main_goal' => null,
            'main_goal_other' => null,
            'first_impression' => 'Mensaje',
            'promoted_service' => 'Producto',
        ]);

        $response->assertSessionHasErrors('main_goal');
    }

    public function test_marketing_brief_link_404_when_inactive(): void
    {
        $link = MarketingBriefLink::create(['name' => 'Expired', 'is_active' => false]);
        $response = $this->get('/marketing-brief/' . $link->token);
        $response->assertNotFound();
    }
}
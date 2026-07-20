<?php

namespace Tests\Feature;

use App\Models\CollectionPoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_can_be_rendered(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('Cultive Mais');
        $this->get(route('how-it-works'))->assertOk()->assertSee('Da separação em casa');
        $this->get(route('organic-waste'))->assertOk()->assertSee('Resíduos orgânicos ainda têm muito a oferecer');
        $this->get(route('collection-points'))->assertOk()->assertSee('Pontos de coleta em Cotia');
    }

    public function test_collection_points_page_lists_active_points_only(): void
    {
        CollectionPoint::query()->create([
            'name' => 'Ponto Ativo',
            'address' => 'Rua Verde, 100',
            'neighborhood' => 'Centro',
            'city' => 'Cotia',
            'state' => 'SP',
            'active' => true,
        ]);

        CollectionPoint::query()->create([
            'name' => 'Ponto Inativo',
            'address' => 'Rua Cinza, 200',
            'neighborhood' => 'Centro',
            'city' => 'Cotia',
            'state' => 'SP',
            'active' => false,
        ]);

        $this->get(route('collection-points'))
            ->assertOk()
            ->assertSee('Ponto Ativo')
            ->assertSee('Não informado')
            ->assertDontSee('Ponto Inativo');
    }
}

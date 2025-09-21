<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FornecedorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function cria_fornecedor_com_sucesso()
    {
        $response = $this->postJson('/api/fornecedores', [
            'nome'  => 'Teste de fornecedor',
            'cnpj'  => '12345678000190',
            'email' => 'teste@email.com',
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function falha_de_validacao_quando_cnpj_invalido()
    {
        $response = $this->postJson('/api/fornecedores', [
            'nome'  => 'Teste de fornecedor',
            'cnpj'  => '123',
            'email' => 'teste@email.com',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['cnpj']);
    }

    /** @test */
    public function busca_filtrada_por_email_funciona()
    {
        Fornecedor::factory()->create(['email' => 'teste@empresa.com']);
        Fornecedor::factory()->create(['email' => 'outro@empresa.com']);

        $response = $this->getJson('/api/fornecedores?email=teste@empresa.com');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['email' => 'teste@empresa.com']);
    }
}

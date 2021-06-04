<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Clientes;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreate(){

        //$this->markTestSkipped(); //Para evitar o teste

        $cliente = Clientes::create([   'nome' => 'Isonequex', 
                                        'email' => 'isonequex@senac.br',
                                        'endereco' => 'Av. Isosenac',
                                        'nascimento' => '1979-01-31']);

        $this->assertDatabaseHas('Clientes', ['nome' => 'Isonequex']);

        /*
        //Forma não elegante de apagar o lixo gerado no DB
        //Usando o DatabaseTransactions não precisa se preocupar com isso

        $id = $cliente->id;

        $cliente->destroy($cliente->id);

        $this->assertDatabaseMissing('Clientes', ['id' => $id]);
        */
    }

}

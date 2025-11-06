<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Clientes
        DB::table('clientes')->insert([
            ['nome' => 'Ana Silva', 'email' => 'ana@email.com', 'telefone' => '11999990001', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bruno Souza', 'email' => 'bruno@email.com', 'telefone' => '11999990002', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Carla Lima', 'email' => 'carla@email.com', 'telefone' => '11999990003', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Daniel Oliveira', 'email' => 'daniel@email.com', 'telefone' => '11999990004', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Eduardo Santos', 'email' => 'eduardo@email.com', 'telefone' => '11999990005', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Fernanda Costa', 'email' => 'fernanda@email.com', 'telefone' => '11999990006', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Gustavo Rocha', 'email' => 'gustavo@email.com', 'telefone' => '11999990007', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Helena Martins', 'email' => 'helena@email.com', 'telefone' => '11999990008', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Igor Pereira', 'email' => 'igor@email.com', 'telefone' => '11999990009', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Juliana Almeida', 'email' => 'juliana@email.com', 'telefone' => '11999990010', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Pratos
        DB::table('pratos')->insert([
            ['nome' => 'Feijoada', 'preco' => 35.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Strogonoff', 'preco' => 30.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Lasagna', 'preco' => 28.50, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Pizza', 'preco' => 40.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Salada Caesar', 'preco' => 22.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bife Acebolado', 'preco' => 33.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Peixe Grelhado', 'preco' => 38.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Espaguete', 'preco' => 27.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Hambúrguer', 'preco' => 25.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Sushi', 'preco' => 50.00, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Ingredientes
        DB::table('ingredientes')->insert([
            ['nome' => 'Arroz', 'preco' => 5.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Feijão', 'preco' => 6.50, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Carne', 'preco' => 20.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Frango', 'preco' => 15.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Queijo', 'preco' => 12.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Tomate', 'preco' => 4.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Alface', 'preco' => 3.50, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Massa', 'preco' => 7.00, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Molho', 'preco' => 5.50, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Ovo', 'preco' => 2.50, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Estoque
        DB::table('estoques')->insert([
            ['ingrediente_id' => 1, 'quantidade' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['ingrediente_id' => 2, 'quantidade' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['ingrediente_id' => 3, 'quantidade' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['ingrediente_id' => 4, 'quantidade' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['ingrediente_id' => 5, 'quantidade' => 40, 'created_at' => now(), 'updated_at' => now()],
            ['ingrediente_id' => 6, 'quantidade' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['ingrediente_id' => 7, 'quantidade' => 90, 'created_at' => now(), 'updated_at' => now()],
            ['ingrediente_id' => 8, 'quantidade' => 120, 'created_at' => now(), 'updated_at' => now()],
            ['ingrediente_id' => 9, 'quantidade' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['ingrediente_id' => 10, 'quantidade' => 30, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Compras
        for ($i = 1; $i <= 10; $i++) {
            DB::table('compras')->insert([
                'nota_fiscal' => "NF$i",
                'fornecedor' => "Fornecedor $i",
                'data_compra' => now(),
                'valor_total' => rand(100, 500),
                'status' => 'pendente',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Encomendas
        for ($i = 1; $i <= 10; $i++) {
            DB::table('encomendas')->insert([
                'cliente_id' => $i,
                'data' => now(),
                'valor_total' => rand(50, 300),
                'status' => $i % 2 == 0 ? 'pendente' : 'pago',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Encomenda_Prato
        for ($i = 1; $i <= 10; $i++) {
            DB::table('encomenda_prato')->insert([
                'encomenda_id' => $i,
                'prato_id' => $i,
                'quantidade' => rand(1, 3),
                'preco_unitario' => rand(20, 50),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Product;

use App\Http\Livewire\Products;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Успешное удаление товара
     */
    public function testSuccess()
    {
        $product = $this->createProduct();

        Livewire::test(Products::class)->call('deleteProduct', $product->id);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}

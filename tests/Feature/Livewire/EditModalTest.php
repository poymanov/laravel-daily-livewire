<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Http\Livewire\EditModal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EditModalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Попытка изменения без данных
     */
    public function testEmpty()
    {
        $product = $this->createProduct();

        Livewire::test(EditModal::class)
            ->set('product', $product)
            ->set('product.name')
            ->set('product.price')
            ->call('save')
            ->assertHasErrors([
                'product.name'  => 'required',
                'product.price' => 'required',
            ]);
    }

    /**
     * Попытка изменения с неправильной ценой
     */
    public function testWrongPrice()
    {
        $product = $this->createProduct();

        Livewire::test(EditModal::class)
            ->set('product', $product)
            ->set('product.price', 'test')
            ->call('save')
            ->assertHasErrors([
                'product.price' => 'integer',
            ]);
    }

    /**
     * Успешное изменение товара
     */
    public function testSuccess()
    {
        $product = $this->createProduct();

        $name  = 'test';
        $price = 2;

        Livewire::test(EditModal::class)
            ->set('product', $product)
            ->set('product.name', $name)
            ->set('product.price', $price)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('products', [
            'id'    => $product->id,
            'name'  => $name,
            'price' => $price,
        ]);
    }
}

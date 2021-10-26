<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Product;

use App\Http\Livewire\Product\Create;
use App\Http\Livewire\Product\Edit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Попытка изменения без данных
     */
    public function testEmpty()
    {
        $product = $this->createProduct();

        Livewire::test(Edit::class, compact('product'))
            ->set('product.name')
            ->set('product.description')
            ->set('productCategories')
            ->call('submit')
            ->assertHasErrors([
                'product.name'        => 'required',
                'product.description' => 'required',
                'productCategories'   => 'required',
            ]);
    }

    /**
     * Попытка изменения со слишком коротким наименованием
     */
    public function testTooShortName()
    {
        $product = $this->createProduct();

        Livewire::test(Edit::class, compact('product'))
            ->set('product.name', 't')
            ->call('submit')
            ->assertHasErrors(['product.name' => 'min']);
    }

    /**
     * Попытка изменения со слишком коротким описанием
     */
    public function testTooShortDescription()
    {
        $product = $this->createProduct();

        Livewire::test(Edit::class, compact('product'))
            ->set('product.description', 't')
            ->call('submit')
            ->assertHasErrors(['product.description' => 'min']);
    }

    /**
     * Попытка изменения с несуществующим цветом
     */
    public function testNotExistedColor()
    {
        Livewire::test(Create::class)
            ->set('product.color', 'test')
            ->call('submit')
            ->assertHasErrors(['product.color' => 'in']);
    }

    /**
     * Успешное изменение
     */
    public function testSuccess()
    {
        $product = $this->createProduct();

        $name           = $this->faker->sentence;
        $description    = $this->faker->text;
        $categoryFirst  = $this->createCategory();
        $categorySecond = $this->createCategory();
        $category       = $this->createCategory();
        $color          = 'blue';

        Livewire::test(Edit::class, compact('product'))
            ->set('product.name', $name)
            ->set('product.description', $description)
            ->set('productCategories', [$categoryFirst->id, $categorySecond->id])
            ->set('product.color', $color)
            ->set('product.in_stock', true)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'id'          => $product->id,
            'name'        => $name,
            'description' => $description,
            'color'       => $color,
            'in_stock'    => true,
        ]);

        $this->assertDatabaseHas('category_product', [
            'category_id' => $categoryFirst->id,
            'product_id'  => $product->id,
        ]);

        $this->assertDatabaseHas('category_product', [
            'category_id' => $categorySecond->id,
            'product_id'  => $product->id,
        ]);
    }
}

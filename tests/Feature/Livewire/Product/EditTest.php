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
            ->set('product.category_id')
            ->call('submit')
            ->assertHasErrors(['product.name' => 'required', 'product.description' => 'required', 'product.category_id' => 'required']);
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
     * Попытка изменения с несуществующей категорией
     */
    public function testNotExistedCategoryId()
    {
        $product = $this->createProduct();

        Livewire::test(Edit::class, compact('product'))
            ->set('product.category_id', 999)
            ->call('submit')
            ->assertHasErrors(['product.category_id' => 'exists']);
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

        $name        = $this->faker->sentence;
        $description = $this->faker->text;
        $category    = $this->createCategory();
        $color       = 'blue';

        Livewire::test(Edit::class, compact('product'))
            ->set('product.name', $name)
            ->set('product.description', $description)
            ->set('product.category_id', $category->id)
            ->set('product.color', $color)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'id'          => $product->id,
            'name'        => $name,
            'description' => $description,
            'category_id' => $category->id,
            'color'       => $color,
        ]);
    }
}

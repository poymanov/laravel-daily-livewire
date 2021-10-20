<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Product;

use App\Http\Livewire\Product\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Попытка создания без данных
     */
    public function testEmpty()
    {
        Livewire::test(Create::class)
            ->call('submit')
            ->assertHasErrors(['product.name' => 'required', 'product.description' => 'required', 'product.category_id' => 'required']);
    }

    /**
     * Попытка создания со слишком коротким наименованием
     */
    public function testTooShortName()
    {
        Livewire::test(Create::class)
            ->set('product.name', 't')
            ->call('submit')
            ->assertHasErrors(['product.name' => 'min']);
    }

    /**
     * Попытка создания со слишком коротким описанием
     */
    public function testTooShortDescription()
    {
        Livewire::test(Create::class)
            ->set('product.description', 't')
            ->call('submit')
            ->assertHasErrors(['product.description' => 'min']);
    }

    /**
     * Попытка создания с несуществующей категорией
     */
    public function testNotExistedCategoryId()
    {
        Livewire::test(Create::class)
            ->set('product.category_id', 999)
            ->call('submit')
            ->assertHasErrors(['product.category_id' => 'exists']);
    }

    /**
     * Успешное создание
     */
    public function testSuccess()
    {
        $name        = $this->faker->sentence;
        $description = $this->faker->text;
        $category    = $this->createCategory();

        Livewire::test(Create::class)
            ->set('product.name', $name)
            ->set('product.description', $description)
            ->set('product.category_id', $category->id)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'name'        => $name,
            'description' => $description,
            'category_id' => $category->id,
        ]);
    }
}

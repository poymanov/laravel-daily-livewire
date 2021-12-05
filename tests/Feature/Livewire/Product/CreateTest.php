<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Product;

use App\Http\Livewire\Product\Create;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
            ->assertHasErrors([
                'product.name'        => 'required',
                'product.description' => 'required',
                'productCategories'   => 'required',
            ]);
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
     * Попытка создания с несуществующим цветом
     */
    public function testNotExistedColor()
    {
        Livewire::test(Create::class)
            ->set('product.color', 'test')
            ->call('submit')
            ->assertHasErrors(['product.color' => 'in']);
    }

    /**
     * Успешное создание
     */
    public function testSuccess()
    {
        Storage::fake('public');

        $name           = $this->faker->sentence;
        $description    = $this->faker->text;
        $categoryFirst  = $this->createCategory();
        $categorySecond = $this->createCategory();
        $color          = 'red';

        $stockDate = new DateTime($this->faker->date);

        $file = UploadedFile::fake()->image('photo.jpg');

        Livewire::test(Create::class)
            ->set('product.name', $name)
            ->set('product.description', $description)
            ->set('product.color', $color)
            ->set('product.in_stock', true)
            ->set('product.stock_date', $stockDate->format('m/d/Y'))
            ->set('productCategories', [$categoryFirst->id, $categorySecond->id])
            ->set('photo', $file)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'name'        => $name,
            'description' => $description,
            'color'       => $color,
            'in_stock'    => true,
            'stock_date'  => $stockDate->format('Y-m-d'),
        ]);

        $this->assertDatabaseCount('category_product', 2);

        $this->assertDatabaseHas('category_product', [
            'category_id' => $categoryFirst->id,
        ]);

        $this->assertDatabaseHas('category_product', [
            'category_id' => $categorySecond->id,
        ]);

        $this->assertCount(1, Storage::disk('public')->allFiles());
    }
}

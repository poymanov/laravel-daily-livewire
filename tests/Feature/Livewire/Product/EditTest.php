<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Product;

use App\Http\Livewire\Product\Create;
use App\Http\Livewire\Product\Edit;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
            ->set('product.price')
            ->set('productCategories')
            ->call('submit')
            ->assertHasErrors([
                'product.name'        => 'required',
                'product.description' => 'required',
                'product.price'       => 'required',
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
        $product = $this->createProduct();

        Livewire::test(Edit::class, compact('product'))
            ->set('product.color', 'test')
            ->call('submit')
            ->assertHasErrors(['product.color' => 'in']);
    }

    /**
     * Попытка создания с некорректной ценой
     */
    public function testWrongPrice()
    {
        $product = $this->createProduct();

        Livewire::test(Edit::class, compact('product'))
            ->set('product.price', 'test')
            ->call('submit')
            ->assertHasErrors(['product.price' => 'integer']);
    }

    /**
     * Успешное изменение
     */
    public function testSuccess()
    {
        Storage::fake('public');

        $product = $this->createProduct();

        $name           = $this->faker->sentence;
        $description    = $this->faker->text;
        $categoryFirst  = $this->createCategory();
        $categorySecond = $this->createCategory();
        $color          = 'blue';
        $price          = 22;

        $file = UploadedFile::fake()->image('photo.jpg');

        $stockDate = new DateTime($this->faker->date);

        Livewire::test(Edit::class, compact('product'))
            ->set('product.name', $name)
            ->set('product.description', $description)
            ->set('product.price', $price)
            ->set('productCategories', [$categoryFirst->id, $categorySecond->id])
            ->set('product.color', $color)
            ->set('product.in_stock', true)
            ->set('product.stock_date', $stockDate->format('m/d/Y'))
            ->set('photo', $file)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'id'          => $product->id,
            'name'        => $name,
            'description' => $description,
            'price'       => $price,
            'color'       => $color,
            'in_stock'    => true,
            'stock_date'  => $stockDate->format('Y-m-d'),
        ]);

        $this->assertDatabaseHas('category_product', [
            'category_id' => $categoryFirst->id,
            'product_id'  => $product->id,
        ]);

        $this->assertDatabaseHas('category_product', [
            'category_id' => $categorySecond->id,
            'product_id'  => $product->id,
        ]);

        $this->assertCount(1, Storage::disk('public')->allFiles());
    }
}

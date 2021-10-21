<?php

declare(strict_types=1);

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Попытка посещения гостем
     */
    public function testGuest()
    {
        $product = $this->createProduct();

        $response = $this->get($this->makeUrl($product->id));
        $response->assertRedirect(self::LOGIN_URL);
    }

    /**
     * Успешное отображение страницы
     */
    public function testSuccess()
    {
        $this->signIn();

        $category = $this->createCategory();

        $product = $this->createProduct();

        $response = $this->get($this->makeUrl($product->id));
        $response->assertOk();

        $response->assertSeeLivewire('product.edit');
        $response->assertSee('Edit Product');
        $response->assertSee('Name');
        $response->assertSee('Description');
        $response->assertSee('-- choose category --');
        $response->assertSee('Category');
        $response->assertSee('Update');
        $response->assertSee($category->name);
        $response->assertSee($product->name);
        $response->assertSee($product->description);
    }

    /**
     * Формирование url страницы редактирования товара
     *
     * @param int $id
     *
     * @return string
     */
    public function makeUrl(int $id): string
    {
        return '/products/' . $id . '/edit';
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/products';

    /**
     * Попытка посещения гостем
     */
    public function testGuest()
    {
        $response = $this->get(self::URL);
        $response->assertRedirect(self::LOGIN_URL);
    }

    /**
     * Фильтры по товарам успешно отображаются
     */
    public function testFilter()
    {
        $this->signIn();

        $response = $this->get(self::URL);
        $response->assertOk();

        $response->assertSee('Search for product...');
    }

    /**
     * Успешное отображение таблицы с продуктами
     */
    public function testSuccess()
    {
        $this->signIn();
        $product = $this->createProduct();

        $response = $this->get(self::URL);
        $response->assertOk();
        $response->assertSee('Products');
        $response->assertSee('Name');
        $response->assertSee('Description');
        $response->assertSee($product->name);
        $response->assertSee($product->description);
    }

    /**
     * Успешное отображение таблицы с продуктами с учётом пагинации
     */
    public function testSuccessWithPagination()
    {
        $this->signIn();

        $productFirst  = $this->createProduct();
        $productSecond = $this->createProduct();
        $productThird  = $this->createProduct();

        $response = $this->get(self::URL);
        $response->assertOk();

        $response->assertSee($productFirst->name);
        $response->assertSee($productFirst->description);

        $response->assertSee($productSecond->name);
        $response->assertSee($productSecond->description);

        $response->assertDontSee($productThird->name);
        $response->assertDontSee($productThird->description);
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature\Product;

use DateTime;
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

        $categoryFirst  = $this->createCategory();
        $categorySecond = $this->createCategory();

        $response = $this->get(self::URL);
        $response->assertOk();

        $response->assertSee('Search for product...');

        $response->assertSee('-- choose category --');
        $response->assertSee($categoryFirst->name);
        $response->assertSee($categorySecond->name);
    }

    /**
     * Успешное отображение таблицы с продуктами
     */
    public function testSuccess()
    {
        $this->signIn();

        $categoryFirst  = $this->createCategory();
        $categorySecond = $this->createCategory();

        $product = $this->createProduct();
        $product->categories()->attach($categoryFirst->id);
        $product->categories()->attach($categorySecond->id);

        $stockDate = new DateTime($product->stock_date);

        $response = $this->get(self::URL);
        $response->assertOk();
        $response->assertSee('Create');
        $response->assertSee('Products');
        $response->assertSee('Photo');
        $response->assertSee('Name');
        $response->assertSee('Description');
        $response->assertSee('Category');
        $response->assertSee('Color');
        $response->assertSee('In Stock?');
        $response->assertSee('Edit');
        $response->assertSee('Delete');
        $response->assertSee('storage/' . $product->photo);
        $response->assertSee($product->name);
        $response->assertSee($product->description);
        $response->assertSee($categoryFirst->name);
        $response->assertSee($categorySecond->name);
        $response->assertSee(ucfirst($product->color));
        $response->assertSee($stockDate->format('m/d/Y'));
        $response->assertSee('No');
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

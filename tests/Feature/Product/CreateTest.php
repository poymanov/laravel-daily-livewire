<?php

declare(strict_types=1);

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/products/create';

    /**
     * Попытка посещения гостем
     */
    public function testGuest()
    {
        $response = $this->get(self::URL);
        $response->assertRedirect(self::LOGIN_URL);
    }

    /**
     * Успешное отображение страницы
     */
    public function testSuccess()
    {
        $this->signIn();

        $category = $this->createCategory();

        $response = $this->get(self::URL);
        $response->assertSeeLivewire('product.create');
        $response->assertOk();
        $response->assertSee('New Product');
        $response->assertSee('Name');
        $response->assertSee('Description');
        $response->assertSee('-- choose category --');
        $response->assertSee('Categories');
        $response->assertSee('Color');
        $response->assertSee('Red');
        $response->assertSee('Blue');
        $response->assertSee('Green');
        $response->assertSee('In Stock?');
        $response->assertSee('Create');
        $response->assertSee($category->name);
    }
}

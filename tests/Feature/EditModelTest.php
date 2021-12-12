<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditModelTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/edit-modal';

    /**
     * Попытка посещения гостем
     */
    public function testGuest()
    {
        $response = $this->get(self::URL);
        $response->assertRedirect(self::LOGIN_URL);
    }

    /**
     * Успешное отображение списка товаров
     */
    public function testSuccess()
    {
        $this->signIn();
        $product = $this->createProduct();

        $response = $this->get(self::URL);
        $response->assertSeeLivewire('edit-modal');
        $response->assertSee('Edit Modal');
        $response->assertSee('Name');
        $response->assertSee('Price');
        $response->assertSee($product->name);
        $response->assertSee($product->price);
        $response->assertSee('Edit');
    }
}

<?php

declare(strict_types=1);

namespace Tests\Feature\MultiplyInput;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/multiply-input';

    /**
     * Попытка посещения гостем
     */
    public function testGuest()
    {
        $response = $this->get(self::URL);
        $response->assertRedirect(self::LOGIN_URL);
    }

    /**
     * Успешное отображение формы
     */
    public function testSuccess()
    {
        $this->signIn();

        $product = $this->createProduct();

        $response = $this->get(self::URL);
        $response->assertSeeLivewire('multiply-input');
        $response->assertSee('Multiply Input');
        $response->assertSee('Customer name');
        $response->assertSee('Customer email');
        $response->assertSee('Products');
        $response->assertSee('Product');
        $response->assertSee('Quantity');
        $response->assertSee('Delete');
        $response->assertSee($product->name);
        $response->assertSee($product->price);
        $response->assertSee('Add Another Product');
        $response->assertSee('Save Order');
    }
}

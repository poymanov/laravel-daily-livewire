<?php

declare(strict_types=1);

namespace Tests\Feature\MultiplyInput;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubmitTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

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
     * Успешное отображение данных из формы
     */
    public function testSuccess()
    {
        $product  = $this->createProduct();
        $quantity = 2;

        $customerName  = $this->faker->name;
        $customerEmail = $this->faker->email;

        $this->signIn();

        $response = $this->post(self::URL, [
            'customer_name'  => $customerName,
            'customer_email' => $customerEmail,
            'orderProducts'  => [['product_id' => $product->id, 'quantity' => $quantity]],
        ]);
        $response->assertOk();

        $response->assertSee('Multiply Input Submit Result');
        $response->assertSee('Customer name: ' . $customerName);
        $response->assertSee('Customer email: ' . $customerEmail);
        $response->assertSee('Products');
        $response->assertSee('Product: ' . $product->id);
        $response->assertSee('Quantity: ' . $quantity);
    }
}

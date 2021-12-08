<?php

declare(strict_types=1);

namespace Tests\Feature\Dropdown;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmitTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/dropdown';

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
        $country = $this->createCountry();
        $city    = $this->createCity(['country_id' => $country->id]);

        $this->signIn();

        $response = $this->post(self::URL, ['country' => $country->id, 'city' => $city->id]);
        $response->assertOk();

        $response->assertSee('Dropdown Submit Result');
        $response->assertSee('Country: ' . $country->id);
        $response->assertSee('City: ' . $city->id);
    }
}

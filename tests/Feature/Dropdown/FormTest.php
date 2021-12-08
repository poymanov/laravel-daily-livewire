<?php

declare(strict_types=1);

namespace Tests\Feature\Dropdown;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTest extends TestCase
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
     * Успешное отображение формы
     */
    public function testSuccess()
    {
        $country = $this->createCountry();
        $city    = $this->createCity(['country_id' => $country->id]);

        $this->signIn();

        $response = $this->get(self::URL);
        $response->assertSeeLivewire('dropdown');
        $response->assertSee('Dropdown');
        $response->assertSee('Country');
        $response->assertSee('City');
        $response->assertSee($country->name);
        $response->assertDontSee($city->name);
    }
}

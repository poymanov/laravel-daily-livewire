<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutoRefreshTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/auto-refresh';

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

        $response = $this->get(self::URL);
        $response->assertSeeLivewire('auto-refresh');
        $response->assertSee('Auto Refresh');
    }
}

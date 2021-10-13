<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/dashboard';

    /**
     * Попытка посещения гостем
     */
    public function testGuest()
    {
        $response = $this->get(self::URL);
        $response->assertRedirect(self::LOGIN_URL);
    }

    /**
     * Отображение всех пунктов главного меню
     */
    public function testNavigation()
    {
        $this->signIn();
        $response = $this->get(self::URL);
        $response->assertSee('Dashboard');
        $response->assertSee('Profile');
        $response->assertSee('Notifications (0)');
        $response->assertSee('Products');
    }
}

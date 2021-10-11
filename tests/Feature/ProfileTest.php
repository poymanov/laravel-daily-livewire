<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    private const URL = '/profile';

    /**
     * Попытка посещения гостем
     */
    public function testGuest()
    {
        $response = $this->get(self::URL);
        $response->assertRedirect(self::LOGIN_URL);
    }

    /**
     * Успешное отображение формы для изменения основных данных
     */
    public function testSuccessCommon()
    {
        $user = $this->createUser();

        $this->signIn($user);

        $response = $this->get(self::URL);
        $response->assertSee('Name');
        $response->assertSee('Email');
        $response->assertSee($user->name);
        $response->assertSee($user->email);
        $response->assertDontSee('Successfully saved.');
    }

    /**
     * Успешное отображение формы для изменения пароля
     */
    public function testSuccessPassword()
    {
        $user = $this->createUser();

        $this->signIn($user);

        $response = $this->get(self::URL);
        $response->assertSee('New Password');
        $response->assertSee('Repeat New Password');
        $response->assertDontSee('Successfully saved.');
    }
}

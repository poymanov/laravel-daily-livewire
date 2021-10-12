<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire;

use App\Http\Livewire\NotificationMenuItem;
use App\Http\Livewire\Profile\Common;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class NotificationMenuItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Проверка начального состояния счетчика
     */
    public function testInitialState()
    {
        Livewire::test(NotificationMenuItem::class)->assertSet('notificationsCount', 0);
    }

    /**
     * Увеличение счётчика
     */
    public function testIncrementCount()
    {
        Livewire::test(NotificationMenuItem::class)
            ->call('incrementCount')
            ->assertSet('notificationsCount', 1);
    }

    /**
     * Увеличение счетчика при наступлении события изменения профиля
     */
    public function testEmitUpdateProfile()
    {
        $this->signIn();

        Livewire::test(NotificationMenuItem::class)
            ->emit('profileUpdate')
            ->assertSet('notificationsCount', 1);
    }
}

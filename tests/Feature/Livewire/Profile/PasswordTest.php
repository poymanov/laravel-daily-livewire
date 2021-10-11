<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Profile;

use App\Http\Livewire\Profile\Password;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Попытка изменения пароля с пустыми данными
     */
    public function testEmpty()
    {
        $this->signIn();

        Livewire::test(Password::class)
            ->set('password')
            ->call('updatePassword')
            ->assertHasErrors(['password']);
    }

    /**
     * Попытка установки слишком короткого пароля
     */
    public function testTooPassword()
    {
        $this->signIn();

        Livewire::test(Password::class)
            ->set('password', '123')
            ->set('passwordConfirmation', '123')
            ->call('updatePassword')
            ->assertHasErrors(['password']);
    }

    /**
     * Попытка изменения пароля без подтверждения
     */
    public function testWithoutConfirmation()
    {
        Livewire::test(Password::class)
            ->set('password', $this->faker->password(8))
            ->call('updatePassword')
            ->assertHasErrors(['passwordConfirmation']);
    }

    /**
     * Успешное изменение пароля
     */
    public function testSuccess()
    {
        $user = $this->createUser();

        $this->signIn($user);

        $newPassword = $this->faker->password(8);

        Livewire::test(Password::class)
            ->set('password', $newPassword)
            ->set('passwordConfirmation', $newPassword)
            ->call('updatePassword')
            ->assertHasNoErrors();

        $user->refresh();

        $this->assertTrue(Hash::check($newPassword, $user->password));
    }
}

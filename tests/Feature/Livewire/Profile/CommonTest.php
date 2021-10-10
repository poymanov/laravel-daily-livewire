<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Profile;

use App\Http\Livewire\Profile\Common;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CommonTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Попытка обновления профиля с пустыми данными
     */
    public function testEmpty()
    {
        $this->signIn();

        Livewire::test(Common::class)
            ->set('user.name')
            ->set('user.email')
            ->call('updateProfile')
            ->assertHasErrors(['user.name', 'user.email']);
    }

    /**
     * Попытка обновления профиля со слишком коротким именем
     */
    public function testTooShortName()
    {
        $this->signIn();

        Livewire::test(Common::class)
            ->set('user.name', 't')
            ->call('updateProfile')
            ->assertHasErrors(['user.name']);
    }

    /**
     * Попытка обновления профиля с email в неправильном формате
     */
    public function testWrongEmail()
    {
        $this->signIn();

        Livewire::test(Common::class)
            ->set('user.email', 'test')
            ->call('updateProfile')
            ->assertHasErrors(['user.email']);
    }

    /**
     * Успешное обновление основных данных
     */
    public function testSuccess()
    {
        $user = $this->createUser();

        $this->signIn($user);

        $newName  = $this->faker->name;
        $newEmail = $this->faker->email;

        Livewire::test(Common::class)
            ->set('user.name', $newName)
            ->set('user.email', $newEmail)
            ->call('updateProfile')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('users', [
            'id'    => $user->id,
            'name'  => $newName,
            'email' => $newEmail,
        ]);
    }
}

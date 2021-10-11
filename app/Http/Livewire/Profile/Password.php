<?php

declare(strict_types=1);

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Validation\Rules;

class Password extends Component
{
    /** @var string */
    public $password;

    /** @var string */
    public $passwordConfirmation;

    /** @var bool */
    public $success = false;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.profile.password');
    }

    public function updatePassword(): void
    {
        $this->validate();

        /** @var User|null $user */
        $user = auth()->user();

        if (!$user) {
            $this->addError('password', 'Failed to find user to change password');

            return;
        }

        $result = $user->forceFill([
            'password'       => Hash::make($this->password),
            'remember_token' => Str::random(60),
        ])->save();

        if (!$result) {
            $this->addError('password', 'Failed to change password');

            return;
        }

        $this->success = true;
    }

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'password'             => ['required', Rules\Password::defaults()],
            'passwordConfirmation' => ['same:password'],
        ];
    }
}

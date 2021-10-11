<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Exception;
use Livewire\Component;

class Common extends Component
{
    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var bool */
    public $success = false;

    /** @var User */
    public $user;

    /** @var string[] */
    protected $rules = [
        'user.name'  => 'required|min:3',
        'user.email' => 'required|email',
    ];

    public function mount(): void
    {
        /** @var User|null $user */
        $user = auth()->user();

        if (is_null($user)) {
            throw new Exception('Failed to load auth user');
        }

        $this->user = $user;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.profile.common');
    }

    public function updateProfile(): void
    {
        $this->validate();

        $this->user->save();

        $this->success = true;
    }

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }
}

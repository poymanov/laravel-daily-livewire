<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationMenuItem extends Component
{
    /** @var int */
    public $notificationsCount = 0;

    /** @var string[] */
    protected $listeners = [
        'profileUpdate' => 'incrementCount',
    ];

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.notification-menu-item');
    }

    public function incrementCount(): void
    {
        $this->notificationsCount++;
    }
}

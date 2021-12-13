<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AutoRefresh extends Component
{
    public const URL = 'https://aws.random.cat/meow';

    /** @var string */
    public $imgUrl;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->fetchImageUrl();

        return view('livewire.auto-refresh');
    }

    private function fetchImageUrl(): void
    {
        $response = Http::get(self::URL);

        if (isset($response['file'])) {
            $this->imgUrl = $response['file'];
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Collection;
use Livewire\Component;

class Dropdown extends Component
{
    /** @var Collection */
    public $countries;

    /** @var Collection */
    public $cities;

    /** @var int */
    public $country;

    /** @var int */
    public $city;

    public function mount(): void
    {
        $this->countries = Country::all();
        $this->cities    = collect();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.dropdown');
    }

    /**
     * @param string $value
     */
    public function updatedCountry(string $value): void
    {
        $this->cities = City::where('country_id', $value)->get();

        if (!is_null($this->cities->first())) {
            $this->city = $this->cities->first()->id;
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class MultiplyInput extends Component
{
    /** @var string */
    public $customer_name;

    /** @var string */
    public $customer_email;

    /** @var Collection */
    public $allProducts;

    /** @var array */
    public $orderProducts = [];


    public function mount(): void
    {
        $this->allProducts = Product::all();
        $this->addEmptyProduct();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.multiply-input');
    }

    public function addProduct(): void
    {
        $this->addEmptyProduct();
    }

    /**
     * @param string $index
     */
    public function removeProduct(string $index): void
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }

    private function addEmptyProduct(): void
    {
        $this->orderProducts[] = ['product_id' => '', 'quantity' => 1];
    }
}

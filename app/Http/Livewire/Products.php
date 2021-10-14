<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    /** @var string */
    public $searchQuery;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $products = Product::when($this->searchQuery, function ($query) {
            $query->where('name', 'like', '%' . $this->searchQuery . '%');
        })->paginate(config('pagination.products'))->withQueryString();

        return view('livewire.products.index', compact('products'));
    }
}

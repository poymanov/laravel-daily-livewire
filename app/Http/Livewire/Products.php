<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    /** @var string */
    public $searchQuery;

    /** @var int */
    public $searchCategory;

    /** @var Collection */
    public $categories;

    public function mount(): void
    {
        $this->categories = Category::all();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $products = Product::with('category')
            ->when($this->searchQuery, function ($query) {
                $query->where('name', 'like', '%' . $this->searchQuery . '%');
            })
            ->when($this->searchCategory, function ($query) {
                $query->where('category_id', $this->searchCategory);
            })
            ->paginate(config('pagination.products'))->withQueryString();

        return view('livewire.products.index', compact('products'));
    }

    /**
     * Удаление товара
     */
    public function deleteProduct(int $productId): void
    {
        $product = Product::find($productId);

        if (!$product) {
            return;
        }

        $product->delete();
    }
}

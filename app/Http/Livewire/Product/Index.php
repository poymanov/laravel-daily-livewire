<?php

declare(strict_types=1);

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
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
        $products = Product::with('categories')
            ->when($this->searchQuery, function ($query) {
                $query->where('name', 'like', '%' . $this->searchQuery . '%');
            })
            ->when($this->searchCategory, function ($query) {
                $query->whereHas('categories', function ($categoriesQuery) {
                    $categoriesQuery->where('id', $this->searchCategory);
                });
            })
            ->paginate(config('pagination.products'));

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

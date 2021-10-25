<?php

declare(strict_types=1);

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    /** @var Collection */
    public $categories;

    /** @var Product */
    public $product;

    /** @var array */
    public $colors;

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'product.name'        => 'required|min:3',
            'product.description' => 'required|min:3',
            'product.category_id' => 'required|exists:categories,id',
            'product.color'       => ['nullable', Rule::in(array_keys(Product::COLORS_LIST))],
            'product.in_stock'    => 'boolean',
        ];
    }

    public function mount(): void
    {
        $this->categories = Category::all();
        $this->product    = new Product();
        $this->colors     = Product::COLORS_LIST;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.products.create');
    }

    /**
     * Создание нового товара
     */
    public function submit(): void
    {
        $this->validate();

        if (!$this->product->in_stock) {
            $this->product->in_stock = 0;
        }

        $this->product->save();

        $this->redirect(route('products.index'));
    }

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }
}

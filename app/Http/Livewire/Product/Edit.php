<?php

declare(strict_types=1);

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
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
        ];
    }

    public function mount(Product $product): void
    {
        $this->categories = Category::all();
        $this->product    = $product;
        $this->colors     = Product::COLORS_LIST;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.products.edit');
    }

    /**
     * Создание нового товара
     */
    public function submit(): void
    {
        $this->validate();

        $this->product->save();

        $this->redirect(route('products.index'));
    }

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }
}

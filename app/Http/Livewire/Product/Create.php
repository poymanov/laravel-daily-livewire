<?php

declare(strict_types=1);

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    /** @var Collection */
    public $categories;

    /** @var Product */
    public $product;

    /** @var array */
    public $colors;

    /** @var array */
    public $productCategories;

    /** @var UploadedFile|null */
    public $photo;

    /**
     * @return array
     */
    protected function rules(): array
    {
        return [
            'product.name'        => 'required|min:3',
            'product.description' => 'required|min:3',
            'product.color'       => ['nullable', Rule::in(array_keys(Product::COLORS_LIST))],
            'product.in_stock'    => 'boolean',
            'product.stock_date'  => 'date',
            'productCategories'   => 'required|array',
            'photo'               => 'image',
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

        if ($this->photo) {
            $filename = $this->photo->store('/', 'public');

            if ($filename) {
                $this->product->photo = $filename;
            }
        }

        $this->product->save();
        $this->product->categories()->sync($this->productCategories);

        $this->redirect(route('products.index'));
    }

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class EditModal extends Component
{
    /** @var bool */
    public $showModal = false;

    /** @var Product|null */
    public $product;

    /** @var string[] */
    protected $rules = [
        'product.name'  => 'required',
        'product.price' => 'required|integer',
    ];

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.edit-modal.index', ['products' => Product::all()]);
    }

    public function edit(string $id): void
    {
        $this->showModal = true;
        $this->product   = Product::find($id);
    }

    public function close(): void
    {
        $this->showModal = false;
        $this->product   = null;
    }

    public function save(): void
    {
        $this->validate();

        if ($this->product) {
            $this->product->save();
        }

        $this->close();
    }

    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }
}
